<?php
$counter = 1;
$json = @file_get_contents($root . 'js/customerList.json');
$jsonArray = json_decode($json, true);
// JSON-Daten vom Server laden
$jsonArray = getJSON('customerList');

$totalCustomerNumber = $jsonArray['user_ownCustomerNumber'] + $jsonArray['user_childCustomerNumber'];
$totalPowerCustomerNumber = $jsonArray['user_ownPowerCustomerNumber'] + $jsonArray['user_childPowerCustomerNumber'];
$totalGasCustomerNumber = $jsonArray['user_ownGasCustomerNumber'] + $jsonArray['user_childGasCustomerNumber'];
$totalDslCustomerNumber = $jsonArray['user_ownDslCustomerNumber'] + $jsonArray['user_childDslCustomerNumber'];
$totalMobileCustomerNumber = $jsonArray['user_ownMobileCustomerNumber'] + $jsonArray['user_childMobileCustomerNumber'];
$totalAllCustomerNumber = $jsonArray['user_ownAllCustomerNumber'] + $jsonArray['user_childAllCustomerNumber'];

?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">

        <div id="tableInserter"></div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        getDataArray('loadAllOnlineCustomer');
    })
</script>