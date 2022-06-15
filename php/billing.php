<?php
include_once("inc_useful.php");
include_once("inc_branchStatistics.php");
#TODO: aktivstatus bei den berechnungen berücksichtigen

/** directSalesBonus
 * Berechnet den direct Sales Bonus und schreibt ihn den Benutzern gut 
 * @param array userIds Die IDs der User, für welche der Bonus berechnet und gutgeschrieben werden soll
 */
function directSalesBonus(array $userIds)
{
    try {
        $unitsSqlString = getBillingUnitsString();
        foreach ($userIds as $userArr) {
            $energyRevenue = 0;
            $dslRevenue = 0;
            $gasRevenue = 0;
            $mobileCommuncationRevenue = 0;

            $userId = $userArr["user_id"];
            //get user rank from db with rank properties to be sure that we use the right rank for calculation
            $db = DbConNew($_SESSION["dbData"]);
            $stmt = $db->prepare("SELECT r.direct_unit_provision, $unitsSqlString , p.confirmed_units, p.not_confirmed_units, p.confirmed_units_without_provision FROM partner p INNER JOIN partner_rank r ON r.rank_id_name = p.rank WHERE p.user_id = :userId LIMIT 1");
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            if (!$user = $stmt->fetch()) {
                continue;
            }
            $units = ($user["confirmed_units"] + $user["green_energy_contract_units"] + $user["green_dsl_contract_units"] + $user["green_mobile_communication_contract_units"] + $user["green_gas_contract_units"]);

            if (!$user["confirmed_units"]) continue;

            $receivedBonus = $user["direct_unit_provision"] * $units;
            $energyRevenue = $user["direct_unit_provision"] * $user["green_energy_contract_units"];
            $dslRevenue = $user["direct_unit_provision"] * $user["green_dsl_contract_units"];
            $gasRevenue = $user["direct_unit_provision"] * $user["green_gas_contract_units"];
            $mobileCommuncationRevenue = $user["direct_unit_provision"] * $user["green_mobile_communication_contract_units"];

            $stmt = $db->prepare("UPDATE partner SET energy_revenue = (energy_revenue + :energy_revenue), dsl_revenue = (dsl_revenue + :dsl_revenue), gas_revenue = (gas_revenue + :gas_revenue), mobile_communication_revenue = (mobile_communication_revenue + :mobile_communication_revenue), available_balance = (available_balance + :receivedBonus), own_earned_balance = (own_earned_balance + :receivedBonus), own_total_earned_balance = (own_total_earned_balance + :receivedBonus) WHERE user_id = :userId");
            $stmt->bindParam(":receivedBonus", $receivedBonus);
            $stmt->bindParam(":energy_revenue", $energyRevenue);
            $stmt->bindParam(":dsl_revenue", $dslRevenue);
            $stmt->bindParam(":mobile_communication_revenue", $mobileCommuncationRevenue);
            $stmt->bindParam(":gas_revenue", $gasRevenue);
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
        }
    } catch (\Throwable $th) {
        echo $th;
        return;
    }
}

/** setEnergyContractProvisioned
 * Setzt Energieverträge auf provisioniert für die User Id, welche bei den Verträgen als Verantwortlicher eingetragen wurde
 * @param mixed $responsibleHeadId Die ID des Users, für welche die Energieverträge auf provisioniert gesetzt werden sollen
 */
function setEnergyContractProvisioned($responsibleHeadId)
{
    $db = DbConNew($_SESSION["dbData"]);
    $stmt = $db->prepare("UPDATE energy_contract SET provision_receiver_id = responsible_head_id, provision_paid_out_timestamp = CURRENT_TIMESTAMP WHERE responsible_head_id = :userId");
    $stmt->bindParam(":userId", $responsibleHeadId);
    $stmt->execute();
}

/** directSalesDifferenceBonus
 * Berechnet den direct Sales Difference Bonus und schreibt ihn den Benutzern gut 
 * @param array userIds Die IDs der User, für welche der Bonus berechnet und gutgeschrieben werden soll
 */
