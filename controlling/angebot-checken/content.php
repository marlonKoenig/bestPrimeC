<?php
$counter = 1;
// $json = @file_get_contents($root . 'js/contractList.json');
// $jsonArray = json_decode($json, true);
// // JSON-Daten vom Server laden
// $jsonArray = getJSON('contractList');
$jsonArray = (array) json_decode(getAllOpenContracts());
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <h2>Überprüfung offener Verträge</h2>
        <div id="introContractControlling">
            Aktuell stehen <span id="number" class="red"><?php echo count($jsonArray); ?></span> Verträge zur Prüfung an.
        </div>
        <div id="contractTable" class="table">
            <div class="TableRow headline">
                <div class="order_type">Typ</div>
                <div class="order_status">Status</div>
                <div class="order_id">Auftrag Nr.</div>
                <div class="user_id">Kunden-Nr.</div>
                <div class="customer_name">Kundenname</div>
                <div class="order_product">Produkt</div>
                <div class="order_dealer">Anbieter</div>
                <div class="order_date">Anlagedatum</div>
                <div class="order_start">Lieferstart</div>
                <div class="order_fault">Störung</div>
            </div>
            <?php
            foreach ($jsonArray as $Array) {
                $Array = (array) $Array;
                if ($Array['user_salutation'] != 'bitte wählen') {
                    $userName = $Array['user_salutation'] . ' ' . $Array['user_firstName'] . ' ' . $Array['user_surName'];
                } else {
                    $userName = $Array['user_firstName'] . ' ' . $Array['user_surName'];
                }
                if ($Array['order_status']) {
                    $order_status = '<div class="order_status green">aktiv</div>';
                } else {
                    $order_status = '<div class="order_status red">inaktiv</div>';
                }
                echo '<div id="customerTableRow' . $counter . '" class="TableRow linkable" onclick="loadContract(this)">';
                echo '<div class="order_type">' . $Array['order_type'] . '</div>';
                echo $order_status;
                echo '<div class="order_id">' . $Array['order_id'] . '</div>';
                echo '<div class="user_id">' . $Array['user_id'] . '</div>';
                echo '<div class="customer_name">' . $userName . '</div>';
                echo '<div class="order_product">' . $Array['order_product'] . '</div>';
                echo '<div class="order_dealer">' . $Array['order_dealer'] . '</div>';
                echo '<div class="order_date">' . $Array['order_date'] . '</div>';
                echo '<div class="order_start">' . $Array['order_start'] . '</div>';
                echo '<div class="order_fault">' . $Array['order_fault'] . '</div>';
                echo '</div>';
                $counter++;
            }
            ?>
        </div>
    </div>
</section>