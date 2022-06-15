<?php

/** Initialisierung der Systemvariablen 
 * Systemvariablen werden hier initialisiert, um PHP-8-Fehler zu verhindern */

$_SESSION['root'] = 'http://code2025.de/BestPrimeDev/';

/** Allgemein */
// $_SESSION['user_id'] = 12345678901234; // @int = Einzigartige ID -> 14-stellig (aus timestamp) - unabhängig von der Rolle
$_SESSION['user_partnerID'] = 100000; // @int = Einzigartige ID des Partners, aus der hervorgeht zu welchem Partnernetz dieser gehört
$_SESSION['user_headID'] = 12345678901000; // @int = Einzigartige ID des Vorfahren (egal ob Dealer oder Customer), an den abgerechnet wird
// $_SESSION['user_role'] = ''; // @str = Die Rolle als Klarname
// $_SESSION['user_rank'] = ''; // @str = Die aktuelle Position / Rolle als Klarname
$_SESSION['user_nextRank'] = ''; // @str = Die nächste Position auf der Karriereleiter / Rolle als Klarname
$_SESSION['user_missingCareerUnits'] = ''; // @str = Die fehlenden Einheiten zum Erreichen der nächsten Karrierestufe
// $_SESSION['user_firstName'] = ''; // @str = Der (die) Vorname(n)
// $_SESSION['user_surName'] = ''; // @str = Der Nachname
$_SESSION['user_salutation'] = ''; // @str = Anrede
$_SESSION['user_zip'] = ''; // @int = Postleitzahl des Wohnortes
$_SESSION['user_residence'] = ''; // @str = Der Wohnort
$_SESSION['user_workPlace'] = ''; // @str = Der Ort seines eigenen Wirkens
$_SESSION['user_birthDate'] = ''; // @str = Geburtsdatum
// $_SESSION['user_regDate'] = ''; // @str = Registrierungsdatum
// $_SESSION['user_rank'] = ''; // @str = Die aktuelle Position / Rolle als Klarname
$_SESSION['user_status'] = true; // @bool = Der aktuelle Status des Users. Hat er diesen Monat zwei Einheiten umgesetzt -> true
$_SESSION['user_licence'] = true; // @bool = Der aktuelle Bezahlt-Status des Users. Hat er eine gültige Lizenz -> true
$_SESSION['user_logInTime'] = 0000000000; // @int = Der Timestamp des Logins
$_SESSION['link_partner'] = 'https://code2025.de/BestPrimeDev/welcome?refUserId='; // @str = Der erste Teil des Links, der für Kundenwerbung verwendet wird z.B.:  https://einsparen.de/?partner=
$_SESSION['link_customer'] = 'https://code2025.de/BestPrimeDev/welcomeCustomer?refUserId='; // @str = Der erste Teil des Links, der für Kundenwerbung verwendet wird z.B.:  https://einsparen.de/?partner=
$_SESSION['user_wallet'] = 123.45; // @float = Inhalt der eigenen Geldbörse, in Euro mit Punktnotation

/** Kundendaten */
$_SESSION['user_ownCustomerNumber'] = 0; // @int = Anzahl der eigenen Kunden
$_SESSION['user_childCustomerNumber'] = 0; // @int = Anzahl der Kunden, der Filialen
$_SESSION['user_ownPowerCustomerNumber'] = 0; // @int = Anzahl der eigenen Kunden im Bereich Strom
$_SESSION['user_childPowerCustomerNumber'] = 0; // @int = Anzahl der Kunden, der Filialen im Bereich Strom
$_SESSION['user_ownGasCustomerNumber'] = 0; // @int = Anzahl der eigenen Kunden im Bereich Gas
$_SESSION['user_childGasCustomerNumber'] = 0; // @int = Anzahl der Kunden, der Filialen im Bereich Gas
$_SESSION['user_ownDslCustomerNumber'] = 0; // @int = Anzahl der eigenen Kunden im Bereich DSL
$_SESSION['user_childDslCustomerNumber'] = 0; // @int = Anzahl der Kunden, der Filialen im Bereich DSL
$_SESSION['user_ownMobileCustomerNumber'] = 0; // @int = Anzahl der eigenen Kunden im Bereich Mobilfunk
$_SESSION['user_childMobileCustomerNumber'] = 0; // @int = Anzahl der Kunden, der Filialen im Bereich Mobilfunk
$_SESSION['user_ownAllCustomerNumber'] = 0; // @int = Anzahl der eigenen Kunden im Bereich APP
$_SESSION['user_childAllCustomerNumber'] = 0; // @int = Anzahl der Kunden, der Filialen im Bereich APP