function directSalesDifferenceBonus(array $userIds)
{
    try {
        echo "here";
        $greenRedUnits = getBillingUnitsString();
        foreach ($userIds as $userArr) {
            $energyRevenue = 0;
            $dslRevenue = 0;
            $gasRevenue = 0;
            $mobileCommuncationRevenue = 0;



            $userId = $userArr["user_id"];
            $genStreak = array();

            $db = DbConNew($_SESSION["dbData"]);
            $stmt = $db->prepare("SELECT p.head_id, r.rank_order, r.direct_unit_provision,  $greenRedUnits, p.confirmed_units, p.not_confirmed_units, p.confirmed_units_without_provision, r.first_generation_unit_provision, r.second_generation_unit_provision, r.third_generation_unit_provision, r.fourth_generation_unit_provision, r.fifth_generation_unit_provision FROM partner p INNER JOIN partner_rank r ON r.rank_id_name = p.rank WHERE p.user_id = :userId LIMIT 1");
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            $user = $stmt->fetch();
            $units = ($user["confirmed_units"] + $user["confirmed_units_without_provision"] + $user["green_energy_contract_units"] + $user["green_dsl_contract_units"] + $user["green_mobile_communication_contract_units"] + $user["green_gas_contract_units"]);

            if (!$units) continue;

            while ($user["head_id"]) {
                $receivedBonus = 0;
                $stmt = $db->prepare("SELECT p.head_id, r.rank_order, r.direct_unit_provision, r.first_generation_unit_provision, r.second_generation_unit_provision, r.third_generation_unit_provision, r.fourth_generation_unit_provision, r.fifth_generation_unit_provision FROM partner p INNER JOIN partner_rank r ON r.rank_id_name = p.rank WHERE p.user_id = :userId LIMIT 1");
                $stmt->bindParam(":userId", $user["head_id"]);
                $stmt->execute();
                if (!$headUser = $stmt->fetch()) {
                    return;
                }

                //directSalesDifferenceBonus
                if ($headUser["rank_order"] > $user["rank_order"]) {
                    $directSalesDifferenceBonusProvision = ($headUser["direct_unit_provision"] - $user["direct_unit_provision"]);
                    $receivedBonus += ($headUser["direct_unit_provision"] - $user["direct_unit_provision"]) * $units;
                    $energyRevenue += $directSalesDifferenceBonusProvision * $user["green_energy_contract_units"];
                    $dslRevenue += $directSalesDifferenceBonusProvision * $user["green_dsl_contract_units"];
                    $gasRevenue += $directSalesDifferenceBonusProvision * $user["green_gas_contract_units"];
                    $mobileCommuncationRevenue += $directSalesDifferenceBonusProvision * $user["green_mobile_communication_contract_units"];
                }


                //generationBonus
                if ($user["rank_order"] >= 4) {
                    array_unshift($genStreak, array("rank_order" => $user["rank_order"])); //to store the partners which have the rank in a row / streak to count the generations later 

                    if ($user["rank_order"] >= $headUser["rank_order"]) {
                        $generations = 0;
                        foreach ($genStreak as $gen) {
                            // print_r($gen);
                            if ($gen["rank_order"] < $headUser["rank_order"]) break;
                            $generations++;
                        }
                        $generationBonus = array(0 => 0, 1 => $headUser["first_generation_unit_provision"], 2 => $headUser["second_generation_unit_provision"], 3 => $headUser["third_generation_unit_provision"], 4 => $headUser["fourth_generation_unit_provision"], 5 => $headUser["fifth_generation_unit_provision"]);
                        if ($generations < 6) {
                            $receivedBonus += $generationBonus[$generations] * $units;
                            $energyRevenue += $generationBonus[$generations] * $user["green_energy_contract_units"];
                            $dslRevenue += $generationBonus[$generations] * $user["green_dsl_contract_units"];
                            $gasRevenue += $generationBonus[$generations] * $user["green_gas_contract_units"];
                            $mobileCommuncationRevenue += $generationBonus[$generations] * $user["green_mobile_communication_contract_units"];
                        }
                    }
                } else {
                    $genStreak = array();
                }

                if (!$receivedBonus) {
                    $user = $headUser;
                    continue;
                }

                //update user balance in db
                $stmt = $db->prepare("UPDATE partner SET energy_revenue = (energy_revenue + :energy_revenue), dsl_revenue = (dsl_revenue + :dsl_revenue), gas_revenue = (gas_revenue + :gas_revenue), mobile_communication_revenue = (mobile_communication_revenue + :mobile_communication_revenue), available_balance = (available_balance + :receivedBonus), team_earned_balance = (team_earned_balance + :receivedBonus), team_total_earned_balance = (team_total_earned_balance + :receivedBonus) WHERE user_id = :userId");
                $stmt->bindParam(":receivedBonus", $receivedBonus);
                $stmt->bindParam(":energy_revenue", $energyRevenue);
                $stmt->bindParam(":dsl_revenue", $dslRevenue);
                $stmt->bindParam(":mobile_communication_revenue", $mobileCommuncationRevenue);
                $stmt->bindParam(":gas_revenue", $gasRevenue);
                $stmt->bindParam(":userId", $userId);
                $stmt->bindParam(":userId", $user["head_id"]);
                $stmt->execute();
                $user = $headUser;
            }
            setEnergyContractProvisioned($userId);
        }
    } catch (\Throwable $th) {
        echo $th;
        return;
    }
}

/** regionalBonus
 * Berechnet den regional Bonus und schreibt ihn den Benutzern gut, welche ihn erhalten
 */
