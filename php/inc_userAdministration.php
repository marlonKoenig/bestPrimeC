<?php
include_once("inc_functions.php");
include_once("inc_useful.php");
// error_reporting(E_ERROR | E_PARSE);


$GLOBALS['domain'] = 'https://code2025.de/BestPrimeDev';
$GLOBALS["userForwardPages"] = array("logIn" => $GLOBALS["domain"] . "/logIn", "partner" => $GLOBALS['domain'] . "/partnerbereich", "customer" => $GLOBALS['domain'] . "/kundenbereich", "controller" => $GLOBALS['domain'] . "/controlling");

function registerCustomer($data)
{
    try {
        $invalidData = sanitizeValidatePartnerData($data);
        // echo "here";
        if (checkIfUserExistsWithData($data["email"], "e_mail")) return json_encode(array("userRegistration" => false, "email" => "Email already used"));
        if (count($invalidData)) {
            $invalidData["userRegistration"] = false;
            return json_encode($invalidData);
        }

        include_once("./inc_functions.php");
        $sponsorData = json_decode(isUserPartner($data["sponsorId"]));
        // echo $data["sponsorId"];
        if (!$sponsorData->isUserPartner) return array("sponsorId" => "Invalid Sponsor Id");
        $data["userId"] = createUserId();
        createUserFolders($data["userId"]);
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        // echo $data["birthDate"];
        $data["birthDate"] = date("Y-m-d", strtotime($data["birthDate"]));
        // print_r($data);
        // exit();
        $db = DbConNew($_SESSION["dbData"]);
        $insertData = array("userId" => $data["userId"], "sponsorID" => $data["sponsorId"], "password" => $data["password"], "email" => $data["email"], "firstName" => $data["firstName"], "surName" => $data["lastName"], "mobile" => $data["mobileNumber"], "salutation" => $data["gender"], "birthDate" => $data["birthDate"], "street" => $data["street"], "streetNumber" => $data["houseNumber"], "houseNumberAppendix" => $data["houseNumberAppendix"], "zip" => $data["zip"], "city" => $data["city"], "land" => $data["country"], "gtcAccepted" => $data["agbAccepted"], "privacyPolicyAccepted" => $data["privacyPolicyAccepted"], "newsletterSubscribed" => $data["newsletterSubscribed"], "branchPath" => $sponsorData->branchPath . "/" . $data["userId"]);
        $stmt = $db->prepare("INSERT INTO customer (user_id, sponsor_id, password_hash, e_mail, head_id, first_name, last_name, mobile_number, gender, birth_date, street, house_number, house_number_appendix, zip, city, country, gtc_accepted, privacy_policy_accepted, newsletter_subscribed, branch_path) VALUES (:userId, :sponsorID, :password, :email, :sponsorID, :firstName, :surName, :mobile, :salutation, :birthDate, :street, :streetNumber, :houseNumberAppendix, :zip, :city, :land, :gtcAccepted, :privacyPolicyAccepted, :newsletterSubscribed, :branchPath)");
        $emptyValue = NULL;
        foreach ($insertData as $key => $value) {
            if ($value == NULL) {
                $stmt->bindParam(":" . $key, $emptyValue);
                continue;
            }
            $stmt->bindParam(":" . $key, $insertData[$key]);
        }
        $stmt->execute();

        $sponsorData = (array) $sponsorData;
        increasePartnerAllCustomersNumber($data["sponsorId"]);
        sendPartnerMailForNewCustomer(array("linkType" => "Kundengewinnung", "headLine" => "Kundenregistrierung", "partnerEmail" => $sponsorData["email"], "partnerFirstName" => $sponsorData["firstName"], "customerLastName" => $data["lastName"], "customerFirstName" => $data["firstName"], "customerUserId" => $data["userId"]));
        sendCustomerRegistrationMail(array("customerFirstName" => $data["firstName"], "customerUserId" => $data["userId"], "customerEmail" => $data["email"]));
        // exit();

        return json_encode(array("userRegistration" => true));
    } catch (\Throwable $th) {
        echo $th;
        return json_encode(array("userRegistration" => false));
    }
}

