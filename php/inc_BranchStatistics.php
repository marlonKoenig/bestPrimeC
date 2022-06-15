<?php
include_once('inc_useful.php');
// include_once("inc_DbCon.php");
/** getBranches
 * Gets all direct and indirect branches of a user
 * @param $users contains the 13 long userid comma separated
 * 
 * @return string $dbData json_encoded number of direct and indirect branches of the user
 */
function getBranchesForUser($userId)
{
    $db = DbConNew();
    $likeTerm = "%$userId%";
    $stmt = $db->prepare("SELECT  COUNT(CASE WHEN head_id != :userId AND user_id != :userId THEN 1 END) as indirectBranches, COUNT(CASE WHEN head_id = :userId AND user_id != :userId THEN 1 END) as directBranches  FROM partner WHERE head_id = :userId OR branch_path LIKE :likeTerm");
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":likeTerm", $likeTerm);
    $stmt->execute();
    $dbData = $stmt->fetch();
    $dbData = json_encode(array("userId" => $userId, "indirectBranches" => $dbData["indirectBranches"], "directBranches" => $dbData["directBranches"], "totalBranches" => $dbData["indirectBranches"] + $dbData["directBranches"]));
    $db = NULL;
    return $dbData;
}


function getAllUsersFromBranch($userId)
{
    $db = DbConNew();
    $likeTerm = "%$userId%";
    $stmt = $db->prepare("SELECT user_id, head_id, first_name, last_name FROM partner WHERE head_id = :userId OR branch_path LIKE :likeTerm");
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":likeTerm", $likeTerm);
    $stmt->execute();
    $data = $stmt->fetchAll();
    // print_r($data);
    return $data;
}

function getTotalBranchUnitsAndEarnedBalance($userId)
{
    $db = DbConNew();
    $likeTerm = "%$userId%";
    $stmt = $db->prepare("SELECT SUM(CASE WHEN user_id = :userId THEN all_confirmed_units ELSE 0 END) as ownAllUnits, SUM(CASE WHEN user_id != :userId THEN all_confirmed_units ELSE 0 END) as indirectBranchesAllUnits, SUM(CASE WHEN user_id = :userId THEN (own_total_earned_balance) ELSE 0 END) as ownTotalEarnings, SUM(CASE WHEN user_id = :userId THEN (team_total_earned_balance) ELSE 0 END) as indirectBranchesTotalEarnings  FROM partner WHERE head_id = :userId OR branch_path LIKE :likeTerm");
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":likeTerm", $likeTerm);
    $stmt->execute();
    return json_encode($stmt->fetch());
}


function getAllUnitsFromBranch($userId, $timeSpan = "")
{
    $timeSpanSql = "";
    $timeSpanSql2 = "";
    switch ($timeSpan) {
        case 'currentMonth':
            $timeSpanSql = "AND MONTH(provision_paid_out_timestamp) = MONTH(CURRENT_DATE()) AND YEAR(provision_paid_out_timestamp) = YEAR(CURRENT_DATE())";
            $timeSpanSql2 = "AND MONTH(o.registration_timestamp) = MONTH(CURRENT_DATE()) AND YEAR(o.registration_timestamp) = YEAR(CURRENT_DATE())";
            break;
        case 'currentDay':
            $timeSpanSql = "AND DAY(provision_paid_out_timestamp) = DAY(CURRENT_DATE()) AND MONTH(provision_paid_out_timestamp) = MONTH(CURRENT_DATE()) AND YEAR(provision_paid_out_timestamp) = YEAR(CURRENT_DATE())";
            $timeSpanSql2 = "AND DAY(o.registration_timestamp) = DAY(CURRENT_DATE()) AND MONTH(o.registration_timestamp) = MONTH(CURRENT_DATE()) AND YEAR(o.registration_timestamp) = YEAR(CURRENT_DATE())";
            break;

        default:
            # code...
            break;
    }

    // echo $timeSpanSql;
    $db = DbConNew();
    $returnArr = array();
    $queryString = getAllUnitsString($timeSpanSql, $timeSpanSql2);
    $likeTerm = "%$userId%";
    $stmt = $db->prepare("SELECT $queryString  FROM partner p WHERE head_id = :userId OR branch_path LIKE :likeTerm");
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":likeTerm", $likeTerm);
    $stmt->execute();
    $data = $stmt->fetch();

    $returnArr["totalOwnOpenUnits"] = $data["ownOpenUnits_energy_contract"] + $data["ownOpenUnits2"];
    $returnArr["totalIndirectOpenUnits"] = $data["indirectBranchOpenUnits_energy_contract"] + $data["indirectBranchOpenUnits2"];
    $returnArr["totalOwnClosedUnits"] = $data["ownClosedUnits_energy_contract"] + $data["ownClosedUnits2"];
    $returnArr["totalIndirectClosedUnits"] = $data["indirectBranchClosedUnits_energy_contract"] + $data["indirectBranchClosedUnits2"];

    if ($timeSpan != "") {
        $returnArr["totalOwnClosedUnits"] = $data["ownClosedUnits_energy_contract"] + $data["otherOwnUnits"];
        $returnArr["totalIndirectClosedUnits"] = $data["indirectBranchClosedUnits_energy_contract"] + $data["otherIndirectUnits"];
        // if ($timeSpan == "x") {
        //     echo $data["otherIndirectUnits"];
        // }
    }


    return $returnArr;
}


