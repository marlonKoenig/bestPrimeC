<?php

include_once("inc_useful.php");
$GLOBALS["energyLogoLinks"] = array("eon" => "eon.png", "vattenfall" => "vattenfall.png", "O2" => "O2_logo.jpeg");

function getEnergyOffers($userData)
{
    try {
        $offers = array();
        $db = DbConNew($_SESSION["dbData"]);
        $stmt = $db->prepare("SELECT id, id_name, monthly_cost, display_name, notice_period, contract_period, company, units, price_per_kwh, special, type FROM energy_tariff ORDER BY price_per_kwh ASC");
        $stmt->execute();
        while ($offer = $stmt->fetch()) {
            $offerArr = array("supplier_logoLink" => $GLOBALS["energyLogoLinks"][$offer["company"]], "supplier_tariff" => $offer["display_name"], "supplier_offerNumber" => $offer["id"], "supplier_runTime" => $offer["contract_period"], "supplier_terminationTime" => $offer["notice_period"], "supplier_incomeUnits" => $offer["units"], "supplier_offerType" => $offer["type"]);
            $monthlyCost = ($offer["price_per_kwh"] * $userData["yearlyKwh"]) / 12 + $offer["monthly_cost"];
            $offerArr["supplier_monthlyFee"] = $monthlyCost;
            $offerArr["special"] = json_decode($offer["special"])->special;
            array_push($offers, $offerArr);
        }
        // print_r(json_encode(array("response" => $offers)));
        return json_encode(array("response" => $offers));
    } catch (\Throwable $th) {
        return json_encode(array("response" => array()));
    }
}
// getEnergyOffers(array("yearly_kwh" => "2000"));


function sendContractNotifyToPartner($contractType, $customerId, $partnerId)
{
    try {
        include_once("inc_userAdministration.php");
        $customerData = checkIfUserExistsWithData($customerId);
        $partnerData = checkIfUserExistsWithData($partnerId);
        print_r($partnerId);
        if (!$customerData || !$partnerData) return json_encode(array("partnerNotified" => "failed1"));

        $header[] = 'MIME-Version: 1.0';
        $header[] = 'Content-type: text/html; charset=iso-8859-1';
        $salutation = $GLOBALS["gender"][$partnerData["gender"]];
        $message = "<html><body>Hallo {$salutation} {$partnerData["last_name"]},<br><br>
        Ihr Kunde {$GLOBALS["gender"][$customerData["gender"]]} {$customerData["last_name"]} möchte bitte ein Angebot im Bereich $contractType erhalten.
        <br><br>
        E-Mail Adresse von {$GLOBALS["gender"][$customerData["gender"]]} {$customerData["last_name"]}: {$customerData["e_mail"]}<br><br>
        Mit freundlichen Grüßen<br>
        Ihr Team
        <body></html>";

        if (!mail($partnerData["e_mail"], "Vertragsoptimierung angefragt", $message,  implode("\r\n", $header))) return json_encode(array("partnerNotified" => "failed2"));
        json_encode(array("partnerNotified" => "success"));
    } catch (\Throwable $th) {
        return json_encode(array("partnerNotified" => "failed3"));
    }
}


function addContract($contractData)
{
    $table = $contractData["type"] . "_contract";
    $db = DbConNew();


    $stmt = $db->prepare("SELECT customer_id FROM energy_contract WHERE customer_id = :customerId");
    $stmt->bindParam(":customerId", $contractData['userId']);
    $stmt->execute();
    $addNum = 0;
    if (!$stmt->fetch()) {
        $addNum = 1;
    }


    $stmt = $db->prepare("INSERT INTO $table (head_id, customer_id, units, product_id, responsible_head_id) VALUES (:head_id, :customer_id, :units, :product_id, :head_id)");
    $stmt->bindParam(":head_id", $contractData["headId"]);
    $stmt->bindParam(":customer_id", $contractData["userId"]);
    $stmt->bindParam(":units", $contractData["units"]);
    $stmt->bindParam(":product_id", $contractData["productId"]);
    $stmt->execute();



    // $db = DbConNew();
    // $stmt = $db->prepare("UPDATE partner SET not_confirmed_units = (not_confirmed_units + :units), electricity_customers = (electricity_customers + 1) WHERE user_id = :userId");
    // $stmt->bindParam(":userId", $contractData["headId"]);
    // $stmt->bindParam(":units", $contractData["units"]);
    // $stmt->execute();


    return json_encode(array("contractCreated" => "success"));
}


function getAllOpenContracts($contractId = null)
{
    $addWhere = $contractId ? " AND c.id = $contractId " : "";
    $arr = array();
    $db = DbConNew();
    $stmt = $db->prepare("SELECT c.id, c.customer_id, t.company_display_name, c.active, c.registration_timestamp, c.product_id, cus.first_name customerFirstName, cus.last_name customerLastName, t.display_name FROM energy_contract c LEFT JOIN energy_tariff t ON t.id = c.product_id LEFT JOIN customer cus ON cus.user_id = c.customer_id WHERE approved = 0 $addWhere");
    $stmt->execute();
    while ($data = $stmt->fetch()) {
        $da = array();
        $da["user_id"] = $data["customer_id"];
        $da["user_salutation"] = "";
        $da["user_firstName"] = $data["customerFirstName"];
        $da["user_surName"] = $data["customerLastName"];
        $da["order_type"] = "Strom";
        $da["order_status"] = $data["active"];
        $da["order_fault"] = "";
        $da["order_id"] = $data["id"];
        $da["order_product"] = $data["display_name"];
        $da["order_dealer"] = $data["company_display_name"];
        $da["order_date"] = date("d.m.Y", strtotime($data["registration_timestamp"]));
        $da["order_start"] = "";
        $da["contract_document"] = "Auftragt vorhanden";
        $da["contract_link"] = "";
        array_push($arr, $da);
        if ($contractId) return json_encode($da, JSON_UNESCAPED_UNICODE);
    }
    return json_encode($arr, JSON_UNESCAPED_UNICODE);
}


function confirmContract($contractId)
{
    $db = DbConNew();
    $stmt = $db->prepare("UPDATE energy_contract SET active = 1, approved = 1, provider_provision_received = 1 WHERE id = :contract_id");
    $stmt->bindParam(":contract_id", $contractId);
    $stmt->execute();

    $stmt = $db->prepare("SELECT head_id, units FROM energy_contract WHERE id = :contract_id");
    $stmt->bindParam(":contract_id", $contractId);
    $stmt->execute();
    $head = $stmt->fetch();

    $stmt = $db->prepare("UPDATE partner SET green_energy_contract_units = (green_energy_contract_units + :units) WHERE user_id = :userId");
    $stmt->bindParam(":userId", $head["head_id"]);
    $stmt->bindParam(":units", $head["units"]);
    $stmt->execute();

    return json_encode(array("contractConfirmed" => "success"));
}