/** Kundenverträge */
$_SESSION['order_type'] = ''; // @string = Vertragsart (Strom, Gas,...)
$_SESSION['order_status'] = true; // @bool = Vertragsstatus aktiv = true
$_SESSION['order_fault'] = 'Wartet auf Unterschrift'; // @string = Aktuelle Vertragsstörung
$_SESSION['order_id'] = ''; // @string = Vertragsnummer (kann auch Buchstaben enthalten)
$_SESSION['order_product'] = ''; // @string = Produkt, bzw. Bezeichnung des Vertrags
$_SESSION['order_dealer'] = ''; // @string =Anbieter
$_SESSION['order_date'] = ''; // @string = Vertragsdatum (Abschluss)
$_SESSION['order_start'] = ''; // @string = Vertragsstart (erste Lieferung)
$_SESSION['contract_document'] = ''; // @string = Vertragsdokumente, die vorhanden sind im Klartext
$_SESSION['contract_link'] = ''; // @string = Link(s) auf Vertragsdokumente (kommagetrennt?)

/** Kundenverträge */
$_SESSION['income_all_power'] = 000; // @int = Gesamt-Einnahmen Strom in Punktnotation
$_SESSION['income_all_gas'] = 000; // @int = Gesamt-Einnahmen Gas in Punktnotation
$_SESSION['income_all_dsl'] = 000; // @int = Gesamt-Einnahmen Strom in Punktnotation
$_SESSION['income_all_mobile'] = 000; // @int = Gesamt-Einnahmen Strom in Punktnotation
$_SESSION['income_all_shopping'] = 000; // @int = Gesamt-Einnahmen Strom in Punktnotation

$_SESSION['income_own_power'] = 000; // @int = Eigene-Einnahmen Strom in Punktnotation
$_SESSION['income_own_gas'] = 000; // @int = Eigene-Einnahmen Gas in Punktnotation
$_SESSION['income_own_dsl'] = 000; // @int = Eigene-Einnahmen Strom in Punktnotation
$_SESSION['income_own_mobile'] = 000; // @int = Eigene-Einnahmen Strom in Punktnotation
$_SESSION['income_own_shopping'] = 000; // @int = Eigene-Einnahmen Strom in Punktnotation

$_SESSION['income_child_power'] = 000; // @int = Filial-Einnahmen Strom in Punktnotation
$_SESSION['income_child_gas'] = 000; // @int = Filial-Einnahmen Gas in Punktnotation
$_SESSION['income_child_dsl'] = 000; // @int = Filial-Einnahmen Strom in Punktnotation
$_SESSION['income_child_mobile'] = 000; // @int = Filial-Einnahmen Strom in Punktnotation
$_SESSION['income_child_shopping'] = 000; // @int = Filial-Einnahmen Strom in Punktnotation

/** Vertriebspartner */
$_SESSION['user_ownUnits'] = 0; // @int = Eigene Einheiten
$_SESSION['user_ownSaldo'] = 0; // @int = Eigener Saldo, der zur Rechnung gestellt werden soll
$_SESSION['user_ownOpenUnits'] = 0; // @int = Eigene Einheiten, die noch nicht bestätigt wurden
$_SESSION['user_unitsCompareLastMonth'] = 0; // @int = Eigene Einheiten, im Vergleich zum Vormonat
$_SESSION['user_ownCommission'] = 000; // @float = Eigene Provision, in Euro mit Punktnotation
$_SESSION['user_childUnits'] = 0; // @int = Einheiten aus Filialen
$_SESSION['user_newChilds'] = 0; // @int = neue Filialen in diesem Monat
$_SESSION['user_childCommission'] = 000; // @float = Provision aus Filialen, in Euro mit Punktnotation
$_SESSION['user_sponsorID'] = 000000000; // @int = ID des direkten Vorfahren
$_SESSION['user_authGroup'] = ''; // @string = Berechtigungsgruppe
$_SESSION['user_authNumber'] = 0; // @int = Berechtigungsgruppe als Integer (siehe numerableAuthorization)
// $_SESSION['user_rank'] = ''; // Rang des Useres
// $_SESSION['user_xTime'] = 123456789; // @int = Zeitpunkt, an dem der X-Countdown abläuft in Sekunden