function getAllUnitsString($timeSpanSql, $timeSpanSql2)
{
    $tables = array("energy_contract", "dsl_contract", "mobile_communication_contract", "gas_contract");
    $sqlQueryString = array();
    foreach ($tables as $table) {
        $allDirectOpenUnits2 = "ownOpenUnits2";
        $allIndirectOpenUnits2 = "indirectBranchOpenUnits2";
        $allDirectClosedUnits2 = "ownClosedUnits2";
        $allIndirectClosedUnits2 = "indirectBranchClosedUnits2";
        $allDirectOpenUnits = "ownOpenUnits" . "_$table";
        $allIndirectOpenUnits = "indirectBranchOpenUnits" . "_$table";
        $allDirectClosedUnits = "ownClosedUnits" . "_$table";
        $allIndirectClosedUnits = "indirectBranchClosedUnits" . "_$table";
        array_push($sqlQueryString, "(SELECT SUM(units) FROM other_units o LEFT JOIN partner p ON p.user_id = o.user_id WHERE p.branch_path LIKE :likeTerm AND o.user_id = :userId $timeSpanSql2) as otherOwnUnits, (SELECT SUM(units) FROM other_units o LEFT JOIN partner p ON p.user_id = o.user_id WHERE p.branch_path LIKE :likeTerm AND o.user_id != :userId $timeSpanSql2) as otherIndirectUnits, SUM(CASE WHEN user_id = :userId THEN (confirmed_units + confirmed_units_without_provision + not_confirmed_units) END) as $allDirectOpenUnits2, (SELECT SUM(units) FROM $table WHERE responsible_head_id = :userId AND provision_paid_out_timestamp IS NULL) as $allDirectOpenUnits, SUM(CASE WHEN user_id != :userId THEN (confirmed_units + confirmed_units_without_provision + not_confirmed_units) END) as $allIndirectOpenUnits2, (SELECT SUM(units) FROM $table c LEFT JOIN partner p ON p.user_id = c.responsible_head_id WHERE p.branch_path LIKE :likeTerm AND responsible_head_id != :userId AND provision_paid_out_timestamp IS NULL) as $allIndirectOpenUnits, SUM(CASE WHEN user_id = :userId THEN (all_confirmed_units) END) as $allDirectClosedUnits2, (SELECT SUM(units) FROM $table WHERE responsible_head_id = :userId AND provision_paid_out_timestamp IS NOT NULL $timeSpanSql) as $allDirectClosedUnits, SUM(CASE WHEN user_id != :userId THEN (all_confirmed_units) END) as $allIndirectClosedUnits2, (SELECT SUM(units) FROM $table c LEFT JOIN partner p ON p.user_id = c.responsible_head_id WHERE p.branch_path LIKE :likeTerm AND responsible_head_id != :userId AND provision_paid_out_timestamp IS NOT NULL $timeSpanSql) as $allIndirectClosedUnits");
    }
    return implode(", ", $sqlQueryString);
}