function regionalBonus()
{
    try {
        $getUnitsString = getUnitsForRegionalBonusString();

        $generatedUnits = array();
        $personsForBonus = getPersonsForRegionalBonus();
        $db = DbConNew();
        foreach ($getUnitsString as $unitString) {
            $stmt = $db->prepare("$unitString");
            // $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            while ($data = $stmt->fetch()) {
                if (!isset($generatedUnits[$data["state"]])) {
                    $generatedUnits[$data["state"]] = array("units" => $data["units"]);
                    continue;
                }
                $generatedUnits[$data["state"]]["units"] += $data["units"];
            }
        }

        foreach ($generatedUnits as $state => $value) {
            if (!isset($personsForBonus[$state])) {
                continue;
            }
            foreach ($personsForBonus[$state] as $personKey => $person) {
                $personsForBonus[$state][$personKey] = "'" . $person . "'";
            }

            $numPersons = count($personsForBonus[$state]);
            $moneyForEachPersons = $value["units"] * 3 / $numPersons;
            $personsSqlString = implode(", ", $personsForBonus[$state]);
            $personsSqlString = "(" . $personsSqlString . ")";
            $stmt = $db->prepare("UPDATE partner SET available_balance = (available_balance + $moneyForEachPersons), team_earned_balance = (team_earned_balance + $moneyForEachPersons), team_total_earned_balance = (team_total_earned_balance + :money) WHERE user_id IN $personsSqlString");
            $stmt->bindParam(":money", $moneyForEachPersons);
            $stmt->execute();
        }
        return true;

        // }
    } catch (\Throwable $th) {

        return false;
    }
}


/** nationalBonus
 * Berechnet den national Bonus und schreibt ihn den Benutzern gut, welche ihn erhalten
 */
function nationalBonus()
{
    try {
        // echo "test";
        $getUnitsString = getUnitsForNationalBonusString();

        $generatedUnits = array();
        $personsForBonus = getPersonsForNationalBonus();
        $db = DbConNew();
        foreach ($getUnitsString as $unitString) {
            $stmt = $db->prepare("$unitString");
            // $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            while ($data = $stmt->fetch()) {
                // print_r($data);
                if (!isset($generatedUnits[$data["country"]])) {
                    $generatedUnits[$data["country"]] = array("units" => $data["units"]);
                    continue;
                }
                $generatedUnits[$data["country"]]["units"] += $data["units"];
            }
        }
        // print_r($generatedUnits);
        foreach ($generatedUnits as $country => $value) {
            if (!isset($personsForBonus[$country])) {
                continue;
            }
            foreach ($personsForBonus[$country] as $personKey => $person) {
                $personsForBonus[$country][$personKey] = "'" . $person . "'";
            }

            $numPersons = count($personsForBonus[$country]);
            $moneyForEachPersons = $value["units"] * 2 / $numPersons;
            $personsSqlString = implode(", ", $personsForBonus[$country]);
            $personsSqlString = "(" . $personsSqlString . ")";
            $stmt = $db->prepare("UPDATE partner SET available_balance = (available_balance + $moneyForEachPersons), team_earned_balance = (team_earned_balance + $moneyForEachPersons), team_total_earned_balance = (team_total_earned_balance + :money) WHERE user_id IN $personsSqlString");
            $stmt->bindParam(":money", $moneyForEachPersons);
            $stmt->execute();
        }
        return true;

        // }
    } catch (\Throwable $th) {

        return false;
    }
}
nationalBonus();
function setContractsProvisioned()
{
}
// getPersonsForRegionalBonus();

/** getPersonsForRegionalBonus
 * Ermittelt die Personen, welche den Regionalbonus erhalten 
 * @return array $personsSorted Personen, welche den Bonus erhalten
 */
function getPersonsForRegionalBonus()
{
    $personsSorted = array();
    $db = DbConNew();
    $stmt = $db->prepare("SELECT user_id, (SELECT c.state from city c WHERE zip = p.work_location_zip LIMIT 1) as state FROM partner p LEFT JOIN partner_rank r ON r.rank_id_name = p.rank WHERE r.rank_order = 6");
    $stmt->execute();
    while ($persons = $stmt->fetch()) {
        if (!isset($personsSorted[$persons["state"]])) {
            $personsSorted[$persons["state"]] = array($persons["user_id"]);
            continue;
        }
        array_push($personsSorted[$persons["state"]], $persons["user_id"]);
    }
    return $personsSorted;
}

/** getPersonsForNationalBonus
 * Ermittelt die Personen, welche den Nationalbonus erhalten 
 * @return array $personsSorted Personen, welche den Bonus erhalten
 */
function getPersonsForNationalBonus()
{
    $personsSorted = array();
    $db = DbConNew();
    $stmt = $db->prepare("SELECT user_id, (SELECT c.country_code from city c WHERE zip = p.work_location_zip LIMIT 1) as country FROM partner p LEFT JOIN partner_rank r ON r.rank_id_name = p.rank WHERE r.rank_order = 7");
    $stmt->execute();
    while ($persons = $stmt->fetch()) {
        if (!isset($personsSorted[$persons["country"]])) {
            $personsSorted[$persons["country"]] = array($persons["user_id"]);
            continue;
        }
        array_push($personsSorted[$persons["country"]], $persons["user_id"]);
    }
    return $personsSorted;
}