/** Bei Kunden 
 * sollten diese Daten aus Performance-Gründen über die SESSION gespeichert werden
 */
// $_SESSION['user_id'] = 00000000000000; // @int = Die 14-stellige Kunden-Nummer aus dem timestamp
// $_SESSION['customer_dealerID'] = 000000000; // @int = ID des zuständigen Vertriebspartners
// $_SESSION['customer_dealerName'] = 'Max Headroom'; // @str = Klarname des zuständigen Vertriebspartners
$_SESSION['customer_signedIn'] = false; // @bool = Steht auf TRUE, wenn der Kunde erfolgreich angemeldet ist
$_SESSION['customer_title'] = ''; // @str = Namenszusatz
// $_SESSION['user_firstName'] = ''; // @str = Der (die) Vorname(n)
// $_SESSION['user_surName'] = ''; // @str = Der Nachname
// $_SESSION['user_salutation'] = ''; // @str = Anrede
$_SESSION['user_street'] = ''; // @str = Straße
$_SESSION['user_houseNumber'] = ''; // @str = Hausnummer
$_SESSION['user_additionalAdress'] = ''; // @str = Adresszusatz
$_SESSION['user_country'] = ''; // @str = Land
$_SESSION['user_email'] = ''; // @str = E-Mail-Adresse
$_SESSION['user_password'] = ''; // @str = Passwort (verschlüsselt)
$_SESSION['customer_acceptAgb'] = 00000000000000; // @int = Timestamp für das Akzeptieren der AGB
$_SESSION['customer_acceptDse'] = 00000000000000; // @int = Timestamp für das Lesen der DSE
$_SESSION['customer_acceptNewsletter'] = 00000000000000; // @int = Timestamp für das Akzeptieren des Newsletters
$_SESSION['user_mobile'] = ''; // @str = Handynummer für Verifizierungen
$_SESSION['customer_contractPower'] = false; // @bool = Steht auf TRUE, wenn ein Vertrag für Strom vorhanden ist
$_SESSION['customer_contractGas'] = false; // @bool = Steht auf TRUE, wenn ein Vertrag für Gas vorhanden ist
$_SESSION['customer_contractDsl'] = false; // @bool = Steht auf TRUE, wenn ein Vertrag für DSL vorhanden ist
$_SESSION['customer_contractMobile'] = false; // @bool = Steht auf TRUE, wenn ein Vertrag für Mobilfunk vorhanden ist
$_SESSION['customer_contractSolar'] = false; // @bool = Steht auf TRUE, wenn ein Vertrag für Solaranlage vorhanden ist
$_SESSION['customer_recommendation'] = 0; // @int = Anzahl der erfolgreichen Empfehlungen
$_SESSION['customer_openTicket'] = false; // @bool = Steht auf TRUE, wenn ein Supportticket eröffnet und noch nicht wieder geschlossen wurde
$_SESSION['customer_'] = ''; // @str = 
$_SESSION['user_zip'] = 00000; // @int = Postleitzahl des Wohnortes
$_SESSION['user_residence'] = ''; // @str = Der Wohnort
$_SESSION['user_birthDate'] = ''; // @str = Geburtsdatum
$_SESSION['user_sex'] = ''; // @str = Geschlecht
// $_SESSION['user_regDate'] = ''; // @str = Registrierungsdatum
$_SESSION['customer_wallet'] = 000; // @float = Inhalt der eigenen Geldbörse, in BPT mit Punktnotation
$_SESSION['link_customer'] = 'https://code2025.de/BestPrimeDev/welcomeCustomer?refUserId='; // @str = Der erste Teil des Links, der für Kundenwerbung verwendet wird z.B.:  https://einsparen.de/?customer=

