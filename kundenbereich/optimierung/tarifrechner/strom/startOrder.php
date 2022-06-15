<?php
$root = '../../../../media/webseite/icons/';
$new = json_decode($response);
// echo '<br>';
// print_r($new);
//echo $new->user_id;
if ($new->user_salutation == 'bitte wählen') {
    $salutation = '';
} else {
    $salutation = $new->user_salutation . ' ';
}
$new->order_id = 'offer0815';
$name = $salutation . $new->user_title . $new->user_firstName . ' ' . $new->user_surName;
$strasse = $new->user_street . ' ' . $new->user_houseNumber . ' ' . $new->user_additionalAdress;
$city = $new->user_zip . ' ' . $new->user_residence . ' ' . $new->user_country;
?>
<div id="startOrderContainer">
    <div id="firstLine">
        <image src="<?php echo $root . 'info.png' ?>">Neues Angebot für die Belieferung mit Strom erstellen für Kunde: <?php echo $new->user_firstName . ' ' . $new->user_surName; ?>
    </div>
    <div class="dataContainer">
        <div id="nameContainer">
            <div class="topLine">
                Anschlussinhaber:
            </div><?php echo $new->customer_title; ?>
            <div id="row">
                <div id="name"><?php echo $name; ?></div>
            </div>
            <div id="row">
                <div id="street"><?php echo $strasse; ?></div>
            </div>
            <div id="row">
                <div id="city"><?php echo $city; ?></div>
            </div>
            <div id="row">
                <div id="birthdate">Geburtsdatum: <?php echo $new->user_birthDate; ?></div>
            </div>
            <div id="row">
                <div id="phone">Telefon: <?php echo $new->customer_phone; ?></div>
            </div>
            <div id="row">
                <div id="mobile">Mobil: <?php echo $new->user_mobile; ?></div>
            </div>
            <div id="row">
                <div id="email">E-Mail: <?php echo $new->user_email; ?></div>
            </div>
            <div class="topLine" id="contractData">Vertragsdaten:</div>
            <div id="row">
                <div id="provider">Anbieter: <?php echo 'EON'; ?></div>
            </div>
            <div id="row">
                <div>Art: <span id="kind"><?php echo 'Strom'; ?></span></div>
            </div>
            <div id="row">
                <div>Auftragsnummer: <span id="orderID"><?php echo 'Auftragsnummer'; ?></span></div>
            </div>
            <div id="row">
                <div id="tariff">Tarif: <?php echo 'Tarifname'; ?></div>
            </div>
            <div id="row">
                <div id="installPayment">Abschlag: <?php echo '123,56 €'; ?></div>
            </div>
            <div id="sendButton" onclick="makeOrder(<?php echo $new->offer_id; ?>)">Bestellen</div>
            <div id="appendText">
                An dieser Stelle wird sich das Aussehen noch ändern, sobald die weitere Kommunikation mit den Anbietern feststeht.
                Für den Probebetrieb gilt der Antrag hier als unterschrieben und bestellt.
            </div>
            <div id="answerText" class="green"></div>
        </div>
    </div>
</div>