/** getUnitsForRegionalBonusString
 * Erstellt einen SQL-String, mit welchem die Einheiten, welche für den Regionalbonus verwendet werden, ermittelt werden können 
 * @return array $sqlQueryString Der erstellte SQL-String
 */
function getUnitsForRegionalBonusString()
{
    $tables = array("energy_contract", "dsl_contract", "mobile_communication_contract", "gas_contract");
    $sqlQueryString = array();
    foreach ($tables as $table) {
        $queryVarName = $table . "_units";
        $queryVarNameRedUnits = "red_" . $table . "_units";
        array_push($sqlQueryString, "SELECT SUM(t.units) units, (SELECT c.state from city c WHERE zip = p.work_location_zip LIMIT 1) as state FROM $table t RIGHT JOIN partner p ON p.user_id = t.responsible_head_id  WHERE t.provision_paid_out_timestamp BETWEEN SUBDATE(CURDATE(), INTERVAL 1 MONTH) AND NOW() AND t.provision_paid_out_timestamp IS NOT NULL AND t.provider_provision_received = 1 group by state"); //, (SELECT SUM(units) FROM $table WHERE responsible_head_id = :userId AND provision_paid_out_timestamp IS NULL AND provider_provision_received = 0) as $queryVarNameRedUnits") 
    }
    return $sqlQueryString;
}

/** getUnitsForNationalBonusString
 * Erstellt einen SQL-String, mit welchem die Einheiten, welche für den Nationalbonus verwendet werden, ermittelt werden können 
 * @return array $sqlQueryString Der erstellte SQL-String
 */
function getUnitsForNationalBonusString()
{
    $tables = array("energy_contract", "dsl_contract", "mobile_communication_contract", "gas_contract");
    $sqlQueryString = array();
    foreach ($tables as $table) {
        $queryVarName = $table . "_units";
        $queryVarNameRedUnits = "red_" . $table . "_units";
        array_push($sqlQueryString, "SELECT SUM(t.units) units, (SELECT c.country_code from city c WHERE zip = p.work_location_zip LIMIT 1) as country FROM $table t RIGHT JOIN partner p ON p.user_id = t.responsible_head_id  WHERE t.provision_paid_out_timestamp BETWEEN SUBDATE(CURDATE(), INTERVAL 1 MONTH) AND NOW() AND t.provision_paid_out_timestamp IS NOT NULL AND t.provider_provision_received = 1 group by country"); //, (SELECT SUM(units) FROM $table WHERE responsible_head_id = :userId AND provision_paid_out_timestamp IS NULL AND provider_provision_received = 0) as $queryVarNameRedUnits") 
    }
    return $sqlQueryString;
}

/** getBillingUnitsString
 * Erstellt einen SQL-String, mit welchem die Einheiten, welche für den Nationalbonus verwendet werden, ermittelt werden können 
 * @return array $sqlQueryString Der erstellte SQL-String.
 */
