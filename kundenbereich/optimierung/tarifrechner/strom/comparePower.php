<?php
$root = '../../../../media/webseite/icons/';
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
// sleep(1);
// echo count($response);
// print_r($response);
$new = json_decode($response);
$responseNumber = count($new->response);
// print_r($new);

/* // print_r($new->response);
// print_r($new->response[0]->special);
foreach($new->response as $key => $value){
    echo "<br>new<br>";
    echo $key;
    echo $value->supplier_logoLink;
}
 */
// echo ('Antwort: '.$response['response']['supplier_logoLink]']);
?>
<div id="firstCompareLine">
    <h2>Dein Stromvergleich</h2>
    <div id="compareResults">
        <div>
            <span id="compareHits"><?php echo $responseNumber; ?></span>
            <span id="compareText"> Tarife gefunden</span>
        </div>
        <div>
            <span>Die Ergebnisse werden für das Gebiet: </span><span id="comparePLZ"><?php echo $queryArray['plz']; ?></span><span> angezeigt.</span>
        </div>
    </div>
</div>
<div id="comparePowerContainer">
    <?php
    for ($i = 0; $i < $responseNumber; $i++) {
        $obj = $new->response[$i];
        $yearlyPrice = $obj->supplier_monthlyFee * 12;
        $yearlyPrice = pointToComma($yearlyPrice);
        $difference = pointToComma($queryArray['yearlyCost'] - $yearlyPrice);
        $differenceClass = 'green';
        if ($difference < 0) {
            $differenceClass = 'red';
        }
        echo '<div class="responseContainer">';
        echo '<div class="responseUpperLine"><div class="logo"><img src="' . $root . $obj->supplier_logoLink . '"></div><div class="supplier_tariff">' . $obj->supplier_tariff . '</div>';
        echo '<div class="supplier_monthlyFee"><small>Abschlag pro Monat: </small>' . pointToComma($obj->supplier_monthlyFee) . ' €*</div></div>';
        echo '<div class="offerData"><div class="left">';
        echo '<div class="small">Vertragslaufzeit</div><div class="supplier_runTime">' . $obj->supplier_runTime . '</div>';
        echo '<div class="special">';
        foreach ($obj->special as $item) {
            echo '<div class="specialItem small">' . $item . ' <img src="' . $root . 'haken-gruen.png"></div>';
        }
        echo '</div>'; // End of special
        echo '<div class=small">Kündigungsfrist</div><div class="supplier_terminationTime">' . $obj->supplier_terminationTime . '</div>';
        echo '</div>'; // End of left
        echo '<div class="right"><div class="small">Gesamtpreis pro Jahr</div><div class="yearlyPrice">' . $yearlyPrice . ' €</div>';
        echo '<div class="small">Ersparnis*:</div><div class="' . $differenceClass . '">' . $difference . ' €</div>';
        echo '<div class="small">*inkl. 19% MwSt.</div><div class="orderButton" data-offer-type="' . $obj->supplier_offerType . '" data-offer="' . $obj->supplier_offerNumber . '" onclick="startOrder(this)">Angebot erstellen</div>';
        echo '</div></div></div>';
    }
    ?>
</div>