<?php
$root = '../../media/';
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
$new = json_decode($response);
$name = $new->user_firstName . ' ' . $new->user_surName;
if ($new->order_status) {
    $order_status = '<div class="order_status green">aktiv</div>';
} else {
    $order_status = '<div class="order_status red">inaktiv</div>';
}
?>
<div id="contractContainer">
    <?php
    echo '<div class="row"><div id="user_salutation=">' . $new->user_salutation . '</div><div id="user_name">' . $name . '</div></div>';
    echo '<div class="row"><div id="order_type">Typ: ' . $new->order_type . '</div>' . $order_status . '</div>';
    echo '<div class="row"><div id="order_id">Auftrag Nr: ' . $new->order_id . ' </div><div id="order_date">Anlagedatum: ' . $new->order_date . '</div></div>';
    echo '<div class="row"><div id="order_dealer">Anbieter: ' . $new->order_dealer . ' </div><div id="order_product"> Produkt: ' . $new->order_product . '</div></div>';
    echo '<div class="row"><div id="order_fault">Störung: ' . $new->order_fault . '</div></div>';
    echo '<div class="row"><div class="contract_document"><a href="' . $root . $new->contract_link . '" target="blank" class="green">' . $new->contract_document . '</a></div></div>';
    ?>
</div>
<div id="buttonRow">
    <div id="buttonAccept" onclick="confirmContract('<?php echo $new->order_id; ?>')">Auftrag freigeben</div>
</div>
<div id="answerText" class="green"></div>