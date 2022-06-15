<?php
// $json2 = @file_get_contents($root . 'js/contractList.json');
$jsonArray = json_decode($response, true);
// JSON-Daten vom Server laden
// $jsonArray = getJSON('contractList');
// $new = json_decode($response);
// $responseNumber = count($new->response);
$responseNumber = count($jsonArray);
$counter = 1;
?>
<div id="customerTableNumber">Es wurden <span id="number" class="green"><?php echo $responseNumber; ?></span> Datensätze
    gefunden
</div>
<div id="customerTable" class="table">
    <div class="TableRow headline">
        <div class="order_type headline">Antragssart</div>
        <div class="order_dealer headline">Anbieter</div>
        <div class="order_product headline">Angebotssname</div>
        <div class="order_date headline">Antragsdatum</div>
        <div class="order_start headline">Startdatum</div>
        <div class="contract_document headline">Antragsformular</div>
        <div class="order_fault headline">Störung</div>
    </div>
    <?php
    foreach ($jsonArray as $Array) {
        echo '<div id="customerTableRow' . $counter . '" class="TableRow">';
        echo '<div class="order_type">' . $Array['order_type'] . '</div>';
        echo '<div class="order_dealer">' . $Array['order_dealer'] . '</div>';
        echo '<div class="order_product">' . $Array['order_product'] . '</div>';
        echo '<div class="order_date">' . $Array['order_date'] . '</div>';
        echo '<div class="order_start">' . $Array['order_start'] . '</div>';
        echo '<div class="contract_document"><a href="../media/users/' . $Array['user_id'] . '/documents/' . $Array['contract_link'] . '"target="blank">' . $Array['contract_document'] . '</a></div>';
        echo '<div class="order_fault red">' . $Array['order_fault'] . '</div>';
        echo '</div>';
        $counter++;
    }
    ?>
</div>