function getBestBranchOfUserUnits($userId)
{
    $bestBranches = array();
    $db = DbConNew($_SESSION["dbData"]);
    $likeTerm = "%$userId%";
    $stmt = $db->prepare("SELECT first_name, last_name, (confirmed_units + confirmed_units_without_provision) as units, location FROM partner WHERE (head_id = :userId OR branch_path LIKE :likeTerm) AND user_id != :userId AND (confirmed_units > 0 OR confirmed_units_without_provision > 0) ORDER BY units DESC");
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":likeTerm", $likeTerm);
    $stmt->execute();
    while ($user = $stmt->fetch()) {
        $branch = array();
        $branch["userName"] = $user["first_name"] . " " . $user["last_name"];
        $branch["units"] = $user["units"];
        $branch["location"] = $user["location"];
        array_push($bestBranches, $branch);
    }
    // print_r($bestBranches);
    return json_encode($bestBranches, JSON_UNESCAPED_UNICODE);
}
function getBestBranchOfUserDirectBranches($userId)
{
    $bestBranches = array();
    $db = DbConNew($_SESSION["dbData"]);
    $likeTerm = "%$userId%";
    $stmt = $db->prepare("SELECT first_name, last_name, (new_direct_branches_this_month) as newDirectBranches, location FROM partner WHERE (head_id = :userId OR branch_path LIKE :likeTerm) AND user_id != :userId AND new_direct_branches_this_month > 0 ORDER BY newDirectBranches DESC");
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":likeTerm", $likeTerm);
    $stmt->execute();
    while ($user = $stmt->fetch()) {
        $branch = array();
        $branch["userName"] = $user["first_name"] . " " . $user["last_name"];
        $branch["newDirectBranches"] = $user["newDirectBranches"];
        $branch["location"] = $user["location"];
        array_push($bestBranches, $branch);
    }
    // print_r($bestBranches);
    return json_encode($bestBranches, JSON_UNESCAPED_UNICODE);
}

function getMyTeamPageData($userId)
{
    $branches = (array) json_decode(getBranchesForUser($userId));
    $rank = (array) json_decode(getNextRank($userId));
    $balance = (array) json_decode(getBalance($userId));
    $branchSize = (array) json_decode(getBranchGrowth($userId));
    $data = array_merge($branches, $rank, $balance, $branchSize);
    return json_encode($data);
}

function getCurrentProvisionsPageData($userId)
{
    include_once("./billing.php");
    $expectedProvisions = getPartnerExpectedProvisions($userId);
    $balance = (array) json_decode(getBalance($userId));
}

function getBranchGrowth($userId)
{
    $db = DbConNew($_SESSION["dbData"]);
    $stmt = $db->prepare("SELECT branch_size_last_month, new_direct_branches_this_month FROM partner WHERE user_id = :userId");
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    $branchSize = $stmt->fetch();
    $branchSizeGrowth = $branchSize["new_direct_branches_this_month"] >= $branchSize["branch_size_last_month"] ? $branchSize["new_direct_branches_this_month"] - $branchSize["branch_size_last_month"] : 0;
    return json_encode(array("branchSizeGrowthToLastMonth" => $branchSizeGrowth));
}

function getNextRank($userId)
{
    $db = DbConNew($_SESSION["dbData"]);
    $stmt = $db->prepare("SELECT r.rank_display_name, r.units_needed, p.confirmed_units, p.all_confirmed_units, p.confirmed_units_without_provision FROM partner p LEFT JOIN partner_rank r ON r.rank_id_name = p.next_rank WHERE p.user_id = :userId LIMIT 1");
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    $rank = $stmt->fetch();
    $allUnits = $rank["confirmed_units"] + $rank["all_confirmed_units"] + $rank["confirmed_units_without_provision"];
    $missingUnits = $rank["units_needed"] > $allUnits ? $rank["units_needed"] - $allUnits : 0;
    return json_encode(array("nextRankDisplayName" => $rank["rank_display_name"], "missingUnitsToNextRank" => $missingUnits));
}