function registerPartner($data)
{
    try {
        $invalidData = sanitizeValidatePartnerData($data);
        if (checkIfUserExistsWithData($data["email"], "e_mail")) return json_encode(array("userRegistration" => "failed", "email" => "Diese E-Mail Adresse wird bereits benutzt"));
        if (count($invalidData)) {
            $invalidData["userRegistration"] = "failed";
            return json_encode($invalidData);
        }

        include_once("./inc_functions.php");
        $sponsorData = json_decode(isUserPartner($data["sponsorID"]));
        if (!$sponsorData->isUserPartner) return array("sponsorID" => "Ungültige Sponsor-ID");
        $data["sponsorID"] = $sponsorData->userId;
        $data["userId"] = createUserId();
        createUserFolders($data["userId"]);
        $data["partnerId"] = getNewPartnerId("storexx_id");
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        $data["birthDate"] = date("Y-m-d", strtotime($data["birthDate"]));
        $db = DbConNew($_SESSION["dbData"]);
        $insertData = array("userId" => $data["userId"], "partnerId" => $data["partnerId"], "sponsorID" => $data["sponsorID"], "password" => $data["password"], "email" => $data["email"], "firstName" => $data["firstName"], "surName" => $data["surName"], "phone" => $data["phone"], "mobile" => $data["mobile"], "salutation" => $data["salutation"], "birthDate" => $data["birthDate"], "street" => $data["street"], "streetNumber" => $data["streetNumber"], "addressAppendix" => $data["addressAppendix"], "zip" => $data["zip"], "city" => $data["city"], "land" => $data["land"], "location" => $data["targetCity"], "branchPath" => $sponsorData->branchPath . "/" . $data["userId"], "gtcAccepted" => $data["gtcAccepted"], "privacyPolicyAccepted" => $data["privacyPolicyAccepted"], "newsletterSubscribed" => $data["newsletterSubscribed"]);
        $stmt = $db->prepare("INSERT INTO partner (user_id, partner_id, sponsor_id, password_hash, e_mail, head_id, first_name, last_name, phone_number, mobile_number, gender, birth_date, street, house_number, house_number_appendix, zip, city, location, country, branch_path, gtc_accepted, privacy_policy_accepted, newsletter_subscribed) VALUES (:userId, :partnerId, :sponsorID, :password, :email, :sponsorID, :firstName, :surName, :phone, :mobile, :salutation, :birthDate, :street, :streetNumber, :addressAppendix, :zip, :city, :location, :land, :branchPath, :gtcAccepted, :privacyPolicyAccepted, :newsletterSubscribed)");
        $emptyValue = NULL;
        foreach ($insertData as $key => $value) {
            if ($value == NULL) {
                $stmt->bindParam(":" . $key, $emptyValue);
                continue;
            }
            $stmt->bindParam(":" . $key, $insertData[$key]);
        }
        $stmt->execute();

        $sponsorData = (array) $sponsorData;
        increaseBranchSizeThisMonth($data["sponsorID"]);
        sendPartnerMailForNewPartner(array("linkType" => "Filialenaufbau", "headLine" => "Partnerregistrierung", "customerEmail" => $data["email"], "customerCountry" => $data["land"], "customerCity" => $data["targetCity"], "partnerEmail" => $sponsorData["email"], "partnerFirstName" => $sponsorData["firstName"], "customerLastName" => $data["surName"], "customerFirstName" => $data["firstName"], "customerUserId" => $data["userId"]));
        sendPartnerRegistrationMail(array("customerFirstName" => $data["firstName"], "customerUserId" => $data["partnerId"], "customerEmail" => $data["email"]));



        return json_encode(array("userRegistration" => "success", "userId" => $data["userId"]));
    } catch (\Throwable $th) {
        echo $th;
        return json_encode(array("userRegistration" => "failed"));
    }


    // $dbData = $stmt->fetch();
    // print_r($dbData);
    // $stmt = $db->prepare("INSERT INTO partner (user_id, partner_id, sponsor_id, password_hash, e_mail, head_id, first_name, last_name, phone_number, gender, birth_date, street, house_number, zip, location, country)");
}

