<?php

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

$jsonArray = json_decode($response, true);
?>
<div id="singleUserTable">
    <div class="row">
        <div id="customer_title">Titel: <?php echo $jsonArray['customer_title']; ?></div>
        <div id="user_salutation">Anrede: <?php echo $jsonArray['user_salutation']; ?></div>
    </div>
    <div class="row">
        <div id="user_firstName">Vorname: <?php echo $jsonArray['user_firstName']; ?></div>
        <div id="user_surName">Nachname: <?php echo $jsonArray['user_surName']; ?></div>
    </div>
    <div class="row">
        <div id="user_birthDate">Geburtsdatum: <?php echo $jsonArray['user_birthDate']; ?></div>
        <div id="user_regDate">Registrierdatum: <?php echo $jsonArray['user_regDate']; ?></div>
    </div>
    <div class="row">
        <div id="user_mobile">Handy: <?php echo $jsonArray['user_mobile']; ?></div>
        <div id="customer_phone">Anrede: <?php echo $jsonArray['customer_phone']; ?></div>
    </div>
    <div class="row">
        <div id="user_street">Straße: <?php echo $jsonArray['user_street']; ?></div>
        <div id="user_houseNumber">Nr: <?php echo $jsonArray['user_houseNumber']; ?></div>
        <div id="user_additionalAdress">Zusatz: <?php echo $jsonArray['user_additionalAdress']; ?></div>
    </div>
    <div class="row">
        <div id="user_zip">PLZ: <?php echo $jsonArray['user_zip']; ?></div>
        <div id="user_residence">Stadt: <?php echo $jsonArray['user_residence']; ?></div>
    </div>
    <div class="row">
        <div id="user_sex">Geschlecht: <?php echo $jsonArray['user_sex']; ?></div>
        <div id="customer_wallet">Guthaben: <?php echo pointToComma($jsonArray['customer_wallet']); ?> BPT</div>
    </div>
    <div class="row">
        <div id="user_email">E-Mail: <?php echo $jsonArray['user_email']; ?></div>
    </div>
    <div class="row">
        <div id="customer_contractPower">Strom: <?php echo $jsonArray['customer_contractPower']; ?></div>
        <div id="customer_contractGas">Gas: <?php echo $jsonArray['customer_contractGas']; ?></div>
    </div>
    <div class="row">
        <div id="customer_contractDsl">DSL: <?php echo $jsonArray['customer_contractDsl']; ?></div>
        <div id="customer_contractMobile">Mobilfunk: <?php echo $jsonArray['customer_contractMobile']; ?></div>
    </div>
    <div class="row">
        <div id="customer_contractSolar">Solar: <?php echo $jsonArray['customer_contractSolar']; ?></div>
        <div id="customer_recommendation">Empfehlung: <?php echo $jsonArray['customer_recommendation']; ?></div>
    </div>
    <div class="row">
        <div id="customer_openTicket">Störung: <?php echo $jsonArray['customer_openTicket']; ?></div>
    </div>
    <h3>Design ist noch vorläufig</h3>
</div>