function getBalance($userId)
{
    $db = DbConNew($_SESSION["dbData"]);
    $stmt = $db->prepare("SELECT available_balance, own_total_earned_balance, team_total_earned_balance FROM partner WHERE user_id = :userId LIMIT 1");
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    $balance = $stmt->fetch();

    return json_encode(array("availableBalance" => $balance["available_balance"], "totalEarnedBalance" => $balance["own_total_earned_balance"] + $balance["team_total_earned_balance"], "ownTotalEarnedBalance" => $balance["own_total_earned_balance"], "teamTotalEarnedBalance" => $balance["team_total_earned_balance"]));
}

function getDirectBranchesPartnerData($userId, $specificSubPartnerId = null)
{
    $addWhere = $specificSubPartnerId ? " WHERE user_id = :specificSubPartnerId " : "WHERE p.head_id = :userId";
    $branches = array();
    $db = DbConNew($_SESSION["dbData"]);
    $stmt = $db->prepare("SELECT p.user_id, p.partner_id, p.confirmed_units, p.all_confirmed_units, p.confirmed_units_without_provision, pr.rank_display_name, p.e_mail, p.first_name, p.last_name, p.registration_timestamp, p.location, (SELECT COUNT(partner_id) FROM partner WHERE head_id = p.user_id) as directBranchSubBranches, (SELECT CONCAT(first_name, ' ', last_name) FROM partner WHERE user_id = p.sponsor_id) as sponsorName  FROM partner p LEFT JOIN partner_rank pr ON pr.rank_id_name = p.rank $addWhere");

    if ($specificSubPartnerId) {
        $stmt->bindParam(":specificSubPartnerId", $userId);
    } else {
        $stmt->bindParam(":userId", $userId);
    }
    $stmt->execute();
    while ($branch = $stmt->fetch()) {

        $branchArr = array();
        $userBranchInfo = (array) json_decode(getBranchesForUser($branch["user_id"]));
        $userRankInfo = (array) json_decode(getNextRank($branch["user_id"]));
        unset($userBranchInfo["userId"]);

        $branchArr["directBranchSubBranches"] = $branch["directBranchSubBranches"];
        $branchArr["user_id"] = $branch["user_id"];
        $branchArr["partner_id"] = $branch["partner_id"];
        $branchArr["sponsorName"] = $branch["sponsorName"];
        $branchArr["email"] = $branch["e_mail"];
        $branchArr["firstName"] = $branch["first_name"];
        $branchArr["lastName"] = $branch["last_name"];
        $branchArr["regDate"] = $branch["registration_timestamp"];
        $branchArr["rank"] = $branch["rank_display_name"];
        $branchArr["user_workPlace"] = $branch["location"];
        $branchArr["user_license"] = true;
        $branchArr["user_status"] = true;


        $branchArr = array_merge($branchArr, $userBranchInfo, $userRankInfo);
        array_push($branches, $branchArr);
    }

    return json_encode($branches, JSON_UNESCAPED_UNICODE);
}