/** Office */

/** Marketing */
$_SESSION['marketing_scool_video']['n']['listName'] = ''; // @string = Name des Videos für die Liste; [n] @int => Nummer des Videos in der aktuellen Abfrage
$_SESSION['marketing_scool_video']['n']['videoName'] = ''; // @string = Dateiname des Videos; [n] @int => Nummer des Videos in der aktuellen Abfrage
// $vorschauBild = explode('.', $_SESSION['marketing_scool_video']['n']['videoName']);
// $_SESSION['marketing_scool_video']['n']['vorschauBild'] = $vorschauBild[0]; // @string = Dateiname des Vorschaubildes; [n] @int => Nummer des Videos in der aktuellen Abfrage

/** Lieferanten */
$_SESSION['user_supplierSector'][0] = 0; // @int = Sparte, die der Lieferant bedient: 0 = Strom, 1 = DSL, 2 = Mobilfunk, 3 = KFZ, 4 = Shopping; dabei bedeutet 0: Nein, 1: Ja

/** getJSON
 * wird aufgerufen durch das Frontend (via api.php?) und fordert JSON-Daten an
 * Nur für Test-Phase nötig
 * @param string jsonData = die Bezeichnung der angeforderten JSON-Daten
 */
function getJSON($jsonData)
{
    switch ($jsonData) {
        case 'singleUser':
            $jsonData = $_SESSION['root'] . 'js/singleUser.json';
            break;
        case 'multiUser':
            $jsonData = $_SESSION['root'] . 'js/multiUser.json';
            break;
        case 'customerList':
            $jsonData = $_SESSION['root'] . 'js/customerList.json';
            break;
        case 'newsTable':
            $jsonData = $_SESSION['root'] . 'js/newsTable.json';
            break;
        case 'contractList':
            $jsonData = $_SESSION['root'] . 'js/contractList.json';
            break;
        case 'incomeList':
            $jsonData = $_SESSION['root'] . 'js/incomeList.json';
            break;
        case 'badChildListing':
            $jsonData = $_SESSION['root'] . 'js/badChidListing.json';
            break;
        case 'comparePower':
            $jsonData = $_SESSION['root'] . 'js/comparePower.json';
            break;
    }
    $json = file_get_contents($jsonData);
    $jsonArray = json_decode($json, true);
    // sleep(2); // nur zur Simulation
    return $jsonArray;
}

/** pointToComma
 * wandelt einen Betrag, der in Punktnotation gegeben wurde in ein 
 * zweistelliges Kommaergebnis um
 * @float $point = der Betrag in Punktnotation
 * @return float = der Wert in zweistelliger Kommannotation
 */
function pointToComma($point)
{
    return number_format(floatval($point), 2, ',', '');
}

/** numerableRank
 * Liefert den numerischen Wert des übergebenen Ranks       Mittlerweile obsolet?!
 *  @param string $rank   User-Rank im Klartext
 *  @param int $rankNumber   Wert für Rückgabe
 *  @return User-Rank als Integer 
 */
function numerableRank($rank)
{
    switch ($rank) {
        case 'Kunde':
            $rankNumber = 10;
            break;
        case 'Starter':
            $rankNumber = 20;
            break;
        case 'Berater':
            $rankNumber = 30;
            break;
        case 'Junior Berater':
            $rankNumber = 40;
            break;
        case 'Senior Berater':
            $rankNumber = 50;
            break;
        case 'Manager':
            $rankNumber = 60;
            break;
        case 'Regional Direktor':
            $rankNumber = 70;
            break;
        case 'National Direktor':
            $rankNumber = 80;
            break;
        case 'Präsident':
            $rankNumber = 90;
            break;
        default:
            $rankNumber = 02;
    }
    return $rankNumber;
}

/** numerableAuthorization
 *  @param string $auth   User-Rank im Klartext
 *  @param int $authNumber   Wert für Rückgabe
 *  @return Berechtigungsgruppe als Integer
 */
