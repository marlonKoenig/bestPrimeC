<?php
//session_start();
//include_once "inc_functions.php";
$queryArray = json_decode(file_get_contents('php://input'), true);
if (isset($queryArray)) {
    //print 'Array ist angekommen ';
    switch ($queryArray['funktion']) {
        case 'sendWelcome':
            // schreibe die Daten, aus dem Antragsformular für Partner, in die DB 
            return 'sendWelcome kam an. ';
            break;

        case 'sendEnergy':
            // sende die Daten aus dem Stromrechner zur Berechnung ans Backend
            include_once("contractOffers.php");
            $response = getEnergyOffers(array("yearlyKwh" => $queryArray["kwh"]));
            // print_r($queryArray);
            // $response = file_get_contents('../js/comparePower.json');
            if ($queryArray['role'] == 'partner') {
                $answer = @include_once('../partnerbereich/tarifrechner/strom/comparePower.php');
            } elseif ($queryArray['role'] == 'customer') {
                $answer = @include_once('../kundenbereich/optimierung/tarifrechner/strom/comparePower.php');
            }
            return $answer;
            break;
        case 'loadContract':
            // sende die Daten aus dem Stromrechner zur Berechnung ans Backend
            // $response = file_get_contents('../js/singleContract.json');
            include_once("contractOffers.php");
            $response = getAllOpenContracts($queryArray["contractNumber"]);
            $answer = @include_once('../controlling/angebot-checken/loadContract.php');
            return $answer;
            break;
        case 'loadAllContractsFromOneCustomer':
            // lade die Tabelle mit eigenen Verträgen eines Kunden
            // wird aufgerufen durch system.js/loadAllContractsFromOneCustomer
            $customerID = $queryArray["user_id"];
            include_once("inc_branchStatistics.php");
            //$response = getAllCustomersOnline($queryArray["user_id"]);
            $response = file_get_contents('../js/allContractsFromOneCustomer.json');
            $answer = @include_once('../kundenbereich/allContractsFromOneCustomer.php');
            return $answer;
            break;
        case 'loadAllCustomer':
            // sende die Daten aus dem Stromrechner zur Berechnung ans Backend
            include_once("inc_branchStatistics.php");
            $response = getAllCustomersOnline($queryArray["user_id"]);
            $answer = @include_once('../partnerbereich/meine-kunden/allCustomerTable.php');
            return $answer;
            break;
        case 'loadAllCustomerContractList':
            // sende die Daten aus dem Stromrechner zur Berechnung ans Backend
            include_once("inc_branchStatistics.php");
            $response = getAllContractCustomers($queryArray["user_id"], array("energy")); //#TODO: später wenn dsl tabellen etc verfügbar sind diese hier mit eintragen oder * möglich machen
            $answer = @include_once('../partnerbereich/meine-kunden/allCustomerContractTable.php');
            return $answer;
            break;
        case 'loadAllCustomerEnergyContractList':
            // sende die Daten aus dem Stromrechner zur Berechnung ans Backend
            include_once("inc_branchStatistics.php");
            $response = getAllContractCustomers($queryArray["user_id"], array("energy")); //#TODO: später wenn dsl tabellen etc verfügbar sind diese hier mit eintragen oder * möglich machen
            $answer = @include_once('../partnerbereich/meine-kunden/allCustomerContractTable.php');
            return $answer;
            break;
        case 'loadAllCustomerGasContractList':
            // sende die Daten aus dem Stromrechner zur Berechnung ans Backend
            include_once("inc_branchStatistics.php");
            $response = getAllContractCustomers($queryArray["user_id"], array()); //#TODO: später wenn dsl tabellen etc verfügbar sind diese hier mit eintragen oder * möglich machen
            $answer = @include_once('../partnerbereich/meine-kunden/allCustomerContractTable.php');
            return $answer;
            break;
        case 'loadAllCustomerDslContractList':
            // sende die Daten aus dem Stromrechner zur Berechnung ans Backend
            include_once("inc_branchStatistics.php");
            $response = getAllContractCustomers($queryArray["user_id"], array()); //#TODO: später wenn dsl tabellen etc verfügbar sind diese hier mit eintragen oder * möglich machen
            $answer = @include_once('../partnerbereich/meine-kunden/allCustomerContractTable.php');
            return $answer;
            break;
        case 'loadAllCustomerMobileCommunicationContractList':
            // sende die Daten aus dem Stromrechner zur Berechnung ans Backend
            include_once("inc_branchStatistics.php");
            $response = getAllContractCustomers($queryArray["user_id"], array()); //#TODO: später wenn dsl tabellen etc verfügbar sind diese hier mit eintragen oder * möglich machen
            $answer = @include_once('../partnerbereich/meine-kunden/allCustomerContractTable.php');
            return $answer;
            break;

        case 'loadOneCustomer':
            // sende die Daten aus dem Stromrechner zur Berechnung ans Backend
            include_once("inc_branchStatistics.php");
            $response = getAllCustomersOnline($queryArray["user_id"], $queryArray["customer_id"]);
            $answer = @include_once('../partnerbereich/meine-kunden/oneCustomerTable.php');
            return $answer;
            break;
        case 'sendCommissionQuery':
            // sende die Daten aus sendCommissionQuery() auf der Seite "finanzen/aktuelle-provission"
            include_once("billing.php");

            if (isset($queryArray["amount"])) {
                createPayOutPartner($queryArray["user_id"], $queryArray["amount"]);
            }
            $maxAvailableBalanceForTransferring = getAvailableBalanceForTransferring($queryArray["user_id"]);
            $payOutHistory = getPayOutHistory($queryArray["user_id"]);
            $answer = @include_once('../partnerbereich/finanzen/aktuelle-provision/commissionTable.php');
            return $answer;
            break;
        case 'loadAllOnlineCustomer':
            // sende die Daten aus dem Stromrechner zur Berechnung ans Backend
            include_once("inc_branchStatistics.php");
            $response = getAllCustomersOnline($queryArray["user_id"]);
            // $response = file_get_contents('../js/allOwnCustomer.json');
            $answer = @include_once('../partnerbereich/onlineberatung/allCustomerTable.php');
            return $answer;
            break;
        case 'loadOneOnlineCustomer':
            // sende die Daten aus dem Stromrechner zur Berechnung ans Backend
            include_once("inc_branchStatistics.php");
            $response = getAllCustomersOnline($queryArray["user_id"], $queryArray["customer_id"]);
            // $response = file_get_contents('../js/oneCustomer.json');
            $answer = @include_once('../partnerbereich/onlineberatung/oneCustomerTable.php');
            return $answer;
            break;
        case 'insertEnergyTable':
            $customerID = $queryArray['user_id'];
            // print_r($queryArray);
            $answer = @include_once('../partnerbereich/onlineberatung/energyTable.php');
            return $answer;
            break;
        case 'startOrder':
            // leite die Bestellung ein 
            // print_r($queryArray);
            $response = file_get_contents('../js/customerData.json');
            if ($queryArray['role'] == 'partner') {
                $answer = @include_once('../partnerbereich/tarifrechner/strom/startOrder.php');
            } elseif ($queryArray['role'] == 'customer') {
                $answer = @include_once('../kundenbereich/optimierung/tarifrechner/strom/startOrder.php');
            }
            return $answer;
            break;
        case 'makeOrder':
            // Bestell-Button wurde gedrückt. Die Bestellung ist verbindlich
            $answertext = 'Vielen Dank. Die Übermittlung war erfolgreich.';
            echo $answertext;
            break;

        case 'loadUser':
            // lade die Daten des Users, der die entsprechende user_id hat
            //print 'loadUser kam an. ';
            include_once("./inc_branchStatistics.php");
            $userData = getDirectBranchesPartnerData($queryArray['user_id'], true);
            $_SESSION['querry'] = $queryArray['user_id'];
            $answer = include('../partnerbereich/mein-team/meine-filialen/detailsContainer.php');
            //echo substr($answer, 0, -1); // entfernt die mitgelieferte "1", woher die auch immer kommen mag --> satattdessen "return $answer;"
            break;
        case 'loadBadChild':
            // lade den Filialbaum mit der Filiale, die eine Störung verursacht
            $_SESSION['loadBadChild'] = $queryArray['user_id'];
            $answer = include('../partnerbereich/mein-team/meine-filialen/badChildListing.php');
            return $answer;
        case 'getOffer':
            // sende eine Mail an den Partner (dealer_id), dass der Kunde (user_id) ein Angebot (query) möchte.
            $answer = 'Die Mail wurde gesendet.<br>Du erhältst in Kürze eine Antwort Deines Beraters. '; //.$queryArray['funktion'].$queryArray['dealer_id'].$queryArray['user_id'].$queryArray['query'];
            echo $answer;
            break;
        case 'transmitDataUserToDealer':
            include_once("partnerCustomerTransmission.php");
            $return = getTransmissionData($queryArray["customer_id"]);
            echo $return;

            break;
        default:
            echo 'Wahr wohl nix!';
    }
}
if (isset($_POST["funktion"])) {
    switch ($_POST["funktion"]) {
        case 'registerPartner':
            // echo "new";
            include_once("./inc_userAdministration.php");
            // echo "new";
            $return = registerPartner($_POST);
            print_r($return);
            break;
        case 'registerNewCustomer':
            include_once("./inc_userAdministration.php");
            $return = registerCustomer($_POST);
            // echo "received";
            echo $return;
            break;
        case 'payPartnerLicense':
            include_once("./billing.php");
            $return = payPartnerLicense($_POST["userId"]);
            echo $return;
            break;
        case 'sendKey':
            // schreibe die Daten, live aus dem Antragsformular für Partner, in die DB 
            include_once("partnerCustomerTransmission.php");
            $return = sendTransmissionDataToDb($_POST["user_id"], $_POST);
            echo $return;

            break;
        case 'addEnergyContract':
            include_once("contractOffers.php");
            echo addContract($_POST);
            break;
        case 'confirmContract':
            // Das Controlling hat den Auftrag freigegeben
            include_once("contractOffers.php");
            echo confirmContract($_POST["orderId"]);
            break;
        case 'resetRankUpPopUp':
            include_once("billing.php");
            echo resetPopUpNotification($_POST["userId"]);

            break;
        case 'monthlyBilling':
            include_once("billing.php");
            echo monthlyBilling();
            break;
        case 'showDevelopment':
            // sende die Anzahl der erfolgreichen direkten Fillialen für das Feld Express-Bonus
            /* include_once("inc_branchStatistics.php");
            $response = getAllCustomersOnline($queryArray["user_id"]);
            $a 
            $answer = @include_once('../partnerbereich/finanzen/aktuelle-provision/commissionTable.php');*/
            $answer = 2;
            echo $answer;
            break;
    }
}
if (isset($_GET["funktion"])) {
    switch ($_GET["funktion"]) {

        case 'checkIfUserExists':
            include_once("./inc_userAdministration.php");
            // echo $_GET["searchValues"][0];
            $return = isUserExisting($_GET["searchValues"][0], $_GET["searchValues"][1]);
            echo $return;
            break;
        case 'logUserIn':
            include_once("./inc_userAdministration.php");
            print_r(loginUser($_GET["loginData"], "e_mail"));
            break;
        case 'sendContractNotifyToPartner':
            include_once("contractOffers.php");
            echo sendContractNotifyToPartner($_GET["contractType"], $_GET["customerId"], $_GET["partnerId"]);
            break;
        case 'getCustomerStatsList':
            // echo "test";
            break;
        case 'getCitiesWithAvailableLicenses':
            echo "tesdfst";
            break;
        case 'requestPasswordReset':
            include_once("./inc_userAdministration.php");
            $userData = checkIfUserExistsWithData($_GET["userData"]["userId"], "e_mail");
            if (!$userData) echo json_encode(array("userNotified" => "false"));
            $token = createToken(50);
            setUserPasswordRequestToken($userData["user_id"], "user_id", $userData["table"], $token);
            $userData["password_reset_token"] = $token;
            $testvar =  sendUserPasswordRequestEmail($userData);
            echo $testvar;

            break;
        case 'resetPassword':
            include_once("./inc_userAdministration.php");
            if (!validatePasswordStrength($_GET["userData"]["password"])) {
                echo json_encode(array("passwordResetted" => "false"));
            }

            $return = resetUserPassword($_GET["userData"]["userId"], $_GET["userData"]["password"]);
            echo $return;
            break;
    }
}
//print_r(json_decode(file_get_contents('php://input'), true));