function getBranchUnitsWithProvision($userId)
{
    $db = DbConNew();
    $stmt = $db->prepare("
    SELECT *
    FROM (select user_id, head_id from partner) partner_sorted,
        (select @pv := '1111111111111') initialisation
    WHERE head_id = @pv
        

    ");
    // $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    $dbData = $stmt->fetchAll();
    $db = NULL;
    print_r($dbData);
    return $dbData;
}

function getRevenueContractsString()
{
    $tables = array("energy_contract", "dsl_contract", "mobile_communication_contract", "gas_contract");
    $columns = array("energy_revenue", "dsl_revenue", "mobile_communication_revenue", "gas_revenue");
    $sqlQueryString = array();
    $counter = 0;
    foreach ($tables as $table) {
        $queryVarName = "own_" .  $table . "_revenue";
        $queryVarName2 = "team_" .  $table . "_revenue";
        // array_push($sqlQueryString, "(SELECT SUM(paid_out_provision) FROM $table WHERE provision_paid_out_timestamp IS NOT NULL AND provision_receiver_id = :userId) as $queryVarName, (SELECT SUM(paid_out_provision) FROM $table c LEFT JOIN partner p ON p.user_id = c.provision_receiver_id WHERE p.branch_path LIKE :likeTerm AND provision_receiver_id != :userId AND provision_paid_out_timestamp IS NOT NULL) as $queryVarName2");
        array_push($sqlQueryString, "SUM(CASE WHEN user_id = :userId THEN {$columns[$counter]} END) as $queryVarName, SUM(CASE WHEN user_id != :userId THEN {$columns[$counter]} END) as $queryVarName2");
        $counter++;
    }
    return implode(", ", $sqlQueryString);
}
function getRevenueForTimespan($userId, $timePeriod = "")
{
    $revenueContractsString = getRevenueContractsString();
    $likeTerm = "%$userId%";
    // $timePeriod = "";

    switch ($timePeriod) {
        case 'thisMonth':
            $date = date('Y-m-01 00:00:00');
            $timePeriod = " AND insertion_timestamp >= '$date' ";
            break;
        case 'lastMonth':
            $firstOfLastMonth = date('Y-m-d 00:00:00', strtotime('first day of last month'));
            $lastOfLastMonth = date('Y-m-d 00:00:00', strtotime('last day of last month'));
            $timePeriod = " AND insertion_timestamp >= '$firstOfLastMonth' AND insertion_timestamp <= '$lastOfLastMonth' ";
            break;
        case 'lastThreeMonths':
            $firstOfLastThreeMonth = date('Y-m-01 00:00:00', strtotime('-3 month', time()));
            $timePeriod = " AND insertion_timestamp >= '$firstOfLastThreeMonth'  ";
            break;
        case 'lastSixMonths':
            $firstOfLastSixMonth = date('Y-m-01 00:00:00', strtotime('-6 month', time()));
            $timePeriod = " AND insertion_timestamp >= '$firstOfLastSixMonth'  ";
            break;
            // case 'lastMonth':
            //     $date = date('Y-m-01 00:00:00');
            //     $timePeriod = " AND insertion_timestamp >= $date ";
            //     break;

        default:
            $timePeriod = "";
            break;
    }

    $db = DbConNew();
    $stmt = $db->prepare("SELECT $revenueContractsString , SUM(CASE WHEN user_id = :userId THEN xpress_bonus_revenue END) as own_xpress_bonus_revenue, SUM(CASE WHEN user_id != :userId THEN xpress_bonus_revenue END) as team_xpress_bonus_revenue FROM partner_statistic WHERE (user_id = :userId OR branch_path LIKE :likeTerm) $timePeriod");
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":likeTerm", $likeTerm);
    $stmt->execute();
    $data = $stmt->fetch();

    $data["ownTotalRevenue"] = $data["own_energy_contract_revenue"] + $data["own_dsl_contract_revenue"] + $data["own_mobile_communication_contract_revenue"] + $data["own_gas_contract_revenue"] + $data["own_xpress_bonus_revenue"];
    $data["teamTotalRevenue"] = $data["team_energy_contract_revenue"] + $data["team_dsl_contract_revenue"] + $data["team_mobile_communication_contract_revenue"] + $data["team_gas_contract_revenue"] + $data["team_xpress_bonus_revenue"];
    $data["totalRevenue"] = $data["ownTotalRevenue"] + $data["teamTotalRevenue"];
    $data["total_energy_contract_revenue"] = $data["own_energy_contract_revenue"] + $data["team_energy_contract_revenue"];
    $data["total_dsl_contract_revenue"] = $data["own_dsl_contract_revenue"] + $data["team_dsl_contract_revenue"];
    $data["total_mobile_communication_contract_revenue"] = $data["own_mobile_communication_contract_revenue"] + $data["team_mobile_communication_contract_revenue"];
    $data["total_gas_contract_revenue"] = $data["own_gas_contract_revenue"] + $data["team_gas_contract_revenue"];
    $data["total_xpress_bonus_revenue"] = $data["own_xpress_bonus_revenue"] + $data["team_xpress_bonus_revenue"];

    return json_encode($data);
}
// getRevenueForTimespan(1635346547360);