function numerableAuthorization($auth)
{
    switch ($auth) {
        case 'Kunde':
            $authNumber = 10;
            break;
        case 'BPL':
            $authNumber = 110;
            break;
        case 'BPP':
            $authNumber = 120;
            break;
        case 'BPX':
            $authNumber = 130;
            break;
        case 'Marketing':
            $authNumber = 210;
            break;
        case 'Accounting':
            $authNumber = 220;
            break;
        case 'Antragsabteilung':
            $authNumber = 230;
            break;
        case 'Support Level 1':
            $authNumber = 240;
            break;
        case 'Support Level 2':
            $authNumber = 250;
            break;
        case 'Business Angel':
            $authNumber = 260;
            break;
        case 'Savas':
            $authNumber = 310;
            break;
        case 'Super Admin':
            $authNumber = 320;
            break;
        default:
            $authNumber = 02;
    }
    return $authNumber;
}

/** loadTestCustomer
 * Die Variablen werden für einen Testuser belegt
 *  
 */
function loadTestCustomer()
{
    // $_SESSION['user_id'] = 12345678901234; // @int = Die 14-stellige Kunden-Nummer aus dem timestamp
    // $_SESSION['user_role'] = 'customer'; // @str = Die Rolle als Klarname
    // $_SESSION['customer_dealerID'] = 100000001; // @int = ID des zuständigen Vertriebspartners
    // $_SESSION['customer_dealerName'] = 'Max Headroom'; // @str = Klarname des zuständigen Vertriebspartners
    $_SESSION['customer_signedIn'] = true; // @bool = Steht auf TRUE, wenn der Kunde erfolgreich angemeldet ist
    $_SESSION['customer_title'] = ''; // @str = Namenszusatz
    // $_SESSION['user_firstName'] = 'Max'; // @str = Der (die) Vorname(n)
    // $_SESSION['user_surName'] = 'Mustermann'; // @str = Der Nachname
    $_SESSION['user_salutation'] = 'Herr'; // @str = Anrede
    $_SESSION['user_street'] = 'Musterstraße'; // @str = Straße
    $_SESSION['user_houseNumber'] = '123a'; // @str = Hausnummer
    $_SESSION['user_additionalAdress'] = 'Rückgebäude hinten'; // @str = Adresszusatz
    $_SESSION['user_country'] = 'Musterland'; // @str = Land
    $_SESSION['user_email'] = 'mustermann@mustermail.com'; // @str = E-Mail-Adresse
    $_SESSION['user_password'] = '*********'; // @str = Passwort (verschlüsselt)
    $_SESSION['customer_acceptAgb'] = 00000000000000; // @int = Timestamp für das Akzeptieren der AGB
    $_SESSION['customer_acceptDse'] = 00000000000000; // @int = Timestamp für das Lesen der DSE
    $_SESSION['customer_acceptNewsletter'] = 00000000000000; // @int = Timestamp für das Akzeptieren des Newsletters
    $_SESSION['customer_phone'] = '+49123/4567890'; // @str = Festnetznummer für Rückfragen
    $_SESSION['user_mobile'] = '+49123/4567890'; // @str = Handynummer für Verifizierungen
    $_SESSION['customer_contractPower'] = true; // @bool = Steht auf TRUE, wenn ein Vertrag für Strom vorhanden ist
    $_SESSION['customer_contractGas'] = false; // @bool = Steht auf TRUE, wenn ein Vertrag für Gas vorhanden ist
    $_SESSION['customer_contractDsl'] = false; // @bool = Steht auf TRUE, wenn ein Vertrag für DSL vorhanden ist
    $_SESSION['customer_contractMobile'] = false; // @bool = Steht auf TRUE, wenn ein Vertrag für Mobilfunk vorhanden ist
    $_SESSION['customer_contractSolar'] = false; // @bool = Steht auf TRUE, wenn ein Vertrag für Solaranlage vorhanden ist
    $_SESSION['customer_recommendation'] = 1; // @int = Anzahl der erfolgreichen Empfehlungen
    $_SESSION['customer_openTicket'] = false; // @bool = Steht auf TRUE, wenn ein Supportticket eröffnet und noch nicht wieder geschlossen wurde
    $_SESSION['user_zip'] = 12345; // @int = Postleitzahl des Wohnortes
    // $_SESSION['user_residence'] = 'Musterstadt'; // @str = Der Wohnort
    // $_SESSION['user_birthDate'] = '31.12.1999'; // @str = Geburtsdatum
    $_SESSION['user_sex'] = 'male'; // @str = Geschlecht
    // $_SESSION['user_regDate'] = '12.10.2021'; // @str = Registrierungsdatum
    $_SESSION['customer_wallet'] = 345.67; // @float = Inhalt der eigenen Geldbörse, in BPT mit Punktnotation
    $_SESSION['link_customer'] = 'https://code2025.de/BestPrimeDev/welcomeCustomer?refUserId='; // @str = Der erste Teil des Links, der für Kundenwerbung verwendet wird z.B.:  https://einsparen.de/?customer=

}