function getBillingUnitsString()
{
    $tables = array("energy_contract", "dsl_contract", "mobile_communication_contract", "gas_contract");
    $sqlQueryString = array();
    foreach ($tables as $table) {
        $queryVarName = "green_" . $table . "_units";
        $queryVarNameRedUnits = "red_" . $table . "_units";
        array_push($sqlQueryString, "(SELECT SUM(units) FROM $table WHERE responsible_head_id = :userId AND provision_paid_out_timestamp IS NULL AND provider_provision_received = 1) as $queryVarName, (SELECT SUM(units) FROM $table WHERE responsible_head_id = :userId AND provision_paid_out_timestamp IS NULL AND provider_provision_received = 0) as $queryVarNameRedUnits");
    }
    return implode(", ", $sqlQueryString);
}
function directSalesBonusForBranchStatistic($userId)
{
    try {
        $unitsSqlString = getBillingUnitsString();
        //get user rank from db with rank properties to be sure that we use the right rank for calculation
        $db = DbConNew($_SESSION["dbData"]);
        $stmt = $db->prepare("SELECT r.direct_unit_provision, $unitsSqlString , p.confirmed_units, p.not_confirmed_units, p.confirmed_units_without_provision FROM partner p INNER JOIN partner_rank r ON r.rank_id_name = p.rank WHERE p.user_id = :userId LIMIT 1");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $user = $stmt->fetch();

        $greenUnits = ($user["confirmed_units"] + $user["green_energy_contract_units"] + $user["green_dsl_contract_units"] + $user["green_mobile_communication_contract_units"] + $user["green_gas_contract_units"]);
        $redUnits = ($user["not_confirmed_units"] + $user["red_energy_contract_units"] + $user["red_dsl_contract_units"] + $user["red_mobile_communication_contract_units"] + $user["red_gas_contract_units"]);
        // $receivedBonus = $user["direct_unit_provision"] * ($user["confirmed_units"] + $user["not_confirmed_units"]);
        $ownProvisionsGreen = $user["direct_unit_provision"] * $greenUnits;
        $ownProvisionsRed = $user["direct_unit_provision"] * $redUnits;
        // print_r($user);
        return array("ownProvisionsExpected" => $ownProvisionsRed + $ownProvisionsGreen, "ownProvisionsRed" => $ownProvisionsRed, "ownProvisionsGreen" => $ownProvisionsGreen);
    } catch (\Throwable $th) {
        echo $th;
        return;
    }
}
// print_r(directSalesBonusForBranchStatistic(1635346547360));
function directSalesDifferenceBonusForBranch(array $userIds, $headId)
{
    try {

        $greenRedUnits = getBillingUnitsString();
        $indirectBranchProvisionsRed = 0;
        $indirectBranchProvisionsGreen = 0;
        $indirectBranchProvisionsExpected = 0;
        $ownProvisionsGreen = 0;
        $ownProvisionsRed = 0;
        $ownProvisionsExpected = 0;

        // echo "test";
        foreach ($userIds as $userArr) {
            $userId = $userArr["user_id"];
            $genStreak = array();

            $db = DbConNew();
            $stmt = $db->prepare("SELECT p.head_id, p.user_id, r.rank_order, r.direct_unit_provision, $greenRedUnits, p.confirmed_units, p.not_confirmed_units, p.confirmed_units_without_provision, r.first_generation_unit_provision, r.second_generation_unit_provision, r.third_generation_unit_provision, r.fourth_generation_unit_provision, r.fifth_generation_unit_provision FROM partner p INNER JOIN partner_rank r ON r.rank_id_name = p.rank WHERE p.user_id = :userId LIMIT 1");
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            $user = $stmt->fetch();
            $greenUnits = ($user["confirmed_units"] + $user["confirmed_units_without_provision"] + $user["green_energy_contract_units"] + $user["green_dsl_contract_units"] + $user["green_mobile_communication_contract_units"] + $user["green_gas_contract_units"]);
            $redUnits = ($user["not_confirmed_units"] + $user["red_energy_contract_units"] + $user["red_dsl_contract_units"] + $user["red_mobile_communication_contract_units"] + $user["red_gas_contract_units"]);
            $units = $greenUnits + $redUnits;


            if (!$units) continue;

            while ($user["head_id"] && $user["user_id"] != $headId) {
                $stmt = $db->prepare("SELECT p.user_id, p.head_id, r.rank_order, r.direct_unit_provision, r.first_generation_unit_provision, r.second_generation_unit_provision, r.third_generation_unit_provision, r.fourth_generation_unit_provision, r.fifth_generation_unit_provision FROM partner p INNER JOIN partner_rank r ON r.rank_id_name = p.rank WHERE p.user_id = :userId LIMIT 1");
                $stmt->bindParam(":userId", $user["head_id"]);
                $stmt->execute();
                if (!$headUser = $stmt->fetch()) {
                    return;
                }

                //directSalesDifferenceBonus
                if ($headUser["rank_order"] > $user["rank_order"]) {
                    $userProvisions = ($headUser["direct_unit_provision"] - $user["direct_unit_provision"]);
                    // if ($headUser["user_id"] == $headId) {
                    //     $ownProvisionsGreen += $userProvisions * $user["confirmed_units"];
                    //     $ownProvisionsRed += $userProvisions * $user["not_confirmed_units"];
                    // } else {
                    if ($headUser["user_id"] == $headId) {

                        $indirectBranchProvisionsGreen += $userProvisions * $greenUnits;
                        $indirectBranchProvisionsRed += $userProvisions * $redUnits;
                        $indirectBranchProvisionsExpected += $userProvisions * $units;
                    }
                    // }
                }


                //generationBonus
                if ($user["rank_order"] >= 4) {
                    array_unshift($genStreak, array("rank_order" => $user["rank_order"])); //to store the partners which have the rank in a row / streak to count the generations later 

                    if ($user["rank_order"] >= $headUser["rank_order"]) {
                        $generations = 0;
                        foreach ($genStreak as $gen) {
                            // print_r($gen);
                            if ($gen["rank_order"] < $headUser["rank_order"]) break;
                            $generations++;
                        }
                        $generationBonus = array(0 => 0, 1 => $headUser["first_generation_unit_provision"], 2 => $headUser["second_generation_unit_provision"], 3 => $headUser["third_generation_unit_provision"], 4 => $headUser["fourth_generation_unit_provision"], 5 => $headUser["fifth_generation_unit_provision"]);
                        if ($generations < 6) {

                            // if ($headUser["user_id"] == $headId) {
                            //     $ownProvisionsGreen += $generationBonus[$generations] * $greenUnits;
                            //     $ownProvisionsRed += $generationBonus[$generations] * $redUnits;
                            //     $ownProvisionsExpected += $generationBonus[$generations] * $units;
                            // } else {
                            if ($headUser["user_id"] == $headId) {
                                $indirectBranchProvisionsGreen += $generationBonus[$generations] * $greenUnits;
                                $indirectBranchProvisionsRed += $generationBonus[$generations] * $redUnits;
                                $indirectBranchProvisionsExpected += $generationBonus[$generations] * $units;
                            }
                            // }
                        }
                    }
                } else {
                    $genStreak = array();
                }

                $user = $headUser;
            }
        }
        return array("indirectBranchProvisionsExpected" => $indirectBranchProvisionsExpected,  "indirectBranchesProvisionsRed" => $indirectBranchProvisionsRed, "indirectBranchesProvisionsGreen" => $indirectBranchProvisionsGreen);
    } catch (\Throwable $th) {
        echo $th;
        return;
    }
}