// getBranchUnitsWithProvision("1111111111111");
/** getBranchCustomerAreas
 * Gets for all the areas (energy, dsl etc) the number of customers for the filial and the direct/indirect filials
 * @param $userId contains the 13 long userid
 * 
 * @return string $branchStatistics json_encoded 
 */
function getBranchCustomerAreaStatistics($userId)
{
    $db = DbConNew();
    $likeTerm = "%$userId%";
    $ownTotalCustomers                  = 0;
    $ownElectricityCustomers            = 0;
    $ownMobileCommunicationCustomers    = 0;
    $ownGasCustomers                    = 0;
    $ownAllCustomers                    = 0;
    $ownDslCustomers                    = 0;
    $teamTotalCustomers                 = 0;
    $teamElectricityCustomers           = 0;
    $teamMobileCommunicationCustomers   = 0;
    $teamGasCustomers                   = 0;
    $teamAllCustomers                   = 0;
    $teamDslCustomers                   = 0;

    $stmt = $db->prepare("SELECT user_id, (SELECT COUNT(head_id) FROM energy_contract WHERE responsible_head_id = :userId ) as ownEnergyCustomers, (SELECT COUNT(c.head_id) FROM energy_contract c LEFT JOIN partner p ON p.user_id = c.responsible_head_id WHERE responsible_head_id != :userId AND p.branch_path LIKE :likeTerm) as teamEnergyCustomers, (SELECT COUNT(head_id) FROM dsl_contract WHERE responsible_head_id = :userId ) as ownDslCustomers, (SELECT COUNT(c.head_id) FROM dsl_contract c LEFT JOIN partner p ON p.user_id = c.responsible_head_id WHERE responsible_head_id != :userId AND p.branch_path LIKE :likeTerm) as teamDslCustomers, (SELECT COUNT(head_id) FROM mobile_communication_contract WHERE responsible_head_id = :userId ) as ownMobileCommunicationCustomers, (SELECT COUNT(c.head_id) FROM mobile_communication_contract c LEFT JOIN partner p ON p.user_id = c.responsible_head_id WHERE responsible_head_id != :userId AND p.branch_path LIKE :likeTerm) as teamMobileCommunicationCustomers, (SELECT COUNT(head_id) FROM gas_contract WHERE responsible_head_id = :userId ) as ownGasCustomers, (SELECT COUNT(c.head_id) FROM gas_contract c LEFT JOIN partner p ON p.user_id = c.responsible_head_id WHERE responsible_head_id != :userId AND p.branch_path LIKE :likeTerm) as teamGasCustomers, (SELECT COUNT(head_id) FROM customer WHERE head_id = :userId ) as ownAllCustomers, (SELECT COUNT(c.head_id) FROM customer c LEFT JOIN partner p ON p.user_id = c.head_id WHERE c.head_id != :userId AND p.branch_path LIKE :likeTerm) as teamAllCustomers FROM partner WHERE user_id = :userId");
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":likeTerm", $likeTerm);
    $stmt->execute();
    $userData = $stmt->fetch();

    $ownCustomerNumber = $userData["ownEnergyCustomers"] + $userData["ownDslCustomers"] + $userData["ownMobileCommunicationCustomers"] + $userData["ownGasCustomers"];
    $teamCustomerNumber = $userData["teamEnergyCustomers"] + $userData["teamDslCustomers"] + $userData["teamMobileCommunicationCustomers"] + $userData["teamGasCustomers"];

    $ownStatistics      = array("user_ownCustomerNumber"  => $ownCustomerNumber, "user_ownPowerCustomerNumber"   => $userData["ownEnergyCustomers"], "user_ownMobileCustomerNumber"   => $userData["ownMobileCommunicationCustomers"], "user_ownAllCustomerNumber"   => $userData["ownAllCustomers"], "user_ownDslCustomerNumber"   => $userData["ownDslCustomers"], "user_ownGasCustomerNumber"   => $userData["ownGasCustomers"]);
    $teamStatistics     = array("user_childCustomerNumber" => $teamCustomerNumber, "user_childPowerCustomerNumber" => $userData["teamEnergyCustomers"], "user_childMobileCustomerNumber" => $userData["teamMobileCommunicationCustomers"], "user_childAllCustomerNumber" => $userData["teamAllCustomers"], "user_childDslCustomerNumber" => $userData["teamDslCustomers"], "user_childGasCustomerNumber" => $userData["teamGasCustomers"]);
    // $totalStatistics    = array("totalCustomers" => ($ownTotalCustomers + $teamTotalCustomers), "totalElectricityCustomers" => ($ownElectricityCustomers + $teamElectricityCustomers), "totalMobileCommunicationCustomers" => ($ownMobileCommunicationCustomers + $teamMobileCommunicationCustomers), "totalAppCustomers" => ($ownAppCustomers + $teamAppCustomers), "totalDslCustomers" => ($ownDslCustomers + $teamDslCustomers), "totalGasCustomers" => ($ownGasCustomers + $teamGasCustomers));

    $branchStatistics = json_encode(array_merge($teamStatistics, $ownStatistics));
    $db = NULL;
    return $branchStatistics;
}