/** loadTestUser
 * Die Variablen werden für einen Controler belegt
 *  
 */
function loadTestController()
{
    /** Allgemein */
    // $_SESSION['user_id'] = 999999999; // @int = Einzigartige ID -> 14-stellig (aus timestamp) - unabhängig von der Rolle
    $_SESSION['user_role'] = 'controller'; // @str = Die Rolle als Klarname
    $_SESSION['user_firstName'] = 'Savas'; // @str = Der (die) Vorname(n)
    $_SESSION['user_surName'] = 'Uzun'; // @str = Der Nachname
    $_SESSION['user_salutation'] = 'Herr'; // @str = Anrede
    $_SESSION['user_street'] = 'Musterstraße'; // @str = Straße
    $_SESSION['user_houseNumber'] = '123a'; // @str = Hausnummer
    $_SESSION['user_additionalAdress'] = 'Rückgebäude hinten'; // @str = Adresszusatz
    $_SESSION['user_zip'] = 93097; // @int = Postleitzahl des Wohnortes
    $_SESSION['user_residence'] = 'Regensburg'; // @str = Der Wohnort
    $_SESSION['user_birthDate'] = '31.12.1999'; // @str = Geburtsdatum
    $_SESSION['user_sex'] = 'male'; // @str = Geschlecht
    $_SESSION['user_regDate'] = '12.10.2021'; // @str = Registrierungsdatum
    $_SESSION['customer_wallet'] = 345.67; // @float = Inhalt der eigenen Geldbörse, in BPT mit Punktnotation
    $_SESSION['user_country'] = 'Musterland'; // @str = Land
    $_SESSION['user_email'] = 'mustermann@mustermail.com'; // @str = E-Mail-Adresse

}

/** loadTestUser
 * Die Variablen werden für einen Testuser belegt
 *  
 */
