<?php
$jsonArray2 = json_decode($response, true);
// $new = json_decode($response);
$responseNumber = count($jsonArray2);
?>
<div id="customerTableNumber">Es wurden <span id="number"><?php echo $responseNumber; ?></span> Datensätze gefunden</div>
<div id="customerTable" class="table">
    <div class="TableRow headline">
        <div class="user_id headline">Kunden-Nr.</div>
        <div class="customer_name headline">Kundenname</div>
        <div class="customer_contractPower headline">Strom-Vertrag</div>
        <div class="customer_contractGas headline">Gas-Vertrag</div>
        <div class="customer_contractDsl headline">DSL-Vertrag</div>
        <div class="customer_contractMobile headline">Mobilfunk-Vertrag</div>
        <div class="customer_contractSolar headline">Solar-Vertrag</div>
        <div class="customer_openTicket headline">Störung</div>
        <div class="customer_recommendation headline">Empfehlungen</div>
    </div>
    <?php
    foreach ($jsonArray2 as $Array) {
        if ($Array['user_salutation'] != 'bitte wählen') {
            $userName = $Array['user_salutation'] . ' ' . $Array['user_firstName'] . ' ' . $Array['user_surName'];
        } else {
            $userName = $Array['user_firstName'] . ' ' . $Array['user_surName'];
        }
        if ($Array['customer_contractPower']) {
            $customer_contractPower = '<div class="customer_contractPower green">aktiv</div>';
        } else {
            $customer_contractPower = '<div class="customer_contractPower red">inaktiv</div>';
        }
        if ($Array['customer_contractGas']) {
            $customer_contractGas = '<div class="customer_contractGas green">aktiv</div>';
        } else {
            $customer_contractGas = '<div class="customer_contractGas red">inaktiv</div>';
        }
        if ($Array['customer_contractDsl']) {
            $customer_contractDsl = '<div class="customer_contractDsl green">aktiv</div>';
        } else {
            $customer_contractDsl = '<div class="customer_contractDsl red">inaktiv</div>';
        }
        if ($Array['customer_contractMobile']) {
            $customer_contractMobile = '<div class="customer_contractMobile green">aktiv</div>';
        } else {
            $customer_contractMobile = '<div class="customer_contractMobile red">inaktiv</div>';
        }
        if ($Array['customer_contractSolar']) {
            $customer_contractSolar = '<div class="customer_contractSolar green">aktiv</div>';
        } else {
            $customer_contractSolar = '<div class="customer_contractSolar red">inaktiv</div>';
        }
        if ($Array['customer_openTicket']) {
            $customer_openTicket = '<div class="customer_openTicket red">vorhanden</div>';
        } else {
            $customer_openTicket = '<div class="customer_openTicket green">keine</div>';
        }
        if ($Array['customer_recommendation']) {
            $customer_recommendation = '<div class="customer_recommendation green">' . $Array['customer_recommendation'] . '</div>';
        } else {
            $customer_recommendation = '<div class="customer_recommendation red">keine</div>';
        }
        echo '<div id="customerTableRow' . $counter . '" class="TableRow pointer"" onclick="getDataArray(\'loadOneCustomer\',' . $Array['user_id'] . ')">';
        echo '<div class="user_id">' . $Array['user_id'] . '</div>';
        echo '<div class="customer_name">' . $userName . '</div>';
        echo $customer_contractPower;
        echo $customer_contractGas;
        echo $customer_contractDsl;
        echo $customer_contractMobile;
        echo $customer_contractSolar;
        echo $customer_openTicket;
        echo $customer_recommendation;
        echo '</div>';
        $counter++;
    }
    ?>
</div>