// echo getBranchCustomerAreaStatistics(1);


function getAllCustomersDefault($userId)
{
    try {
        $db = DbConNew();
        $stmt = $db->prepare("SELECT user_id, first_name, last_name, registration_timestamp FROM customer WHERE head_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $emptyValue = NULL;
    } catch (\Throwable $th) {
        return;
    }
}
function getAllContractCustomers($userId, array $contractTables)
{
    try {
        error_reporting(E_ERROR | E_PARSE);
        $contractCustomers = array();
        if (!count($contractTables)) return json_encode($contractCustomers);

        $tables = array("energy" => "energy_contract", "dsl" => "dsl_contract", "mobile_communication" => "mobile_communication_contract");
        $genderMap = array("Herr", "Frau", "Herr/Frau");
        $type = array("energy" => "Energie", "dsl" => "DSL", "mobile_communication" => "Mobilfunk");
        $db = DbConNew();

        foreach ($contractTables as $value) {
            if (!isset($tables[$value])) continue;
            $contractTable = $tables[$value];
            $tariffTable = $value . "_tariff";
            $stmt = $db->prepare("SELECT con.customer_id customerId, con.fault, c.first_name firstName, con.registration_timestamp registrationTimestamp, c.last_name lastName, c.gender, tar.company_display_name companyName, tar.display_name tariffName FROM $contractTable con LEFT JOIN customer c ON c.user_id = con.customer_id LEFT JOIN $tariffTable tar ON tar.id = con.product_id WHERE con.responsible_head_id = :userId");
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            while ($customer = $stmt->fetch()) {
                $customer["fullName"] = $genderMap[$customer["gender"]] . " " . $customer["firstName"] . " " . $customer["lastName"];
                $customer["type"] = $type[$value];
                array_push($contractCustomers, $customer);
            }
        }
        return json_encode($contractCustomers, JSON_UNESCAPED_UNICODE);
    } catch (\Throwable $th) {
        return json_encode($contractCustomers, JSON_UNESCAPED_UNICODE);
    }
}

function getAllCustomersOnline($userId, $customerId = false)
{
    try {
        $addWhere = $customerId ? " and c.user_id = '$customerId' " : "";
        $customers = array();
        $genderMap = array("Herr", "Frau", "Herr/Frau");
        $genderMap2 = array("male", "female", "diverse");
        $db = DbConNew();
        $stmt = $db->prepare("SELECT c.user_id, p.first_name partnerFirstName, p.last_name partnerLastName, c.gender, c.first_name, c.last_name, c.mobile_number, c.phone_number, c.street, c.house_number, c.house_number_appendix, c.city, c.country, c.zip, c.birth_date, c.registration_timestamp, c.contract_energy, c.contract_gas, c.contract_dsl, c.contract_solar, c.contract_mobile, c.e_mail FROM customer c LEFT JOIN partner p ON p.user_id = c.head_id WHERE c.head_id = :userId $addWhere");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        while ($user = $stmt->fetch()) {
            $arr = array();
            $arr["user_id"] = $user["user_id"];
            $arr["customer_dealerName"] = $user["partnerFirstName"] . " " . $user["partnerLastName"];
            $arr["customer_title"] = "";
            $arr["user_salutation"] = $genderMap[$user["gender"]];
            $arr["user_firstName"] = $user["first_name"];
            $arr["user_surName"] = $user["last_name"];
            $arr["user_mobile"] = $user["mobile_number"];
            $arr["customer_phone"] = $user["phone_number"];
            $arr["user_street"] = $user["street"];
            $arr["user_houseNumber"] = $user["house_number"];
            $arr["user_additionalAdress"] = $user["house_number_appendix"];
            $arr["user_zip"] = $user["zip"];
            $arr["user_residence"] = $user["city"];
            $arr["user_country"] = $user["country"];
            $arr["user_sex"] = $genderMap2[$user["gender"]];
            $arr["user_birthDate"] = date("d.m.Y", strtotime($user["birth_date"]));
            $arr["user_regDate"] = date("d.m.Y", strtotime($user["registration_timestamp"]));
            $arr["customer_wallet"] = "";
            $arr["user_email"] = $user["e_mail"];
            $arr["customer_contractPower"] = $user["contract_energy"];
            $arr["customer_contractGas"] = $user["contract_gas"];
            $arr["customer_contractDsl"] = $user["contract_dsl"];
            $arr["customer_contractMobile"] = $user["contract_mobile"];
            $arr["customer_contractSolar"] = $user["contract_solar"];
            $arr["customer_recommendation"] = "";
            $arr["customer_openTicket"] = false;
            array_push($customers, $arr);
            if ($customerId) return json_encode($arr, JSON_UNESCAPED_UNICODE);
        }
        return json_encode($customers, JSON_UNESCAPED_UNICODE);
    } catch (\Throwable $th) {
        return "[]";
    }
}
// getAllCustomersOnline(1634658118720);
// print_r(getDirectBranchesPartnerData(1634809375340, true));
// getBestBranchOfUser(1634792418190);

function getBestPartnersAllTime(array $userIds, $timeSpan)
{
    $partners = array();
    foreach ($userIds as $userId) {
        $partnerUnits = getAllUnitsFromBranch($userId["user_id"], $timeSpan);
        $partnerUnits["userId"] = $userId["user_id"];
        $partnerUnits["partnerName"] = $userId["first_name"] . " " . $userId["last_name"];
        $partnerUnits["units"] = $partnerUnits["totalOwnClosedUnits"] + $partnerUnits["totalIndirectClosedUnits"];
        // echo "<br>user" . $partnerUnits["partnerName"] . "<br>";
        // echo $partnerUnits["units"];
        array_push($partners, $partnerUnits);
    }
    usort($partners, function ($a, $b) {
        return $b['units'] - $a['units'];
    });
    // print_r($partners);
    foreach ($partners as $key => $partner) {
        if ($key > 9) unset($partners[$key]);
    }
    return json_encode($partners, JSON_UNESCAPED_UNICODE);
}

// function getBestPartnersCurrentMonth(array $userIds)
// {
//     $partners = array();
//     foreach ($userIds as $userId) {
//         $partnerUnits = getAllUnitsFromBranch($userId["user_id"], "currentMonth");
//         $partnerUnits["userId"] = $userId["user_id"];
//         $partnerUnits["lastName"] = $userId["last_name"];
//         $partnerUnits["firstName"] = $userId["first_name"];
//         $partnerUnits["totalUnits"] = $partnerUnits["totalOwnClosedUnits"] + $partnerUnits["totalIndirectClosedUnits"];
//         array_push($partners, $partnerUnits);
//     }
//     usort($partners, function ($a, $b) {
//         return $b['totalUnits'] - $a['totalUnits'];
//     });
//     print_r($partners);
//     return $partners;
// }
// getBestPartnersCurrentMonth()
// echo "tset1";