function setPartnerXpressBonus($userId)
{
    try {
        $db = DbConNew();
        $stmt = $db->prepare("SELECT registration_timestamp, xpress_bonus_revenue FROM partner WHERE user_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $userData = $stmt->fetch();

        if (!$userData) return array("expectedXpressBonus" => 0, "registeredPartners" => 0, "receivesXpressBonus" => false);

        $registrationTimestamp = date('Y-m-d', strtotime($userData["registration_timestamp"])); //check if user receives xpress bonus
        $today = date("Y-m-d", strtotime(date("Y-m-d") . ' -30 days'));

        if ($today > $registrationTimestamp) return array("expectedXpressBonus" => 0, "registeredPartners" => 0, "receivesXpressBonus" => false);

        $stmt = $db->prepare("SELECT COUNT(user_id) registeredPartnerNum FROM partner WHERE head_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $registeredPartnersNum = $stmt->fetch();
        $bonus = array();

        if ($registeredPartnersNum["registeredPartnerNum"] >= 5) {
            $bonus =  array("expectedXpressBonus" => 1000, "registeredPartners" => $registeredPartnersNum["registeredPartnerNum"], "receivesXpressBonus" => true);
        } else if ($registeredPartnersNum["registeredPartnerNum"] >= 3) {
            $bonus = array("expectedXpressBonus" => 150, "registeredPartners" => $registeredPartnersNum["registeredPartnerNum"], "receivesXpressBonus" => true);
        } else {
            $bonus = array("expectedXpressBonus" => 0, "registeredPartners" => $registeredPartnersNum["registeredPartnerNum"], "receivesXpressBonus" => true);
        }

        if ($userData["xpress_bonus_revenue"] >= $bonus["expectedXpressBonus"]) {
            return $bonus;
        }
        $bonusToAddNum = $bonus["expectedXpressBonus"] - $userData["xpress_bonus_revenue"];

        $stmt = $db->prepare("UPDATE partner SET xpress_bonus_revenue = (xpress_bonus_revenue + :bonusToAdd), own_total_earned_balance = (own_total_earned_balance + :bonusToAdd), available_balance = (available_balance + :bonusToAdd) WHERE user_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":bonusToAdd", $bonusToAddNum);
        $stmt->execute();

        $stmt = $db->prepare("INSERT INTO xpress_bonus (paid_out_bonus, user_id) VALUES (:bonusToAdd, :userId)");
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":bonusToAdd", $bonusToAddNum);
        $stmt->execute();

        return $bonus;
    } catch (\Throwable $th) {
        return array("expectedXpressBonus" => 0, "registeredPartners" => 0, "receivesXpressBonus" => false);
    }
}
// print_r(setPartnerXpressBonus(1637870646860));


function getPartnerDashboardProvisions($userId)
{
    include_once("billing.php");
    $fir = directSalesBonusForBranchStatistic($userId);
    $sec = directSalesDifferenceBonusForBranch(getAllUsersFromBranch($userId), $userId);
    $thi = getAllUnitsFromBranch($userId);
    $sec["ownProvisionsExpected"] = $fir["ownProvisionsRed"] + $fir["ownProvisionsGreen"];

    return array_merge($sec, $thi);
}
function getPartnerExpectedProvisions($userId)
{
    include_once("billing.php");
    $fir = directSalesBonusForBranchStatistic($userId);
    $sec = directSalesDifferenceBonusForBranch(getAllUsersFromBranch($userId), $userId);
    $thi = getAllUnitsFromBranch($userId);
    $sec["ownProvisionsExpected"] = $fir["ownProvisionsExpected"];
    $sec["indirectBranchProvisionsExpected"] = $sec["indirectBranchProvisionsExpected"];
    return array_merge($sec, $thi);
}
// print_r(directSalesDifferenceBonusForBranch(getAllUsersFromBranch(1635346547360), 1635346547360));
function setRanks($userIds)
{
    include_once("./inc_branchStatistics.php");
    // print_r($userIds);
    foreach ($userIds as $userId) {
        // print_r($userId["user_id"]);
        $userId = $userId["user_id"];
        $db = DbConNew($_SESSION["dbData"]);
        $stmt = $db->prepare("SELECT p.all_confirmed_units, p.confirmed_units, p.confirmed_units_without_provision, r.units_needed, r.rank_order FROM partner p LEFT JOIN partner_rank r ON r.rank_id_name = p.rank WHERE user_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $data = $stmt->fetch();
        $stmt = $db->prepare("SELECT r.units_needed, r.persons_needed_units_from_line_other, r.units_needed_from_line_self, r.units_needed_from_line_other FROM partner p LEFT JOIN partner_rank r ON r.rank_id_name = p.next_rank WHERE user_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $unitsNeeded = $stmt->fetch();
        $data["units_needed"] = $unitsNeeded["units_needed"];
        $units = $data["all_confirmed_units"] + $data["confirmed_units"] + $data["confirmed_units_without_provision"];

        if ($units >= $data["units_needed"]) {
            rankPersonUp($userId, $data["rank_order"]);
        } else if ($unitsNeeded["persons_needed_units_from_line_other"] > 0) {
            $qualifiedPartners = 0;
            $directPartners = json_decode(getDirectBranchesPartnerData($userId), true);
            foreach ($directPartners as $partner) {
                $partnerBranchUnits = getAllUnitsFromBranch($partner["user_id"]);
                if (($partnerBranchUnits["totalOwnClosedUnits"] + $partnerBranchUnits["totalIndirectClosedUnits"]) >= $unitsNeeded["units_needed_from_line_other"]) {
                    $qualifiedPartners += 1;
                }
                if ($qualifiedPartners >= $unitsNeeded["persons_needed_units_from_line_other"]) {
                    rankPersonUp($userId, $data["rank_order"]);
                }
            }
        }
    }
}

function rankPersonUp($userId, $rankOrderNumber)
{
    $db = DbConNew($_SESSION["dbData"]);
    $stmt = $db->prepare("SELECT rank_order, rank_id_name FROM partner_rank WHERE rank_order = :rankOrder OR rank_order = (:rankOrder + 1)");
    $rankOrderNumber = $rankOrderNumber + 1;
    $stmt->bindParam(":rankOrder", $rankOrderNumber);
    $stmt->execute();
    $ranks = $stmt->fetchAll();
    // print_r($ranks);
    $rankFirst = $ranks[0]["rank_id_name"];
    $rankSec = $ranks[1]["rank_id_name"];


    $stmt = $db->prepare("UPDATE partner SET rank = '$rankFirst', next_rank = '$rankSec', show_rank_up_notification = 1 WHERE user_id = :userId");
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
}

function createPartnerStatistic()
{
    $db = DbConNew();
    $stmt = $db->prepare("INSERT INTO partner_statistic (user_id, partner_id, head_id, sponsor_id, e_mail, password_hash, password_reset_token, first_name, last_name, street, house_number, house_number_appendix, city, country, location, work_location_zip, zip, phone_number, mobile_number, gender, birth_date, role, electricity_customers, gas_customers, mobile_communication_customers, registered_customers, dsl_customers, locked, locked_reason_id, branch_path, rank, next_rank, all_confirmed_units, confirmed_units, not_confirmed_units, confirmed_units_without_provision, available_balance, own_earned_balance, team_earned_balance, own_total_earned_balance, team_total_earned_balance, payed_out_balance, energy_revenue, dsl_revenue, mobile_communication_revenue, gas_revenue, xpress_bonus_revenue, total_xpress_bonus_revenue, branch_size_last_month, new_direct_branches_this_month, registration_license_paid, gtc_accepted, privacy_policy_accepted, newsletter_subscribed, show_rank_up_notification, active_status, registration_timestamp, green_energy_contract_units, insertion_timestamp) SELECT user_id, partner_id, head_id, sponsor_id, e_mail, password_hash, password_reset_token, first_name, last_name, street, house_number, house_number_appendix, city, country, location, work_location_zip, zip, phone_number, mobile_number, gender, birth_date, role, electricity_customers, gas_customers, mobile_communication_customers, registered_customers, dsl_customers, locked, locked_reason_id, branch_path, rank, next_rank, all_confirmed_units, confirmed_units, not_confirmed_units, confirmed_units_without_provision, available_balance, own_earned_balance, team_earned_balance, own_total_earned_balance, team_total_earned_balance, payed_out_balance, energy_revenue, dsl_revenue, mobile_communication_revenue, gas_revenue, xpress_bonus_revenue, total_xpress_bonus_revenue, branch_size_last_month, new_direct_branches_this_month, registration_license_paid, gtc_accepted, privacy_policy_accepted, newsletter_subscribed, show_rank_up_notification, active_status, registration_timestamp, green_energy_contract_units, CURRENT_TIMESTAMP FROM partner");
    $stmt->execute();
}

function resetAllUserStatsFromMonth()
{
    $db = DbConNew();
    $stmt = $db->prepare("UPDATE partner SET total_xpress_bonus_revenue = (total_xpress_bonus_revenue + xpress_bonus_revenue), xpress_bonus_revenue = 0, all_confirmed_units = (all_confirmed_units + confirmed_units + confirmed_units_without_provision + green_energy_contract_units), green_energy_contract_units = 0,  confirmed_units = 0, confirmed_units_without_provision = 0");
    $stmt->execute();
}

function getAllPartners()
{
    $db = DbConNew($_SESSION["dbData"]);
    $stmt = $db->prepare("SELECT user_id FROM partner");
    $stmt->execute();
    $users = $stmt->fetchAll();
    return $users;
}

function generationBonus()
{
}

function payPartnerLicense($userId)
{
    //payment api etc

    try {
        $units = 2;
        $units = floatval($units);
        $db = DbConNew($_SESSION["dbData"]);
        $stmt = $db->prepare("UPDATE partner SET confirmed_units_without_provision = (confirmed_units_without_provision + :units), registration_license_paid = 'paid' WHERE user_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":units", $units);
        $stmt->execute();

        $stmt = $db->prepare("INSERT INTO other_units (user_id, units, units_get_provisioned) VALUES (:userId, :units, 0)");
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":units", $units);
        $stmt->execute();

        $stmt = $db->prepare("SELECT head_id FROM partner WHERE user_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $userData = $stmt->fetch();
        $stmt = $db->prepare("UPDATE partner SET confirmed_units = (confirmed_units + :units) WHERE user_id = :headId");
        $stmt->bindParam(":headId", $userData["head_id"]);
        $stmt->bindParam(":units", $units);
        $stmt->execute();

        $stmt = $db->prepare("INSERT INTO other_units (user_id, units, units_get_provisioned) VALUES (:headId, :units, 1)");
        $stmt->bindParam(":headId", $userData["head_id"]);
        $stmt->bindParam(":units", $units);
        $stmt->execute();

        return json_encode(array("unitsGiven" => "success"));
    } catch (\Throwable $th) {
        return json_encode(array("unitsGiven" => "failed"));
    }
    //give partner the units
    // return givePartnerUnits($userId, 2);
}


function givePartnerUnits($userId, $units)
{
}


function checkActiveStatus($userIds)
{

    foreach ($userIds as $userId) {
        $userId = $userId["user_id"];
    }
}

// include_once("inc_userAdministration.php");
// resetActiveStatus();
// resetAllUserUnitsFromMonth(1634579107830);
// directSalesDifferenceBonus(1634645411050);
// directSalesDifferenceBonus(1634579169420, 3);

// directSalesBonus(getAllPartners());
// directSalesDifferenceBonus(getAllPartners());

// echo "test";
// createPartnerStatistic();
function monthlyBilling()
{
    try {
        $allPartners = getAllPartners();
        setRanks($allPartners);
        regionalBonus();
        directSalesBonus($allPartners);
        directSalesDifferenceBonus($allPartners);
        createPartnerStatistic();
        resetAllUserStatsFromMonth();
        echo "done";
        return json_encode(array("monthlyBillingCompleted" => "success"));
    } catch (\Throwable $th) {
        echo $th;
        return json_encode(array("monthlyBillingCompleted" => "failed"));
    }
}
// monthlyBilling();
function resetPopUpNotification($userId)
{
    $db = DbConNew();
    $stmt = $db->prepare("UPDATE partner SET show_rank_up_notification = 0 WHERE user_id = :userId");
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    return "test";
}

function createPayOutPartner($userId, $amount)
{
    $amount = (float) $amount;
    if (!filter_var($amount, FILTER_VALIDATE_FLOAT)) return false;
    $amount = str_replace($amount, ",", ".");
    $db = DbConNew();
    $stmt = $db->prepare("SELECT available_balance, (SELECT SUM(amount) FROM pay_out WHERE user_id = :userId) amountOfNotAvailable FROM partner WHERE user_id = :userId");
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    $userData = $stmt->fetch();

    if (!$userData || ($userData["available_balance"] - $userData["amountOfNotAvailable"]) < $amount) return false;

    $stmt = $db->prepare("INSERT INTO pay_out (user_id, user_type, amount) VALUES (:userId, 'partner', :amount)");
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":amount", $amount);
    $stmt->execute();

    $stmt = $db->prepare("UPDATE partner SET available_balance = (available_balance - :amount) WHERE user_id = :userId");
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":amount", $amount);
    $stmt->execute();

    echo "finished";
    return json_encode(array("maxAvailableBalance" => $userData["available_balance"] - $userData["amountOfNotAvailable"]));
}

function getAvailableBalanceForTransferring($userId)
{
    $db = DbConNew();
    $stmt = $db->prepare("SELECT available_balance, (SELECT SUM(amount) FROM pay_out WHERE user_id = :userId AND status != 'rejected' AND status != 'transferred') amountOfNotAvailable FROM partner WHERE user_id = :userId");
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    $userData = $stmt->fetch();

    return json_encode(array("maxAvailableBalanceForTransferring" => ($userData["available_balance"] - $userData["amountOfNotAvailable"])));
}

function getPayOutHistory($userId)
{
    $db = DbConNew();
    $stmt = $db->prepare("SELECT po.id, po.status, po.amount, po.request_timestamp, po.transferred_timestamp FROM pay_out po   WHERE user_id = :userId");
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    $payOutHistory = $stmt->fetchAll();
    return json_encode($payOutHistory, JSON_UNESCAPED_UNICODE);
}

// echo "test";
// createPayOutPartner(1635497012080, "27,3");
// print_r(getPartnerDashboardProvisions(1634792418190));