function loadTestUser()
{
    /** Allgemein */
    // $_SESSION['user_id'] = 1234; // @int = Einzigartige ID -> 14-stellig (aus timestamp) - unabhängig von der Rolle
    $_SESSION['user_partnerID'] = 100001; // @int = Einzigartige ID des Partners, aus der hervorgeht zu welchem Partnernetz dieser gehört
    // $_SESSION['user_rank'] = ''; // @str = Die aktuelle Position / Rolle als Klarname
    // $_SESSION['user_role'] = 'partner'; // @str = Die Rolle als Klarname
    $_SESSION['user_nextRank'] = ''; // @str = Die nächste Position auf der Karriereleiter / Rolle als Klarname
    $_SESSION['user_missingCareerUnits'] = ''; // @str = Die fehlenden Einheiten zum Erreichen der nächsten Karrierestufe
    $_SESSION['user_status'] = true; // @bool = Der aktuelle Status des Users. Hat er eine gültige Lizenz -> true
    $_SESSION['user_logInTime'] = time(); // @int = Der Timestamp des Logins
    $_SESSION['user_picturePath'] = '123456789/images/'; // @str = relativer Pfad der Bilder ab "media/users/"
    $_SESSION['user_wallet'] = 123.45; // @float = Inhalt der eigenen Geldbörse, in Euro mit Punktnotation
    /** Kunden */
    $_SESSION['customer_dealerID'] = 987654321; // @int = ID des zuständigen Vertriebspartners
    $_SESSION['user_wallet'] = 123.45; // @float = Inhalt der eigenen Geldbörse, in Euro mit Punktnotation


    /** Vertriebspartner */
    $_SESSION['user_ownUnits'] = 33; // @int = Eigene Einheiten
    $_SESSION['user_missingUnits'] = 23; // @int = Eigene Einheiten
    $_SESSION['user_ownOpenUnits'] = 12; // @int = Eigene Einheiten, die noch nicht bestätigt wurden
    $_SESSION['user_ownOpenCommission'] = 456.78; // @float = Eigene Provision, die noch unbestätigt ist, in Euro mit Punktnotation
    $_SESSION['user_ownPaidCommission'] = 3456.78; // @float = Eigene Provision, die bereits ausbezahlt wurden, in Euro mit Punktnotation
    $_SESSION['user_ownSaldo'] = 2346.78; // @float = Offenes Saldo, das der Partner in Rechnung stellen muss, in Euro mit Punktnotation
    $_SESSION['user_directChilds'] = 5; // @int = Anzahl direkter Filialen
    $_SESSION['user_grandChilds'] = 20; // @int = Anzahl indirekter Filialen (in zweiter Ebene)
    $_SESSION['user_childUnits'] = 99; // @int = Einheiten aus Filialen
    $_SESSION['user_childCommission'] = 99.00; // @float = Provision aus Filialen, in Euro mit Punktnotation
    $_SESSION['user_ancestorID'] = 123456788; // @int = ID des direkten Vorfahren
    $_SESSION['user_authGroup'] = 'BPX'; // @string = Berechtigungsgruppe
    $_SESSION['user_authNumber'] = numerableAuthorization($_SESSION['user_authGroup']);
    // $_SESSION['user_rank'] = 'König der Herzen'; // Nur zu Testzwecken!
    // $_SESSION['user_xTime'] = strtotime('18 October 2021 12:00:00'); // @int = Zeitpunkt, an dem der X-Countdown abläuft in Sekunden

}


/** Marketing */
$_SESSION['marketing_scool_video'][1]['listName'] = 'Herzlich Willkommen'; // @string = Name des Videos für die Liste; [n] @int => Nummer des Videos in der aktuellen Abfrage
$_SESSION['marketing_scool_video'][1]['videoName'] = 'werbevideo.mp4'; // @string = Dateiname des Videos; [n] @int => Nummer des Videos in der aktuellen Abfrage
$_SESSION['marketing_scool_video'][2]['listName'] = 'Deine ersten Schritte?'; // @string = Name des Videos für die Liste; [n] @int => Nummer des Videos in der aktuellen Abfrage
$_SESSION['marketing_scool_video'][2]['videoName'] = 'werbevideo.mp4'; // @string = Dateiname des Videos; [n] @int => Nummer des Videos in der aktuellen Abfrage
$_SESSION['marketing_scool_video'][3]['listName'] = 'Wie verdienst Du Geld?'; // @string = Name des Videos für die Liste; [n] @int => Nummer des Videos in der aktuellen Abfrage
$_SESSION['marketing_scool_video'][3]['videoName'] = 'werbevideo.mp4'; // @string = Dateiname des Videos; [n] @int => Nummer des Videos in der aktuellen Abfrage
$_SESSION['marketing_scool_video'][4]['listName'] = 'Xpress Bonus'; // @string = Name des Videos für die Liste; [n] @int => Nummer des Videos in der aktuellen Abfrage
$_SESSION['marketing_scool_video'][4]['videoName'] = 'werbevideo.mp4'; // @string = Dateiname des Videos; [n] @int => Nummer des Videos in der aktuellen Abfrage



/** makeEuro
 * macht aus dem Integer der Cent-Beträge einen Euro-Betrag im herkömmlichen Format
 * @param string $category  Der Name der gewünschten Kategorie, für die Abfrage der Session-Variable
 * @param int $euro  Der Integerwert in Euro
 * @return $euro
 */
function makeEuro($category)
{
    $euro = $_SESSION[$category] / 100;
    //$euro = substr_replace($euro, ',', -3, 1);
    return $euro;
}