function increasePartnerAllCustomersNumber($userId)
{
    try {
        $db = DbConNew($_SESSION["dbData"]);
        $stmt = $db->prepare("UPDATE partner SET registered_customers = (registered_customers + 1) WHERE user_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $emptyValue = NULL;
    } catch (\Throwable $th) {
        return;
    }
}
function increaseBranchSizeThisMonth($userId)
{
    try {
        $db = DbConNew($_SESSION["dbData"]);
        $stmt = $db->prepare("UPDATE partner SET new_direct_branches_this_month = (new_direct_branches_this_month + 1) WHERE user_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $emptyValue = NULL;
    } catch (\Throwable $th) {
        return;
    }
}


function sanitizeValidatePartnerData($data)
{
    $invalidData = array();
    foreach ($data as $key => $field) {
        $fieldH = $field;
        switch ($key) {
            case 'password':
                if (!validatePasswordStrength($field)) {
                    $invalidData[$key] = "Dein Passwort muss mindestens 8 Zeichen lang sein und aus mindestens einem Großbuchstaben, einer Zahl und einem Sonderzeichen bestehen.";
                }
                break;
            case 'mobile':
                if (!$data[$key]) {
                    $invalidData[$key] = "Bitte gib einen Telefonnummer ein.";
                }
                break;
            case 'firstName':
                if (!$data[$key]) {
                    $invalidData[$key] = "Bitte gib einen Vornamen ein.";
                } else {
                    $data[$key] = filter_var($field, FILTER_SANITIZE_STRING);
                }
                break;
            case 'lastName':
                if (!$data[$key]) {
                    $invalidData[$key] = "Bitte gib einen Nachnamen ein.";
                } else {
                    $data[$key] = filter_var($field, FILTER_SANITIZE_STRING);
                }
                break;
            case 'phone':
                if (!$data[$key]) break;
                $data[$key] = filter_var($field, FILTER_SANITIZE_NUMBER_FLOAT);
                if (!filter_var($data[$key], FILTER_VALIDATE_INT)) $invalidData[$key] = $fieldH;
                break;
            case 'zip':
                if (!$data[$key]) break;
                $data[$key] = filter_var($field, FILTER_SANITIZE_NUMBER_FLOAT);
                if (!filter_var($data[$key], FILTER_VALIDATE_INT, array("options" => array("min_range" => 10000, "max_range" => 99999)))) $invalidData[$key] = "Bitte gib eine gültige Postleitzahl ein.";
                break;
            case 'salutation':
                // $data[$key] = filter_var($field, FILTER_SANITIZE_NUMBER_FLOAT);
                $data[$key] = $field;
                if ($data[$key] != "0" && $data[$key] != "1" && $data[$key] != "2") $invalidData[$key] = "Bitte wähle die Anrede aus.";
                break;
            case 'emailRepeat':
            case 'email':
                $data[$key] = filter_var($field, FILTER_SANITIZE_EMAIL);
                if (!filter_var($data[$key], FILTER_VALIDATE_EMAIL)) $invalidData[$key] = "Bitte gib eine gültige E-Mail Adresse ein.";
                break;
            case 'url':
                if (!$data[$key]) break;
                $data[$key] = filter_var($field, FILTER_SANITIZE_URL);
                if (!filter_var($data[$key], FILTER_VALIDATE_URL)) $invalidData[$key] = "Bitte gib eine gültige URL ein.";
                break;
            case 'birthDate':
                try {
                    // if (!$data[$key]) break;
                    $data[$key] = new DateTime($field);
                    if (!validateAge($data[$key]->format("d.m.Y"))) $invalidData[$key] = "Du bist zu jung um diese Plattform zu nutzen.";
                    $data[$key] = $data[$key]->format("Y-m-d");
                } catch (\Throwable $th) {
                    $invalidData[$key] = "Bitte gib ein gültiges Geburtsdatum ein.";
                }
                break;

            case 'gtcAccepted':
                if ($data[$key] == "0") $invalidData[$key] = "Bitte akzeptiere die AGB.";
                break;
            case 'privacyPolicyAccepted':
                if ($data[$key] == "0") $invalidData[$key] = "Bitte akzeptiere die Datenschutzerklärung.";
                break;
            default:
                #TODO: pflichtfelder definieren

                $data[$key] = filter_var($field, FILTER_SANITIZE_STRING);
                break;
        }
    }
    if ($data["password"] != $data["passwordRepeat"]) $invalidData["password"] = "Die beiden Passwörter stimmen nicht überein.";
    if (isset($data["email"]) && isset($data["emailRepeat"]) && $data["email"] != $data["emailRepeat"]) $invalidData["email"] = "Die beiden E-Mail Adressen stimmen nicht überein.";
    return $invalidData;
}

function loginUser($loginData, $columnName = "user_id")
{
    try {
        $defaultErrorDefault = json_encode(array("loginStatus" => "error", "statusReason" => "Bitte überprüfen Sie Ihre Eingabefn"));

        $userData = checkIfUserExistsWithData($loginData["userId"], $columnName);
        if (!$userData) return $defaultErrorDefault;
        // return $userData;
        if (!password_verify($loginData["password"], $userData["password_hash"])) return $defaultErrorDefault;
        if ($userData["locked"]) return json_encode(array("loginStatus" => "error", "statusReason" => "Dieser Account ist gesperrt."));
        setLoginSessionVariables($userData);
        return json_encode(array("loginStatus" => "success", "statusReason" => "", "role" => $userData["role"]));

        // header("Location: " . $GLOBALS["userForwardPages"][$userData["role"]]);
        // die();
    } catch (\Throwable $th) {
        return $th;
        return json_encode(array("loginStatus" => "error", "statusReason" => "Bitte überprüfen Sie Ihre Eingaben"));
    }
}

function setLoginSessionVariables($userData)
{

    switch ($userData["role"]) {



        case 'partner':
            $_SESSION['user_id'] = $userData["user_id"];
            // $_SESSION['user_rank'] = "test";
            $_SESSION['user_rank'] = $userData["rank_display_name"];
            $_SESSION["user_rank_up_notification"] = $userData["show_rank_up_notification"];
            $_SESSION['user_xTime'] = strtotime($userData["registration_timestamp"] . ' +30 day');
            $_SESSION['user_firstName'] = $userData["first_name"];
            $_SESSION['user_surName'] = $userData["last_name"];
            $_SESSION['customer_dealerID'] = $userData["head_id"];
            $_SESSION["user_partnerId"] = $userData["partner_id"];
            // $birthDate = date('d.m.Y', strtotime($userData["birth_date"]));
            // $_SESSION['user_id'] = $userData["user_id"];
            // $_SESSION["user_birthDate"] = $birthDate;
            // $_SESSION['user_regDate'] = $userData["registration_timestamp"];

            // $_SESSION['user_workPlace'] = $userData["location"];
            // $_SESSION['user_id'] = $userData["user_id"];
            // $_SESSION['user_headID'] = $userData["head_id"];
            $_SESSION['user_role'] = $userData["role"];
            // $_SESSION['user_firstName'] = $userData["first_name"];
            // $_SESSION['user_surName'] = $userData["last_name"];
            // $_SESSION["salutation"] = $GLOBALS["gender"][$userData["gender"]];
            // $_SESSION['user_zip'] = $userData["zip"];
            // $_SESSION['user_residence'] = $userData["city"];
            break;
        case 'customer':
            $birthDate = date('d.m.Y', strtotime($userData["birth_date"]));
            $_SESSION['user_id'] = $userData["user_id"];
            $_SESSION["user_birthDate"] = $birthDate;
            $_SESSION['user_regDate'] = $userData["registration_timestamp"];

            $_SESSION['user_id'] = $userData["user_id"];
            $_SESSION['customer_dealerID'] = $userData["head_id"];
            $_SESSION['customer_dealerName'] = $userData["partnerFirstName"] . " " . $userData["partnerLastName"];
            $_SESSION['user_role'] = $userData["role"];
            $_SESSION['user_firstName'] = $userData["first_name"];
            $_SESSION['user_surName'] = $userData["last_name"];
            $_SESSION["salutation"] = $GLOBALS["gender"][$userData["gender"]];
            $_SESSION['user_zip'] = $userData["zip"];
            $_SESSION['user_residence'] = $userData["city"];
            $_SESSION['customer_dealerName'] = $userData["partnerFirstName"] . " " . $userData["partnerLastName"];
            break;

        default:
            break;
    }
}

function checkIfUserExistsWithData($userId, $columnName = "user_id")
{
    try {
        $db = DbConNew($_SESSION["dbData"]);
        $stmt = $db->prepare("SELECT c.user_id, c.password_hash, c.password_reset_token, c.e_mail, c.partner_id, c.zip, c.city, c.first_name, c.last_name, c.head_id, c.role, c.gender, c.locked, c.location, c.birth_date, c.branch_path, c.registration_timestamp, c.show_rank_up_notification, r.rank_display_name FROM partner c LEFT JOIN partner_rank r ON r.rank_id_name = c.rank WHERE $columnName = :userId LIMIT 1");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();

        if (!$userData = $stmt->fetch()) { //user could be in customer table as well
            $stmt = $db->prepare("SELECT c.user_id, c.password_hash, c.password_reset_token, c.e_mail, c.zip, c.city, c.first_name, c.last_name, c.head_id, c.role, c.gender, c.locked, c.birth_date, c.branch_path, c.registration_timestamp, p.first_name partnerFirstName, p.last_name partnerLastName FROM customer c INNER JOIN partner p ON p.user_id = c.head_id WHERE c.$columnName = :userId LIMIT 1");
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            $userData = $stmt->fetch();
            if ($userData) $userData["table"] = "customer";
        }
        if ($userData) $userData["table"] = "partner";
        return $userData;
    } catch (\Throwable $th) {
        // return $th;
        return false;
    }
}
function isUserExisting($userId, $columnName = "user_id")
{
    try {
        $db = DbConNew($_SESSION["dbData"]);
        $stmt = $db->prepare("SELECT user_id, password_hash, partner_id FROM partner WHERE $columnName = :userId LIMIT 1");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();

        if (!$userData = $stmt->fetch()) { //user could be in customer table as well
            $stmt = $db->prepare("SELECT user_id FROM customer WHERE $columnName = :userId LIMIT 1");
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            if (!$userData = $stmt->fetch()) {
                return json_encode(array("userExists" => false));
            }
        }
        return json_encode(array("userExists" => true));
    } catch (\Throwable $th) {
        return json_encode(array("userExists" => false));
    }
}

function isUserPartner($userId, $columnName = "user_id")
{
    try {
        $db = DbConNew($_SESSION["dbData"]);
        $stmt = $db->prepare("SELECT user_id, first_name, last_name, branch_path, e_mail FROM partner WHERE $columnName = :userId LIMIT 1");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();

        if (!$userData = $stmt->fetch()) {
            return json_encode(array("isUserPartner" => false));
        }
        return json_encode(array("isUserPartner" => true, "firstName" => $userData["first_name"], "lastName" => $userData["last_name"], "branchPath" => $userData["branch_path"], "userId" => $userData["user_id"], "email" => $userData["e_mail"]));
    } catch (\Throwable $th) {
        return json_encode(array("isUserPartner" => false));
    }
}


/** checkIfUserLoggedIn: Überprüft, ob ein User eingeloggt ist
 * @param   boolean     $redirectIfNotLoggedIn      True = Leitet user weiter wenn nicht eingeloggt ist 
 * @param   boolean     $redirectIfLoggedIn         True = Leitet user an für seine rolle vordefinierte seite weiter
 * @param   array       $allowedRoles               Wenn etwas übergeben wir wird der user auf diese rollen überprüft. Falls er keine der übergebenen
 * Rollen bestitzt wird er an die für seine Rolle vordefinierte Seite weitergeleitet. So kann man einstellen welche Rollen (administrator, representative, etc) auf eine Seite dürfen
 * ein '*' kann als erstes element gesetzt werden um alle zuzulassen
 * 
 * @return  boolean         true, wenn eingeloggt, sonst false;
 */
function checkIfUserLoggedIn(array $allowedRoles = array(), bool $redirectIfNotLoggedIn = false, bool $redirectIfLoggedIn = false, bool $checkIfUserHasToAcceptPages = true)
{
    // echo $_SESSION["user_id"];
    // exit();
    if (isset($_SESSION["user_id"])) {
        // echo "test";
        // exit();
        // if ($checkIfUserHasToAcceptPages) {
        //     $this->checkIfUserHasToAcceptPages($_SESSION["acceptDoc"], false);
        // }
        if ($allowedRoles) {
            if ($allowedRoles[0] == "*") {
                return true;
            }
            foreach ($allowedRoles as $value) {
                if ($value == $_SESSION["user_role"]) {
                    if ($redirectIfLoggedIn) {
                        redirectUser($GLOBALS["userForwardPages"][$_SESSION["user_role"]]);
                    }
                    return true;
                }
            }
            redirectUser($GLOBALS["userForwardPages"][$_SESSION["user_role"]]);
            return true;
        }

        if ($redirectIfLoggedIn) {
            // echo "test";
            // exit;
            redirectUser($GLOBALS["userForwardPages"][$_SESSION["user_role"]]);
        }
        return true;
    } else if ($redirectIfNotLoggedIn) {
        redirectUser($GLOBALS["userForwardPages"]["logIn"]);
    }
    return false;
}



/** redirectUser: Leitet User an seine rolenspezifische default page weiter
 * 
 * @param   string      $role               Rolle des Users
 * @param   string      $forwardingPage     Falls gesetzt wird der User direkt an diese Seite weitergeleitet ohne beachtung der Rolle
 */
function redirectUser(string $forwardingPage = null)
{
    if ($forwardingPage) {
        try {
            header("Location: " . $forwardingPage);
            exit;
        } catch (Exception $e) {
            echo "<script>window.location.href = '$forwardingPage';</script>";
            exit;
        }
    }
}

function resetActiveStatus()
{
    #TODO: überdenken / überarbeiten
    // $activeStatusFree = new DateTime();
    // $activeStatusFree->modify('first day of -1 month');
    // $activeStatusFree = $activeStatusFree->format('Y-m-d');

    // $db = DbConNew($GLOBALS["userDatabase"]);
    // $stmt = $db->prepare("UPDATE partner SET active_status = 0 WHERE registration_timestamp < :activeStatusFree");
    // $stmt->bindParam(":activeStatusFree", $activeStatusFree);
    // $stmt->execute();
}


function validateAge($then)
{
    // $then will first be a string-date
    $then = strtotime($then);
    //The age to be over, over +18
    $min = strtotime('+18 years', $then);
    // echo $min;
    if (time() < $min) {
        return false;
    }
    return true;
}


function sendPartnerMailForNewCustomer($dataArray)
{
    // return "test";
    $header[] = 'MIME-Version: 1.0';
    $header[] = 'Content-type: text/html; charset=iso-8859-1';

    $message = "<html><body><h1>Glückwunsch</h1>
    Hallo {$dataArray['partnerFirstName']},<br><br>
    soeben hat sich jemand über Deinen Empfehlungslink ({$dataArray['linkType']}) einen XX World Account erstellt.<br><br>
    Hier die Infos:<br>
    Name/Vorname: {$dataArray['customerLastName']} {$dataArray['customerFirstName']}<br>
    Accountnummer: {$dataArray['customerUserId']}<br><br><br>

    Bitte nimm sofort Kontakt auf und zeige unserem neuen Mitglied alle Vorteile der XX World<br><br>
    Wir freuen uns mit Dir gemeinsam die größte Shoppingcommunity zu gründen.<br><br>
    Wir wünschen euch beiden den maximalen Erfolg.<br><br>
    Bis bald<br>
    Dein storeXX Team<br><br><br>

    Impressum:<br> ​

    storeXX GmbH​<br>

    Landsberger Straße 155​<br>

    80687 München<br>​

    www.storeXX.com​<br>

    support@storexx.com<br>
    <body></html>";

    if (!mail($dataArray["partnerEmail"], $dataArray["headLine"], $message,  implode("\r\n", $header))) return json_encode(array("partnerNotified" => "failed2"));
    return json_encode(array("partnerNotified" => "success"));
}

function sendPartnerMailForNewPartner($dataArray)
{
    // return "test";
    $header[] = 'MIME-Version: 1.0';
    $header[] = 'Content-type: text/html; charset=iso-8859-1';

    $message = "<html><body><h1>Glückwunsch</h1>
    Hallo {$dataArray['partnerFirstName']},<br><br>
    soeben hat sich eine neue Person, für den Start mit einem eigenen Store, in dein Netzwerk entschieden.<br><br>
    Hier die Kontaktinformationen des neuen storeXX Shop Owners::<br>
    Name/Vorname: {$dataArray['customerLastName']} {$dataArray['customerFirstName']}<br>
    E-Mail Adresse: {$dataArray['customerEmail']}<br>
    Land: {$dataArray['customerCountry']}<br>
    Stadt: {$dataArray['customerCity']}<br>
    
    <br><br>

    Bitte triff Dich offline oder Online innerhalb von 72 Stunden mit deinem neuen Shop Owner, um mit Ihm seine Fragen zu klären und Ihm die ersten Schritte zu zeigen.<br><br>
    Denk immer daran, sein Erfolg ist auch dein Erfolg! <br><br>
    Setze alles daran, deinen Shop Owner erfolgreich zu machen damit er seine finanziellen Ziele erreicht. Somit erreichst auch Du, deine finanziellen  Ziele desto schneller!<br><br>
    Die storeXX Community wünscht euch beiden den maximalen Erfolg.<br><br>
    Wir freuen uns mit euch gemeinsam die größte Shoppingcommunity weltweit aufzubauen.<br><br>
    Bis bald<br>
    Dein storeXX Team<br><br><br>

    Impressum:<br> ​

    storeXX GmbH​<br>

    Landsberger Straße 155​<br>

    80687 München<br>​

    www.storeXX.com​<br>

    support@storexx.com<br>
    <body></html>";

    if (!mail($dataArray["partnerEmail"], $dataArray["headLine"], $message,  implode("\r\n", $header))) return json_encode(array("partnerNotified" => "failed2"));
    return json_encode(array("partnerNotified" => "success"));
}


function sendCustomerRegistrationMail($data)
{
    $header[] = 'MIME-Version: 1.0';
    $header[] = 'Content-type: text/html; charset=iso-8859-1';

    $message = "<html><body><h1>Willkommen!</h1>
    Hallo {$data['customerFirstName']},<br><br>
    herzlich willkommen in der XX World.<br>
    In der XX World und durch deinen persönlichen Berater wirst Du stets auf die neuesten Aktionen und Angebote hingewiesen. Auch für Dich wird das Sparpotential deutlich sichtbar werden.<br><br>


    Deine Accountnummer für die XX World lautet: <br>
    Accountnummer: {$data['customerUserId']}<br><br><br>

    Wenn Du Hilfe benötigen solltest, sind wir selbstverständlich für dich da.<br><br>
    Die storeXX Community wünscht Dir viel Spaß mit tollen Aktionen und Angeboten.<br><br>
    Bis bald<br>
    Dein storeXX Team<br><br><br>

    Impressum:<br> ​

    storeXX GmbH​<br>

    Landsberger Straße 155​<br>

    80687 München<br>​

    www.storeXX.com​<br>

    support@storexx.com<br>
    <body></html>";

    if (!mail($data["customerEmail"], "Neuregistrierung", $message,  implode("\r\n", $header))) return json_encode(array("partnerNotified" => "failed2"));
    return json_encode(array("partnerNotified" => "success"));
}
function sendPartnerRegistrationMail($data)
{
    $header[] = 'MIME-Version: 1.0';
    $header[] = 'Content-type: text/html; charset=iso-8859-1';

    $message = "<html><body><h1>Willkommen!</h1>
    Hallo {$data['customerFirstName']},<br><br>
    herzlich willkommen bei storeXX!<br>
    Mit storeXX und deinem persönlichen Store wirst auch Du, deine persönlichen Wünsche , Träume und Ziele erreichen. Hierzu werden wir Dir stets die Besten Tools und Hilfestellungen an die Hand geben. Sei gespannt auf die Zukunft!<br><br>


    Dein Shop Owner ID.Nr bei storeXX lautet: <br>
    {$data['customerUserId']}<br><br><br>

    Tipp: Setzte dich mit deinem Empfehlungsgeber schnell in Verbindung! Lass Dir alles erklären und zeigen, damit Du einen erfolgreichen Start hast. 
    Wenn Du Hilfe benötigen solltest, sind wir selbstverständlich für dich da.
    <br><br>

    Die storeXX Community wünscht Dir den maximalen Erfolg.<br><br>
    Wir freuen uns mit Dir gemeinsam die größte Shoppingcommunity weltweit aufzubauen.<br><br>
    Bis bald<br>
    Dein storeXX Team<br><br><br>

    Impressum:<br> ​

    storeXX GmbH​<br>

    Landsberger Straße 155​<br>

    80687 München<br>​

    www.storeXX.com​<br>

    support@storexx.com<br>
    <body></html>";

    if (!mail($data["customerEmail"], "Neuregistrierung", $message,  implode("\r\n", $header))) return json_encode(array("partnerNotified" => "failed2"));
    return json_encode(array("partnerNotified" => "success"));
}

function sendUserPasswordRequestEmail($userData)
{
    $header[] = 'MIME-Version: 1.0';
    $header[] = 'Content-type: text/html; charset=iso-8859-1';

    $message = "<html><body><h1>Passwort zurücksetzen!</h1>
    Hallo {$userData['first_name']},<br><br>
    klicke auf den Button um dein Passwort zurückzusetzen.
    <br><br>
    <div style='max-width:10em;width:90vw;text-align:center'><a href='https://code2025.de/BestPrimeDev/passwordReset/?token=" . $userData["password_reset_token"] . "&userId=" . $userData["user_id"] . "' style='padding:0.75rem 1rem;background:blue;color:white;'>Passwort&nbsp;zurücksetzen</a></div>
    <br><br>

    Die storeXX Community wünscht Dir den maximalen Erfolg.<br><br>
    Wir freuen uns mit Dir gemeinsam die größte Shoppingcommunity weltweit aufzubauen.<br><br>
    Bis bald<br>
    Dein storeXX Team<br><br><br>

    Impressum:<br> ​

    storeXX GmbH​<br>

    Landsberger Straße 155​<br>

    80687 München<br>​

    www.storeXX.com​<br>

    support@storexx.com<br>
    <body></html>";

    if (!mail($userData["e_mail"], "Passwort zurücksetzen", $message,  implode("\r\n", $header))) return json_encode(array("userNotified" => "failed"));
    return json_encode(array("userNotified" => "true"));
}


function setUserPasswordRequestToken($userId, $column = "user_id", $table, $token)
{
    $db = DbConNew();

    $stmt = $db->prepare("UPDATE $table SET password_reset_token = :token WHERE $column = :userId");
    $stmt->bindParam(":userId", $userId);
    $stmt->bindParam(":token", $token);
    $stmt->execute();
}

function createToken($length = 50)
{
    $bytes = random_bytes($length / 2);
    return bin2hex($bytes);
}


function checkIfPasswordResetTokenValid($userId, $token)
{
    try {
        $userData = checkIfUserExistsWithData($userId);
        if (!$userData || $userData["password_reset_token"] != $token) return json_encode(array("tokenValid" => "false"));
        return json_encode(array("tokenValid" => "true"));
    } catch (\Throwable $th) {
        return json_encode(array("tokenValid" => "false"));
    }
}


function resetUserPassword($userId, $password)
{
    try {
        $userData = checkIfUserExistsWithData($userId);
        if (!$userData) return json_encode(array("passwordResetted" => "false"));
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $db = DbConNew();
        $stmt = $db->prepare("UPDATE {$userData['table']} SET password_hash = :passwordHash, password_reset_token = NULL WHERE user_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":passwordHash", $passwordHash);
        $stmt->execute();
        return json_encode(array("passwordResetted" => "true"));
    } catch (\Throwable $th) {
        return json_encode(array("passwordResetted" => "false"));
    }
}
