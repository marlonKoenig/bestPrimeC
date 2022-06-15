<?php
include_once($root . "php/inc_branchStatistics.php");

$counter = 1;
$json = @file_get_contents($root . 'js/customerList.json');
$jsonArray = json_decode($json, true);
// JSON-Daten vom Server laden
// $jsonArray = getJSON('customerList');
$jsonArray = (array) json_decode(getBranchCustomerAreaStatistics($_SESSION["user_id"]));

$totalCustomerNumber = $jsonArray['user_ownCustomerNumber'] + $jsonArray['user_childCustomerNumber'];
$totalPowerCustomerNumber = $jsonArray['user_ownPowerCustomerNumber'] + $jsonArray['user_childPowerCustomerNumber'];
$totalGasCustomerNumber = $jsonArray['user_ownGasCustomerNumber'] + $jsonArray['user_childGasCustomerNumber'];
$totalDslCustomerNumber = $jsonArray['user_ownDslCustomerNumber'] + $jsonArray['user_childDslCustomerNumber'];
$totalMobileCustomerNumber = $jsonArray['user_ownMobileCustomerNumber'] + $jsonArray['user_childMobileCustomerNumber'];
$totalAllCustomerNumber = $jsonArray['user_ownAllCustomerNumber'] + $jsonArray['user_childAllCustomerNumber'];

?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="customerContainer">
            <div id="totalCustomerNumber" class="cards" title="Die Anzahl aller Kunden">
                <div class="header">
                    Meine Gesamt Kunden
                </div>
                <div class="graphics">
                    <img src="<?php echo $image_path . 'icons/peoples.png'; ?>">
                </div>
                <div class="total">
                    <?php echo $totalCustomerNumber; ?>
                </div>
                <div class="commission pointer" onclick="getDataArray('loadAllCustomerContractList')">
                    <span class="cardText">Eigen:&nbsp;</span><?php echo $jsonArray['user_ownCustomerNumber']; ?>
                </div>
                <div class="childCom">
                    <span class="cardText">Filialen:&nbsp;</span><?php echo $jsonArray['user_childCustomerNumber']; ?>
                </div>
            </div>
            <div id="totalPowerCustomerNumber" class="cards">
                <div class="header">
                    Strom-Kunden
                </div>
                <div class="graphics">
                    <img src="<?php echo $image_path . 'icons/plug.png'; ?>">
                </div>
                <div class="total">
                    <?php echo $totalPowerCustomerNumber; ?>
                </div>
                <div class="commission pointer" onclick="getDataArray('loadAllCustomerEnergyContractList')">
                    <span class="cardText">Eigen:&nbsp;</span><?php echo $jsonArray['user_ownPowerCustomerNumber']; ?>
                </div>
                <div class="childCom">
                    <span class="cardText">Filialen:&nbsp;</span><?php echo $jsonArray['user_childCustomerNumber']; ?>
                </div>
            </div>
            <div id="totalGasCustomerNumber" class="cards">
                <div class="header">
                    Gas-Kunden
                </div>
                <div class="graphics">
                    <img src="<?php echo $image_path . 'icons/gasFlame.png'; ?>">
                </div>
                <div class="total">
                    <?php echo $totalGasCustomerNumber; ?>
                </div>
                <div class="commission pointer" onclick="getDataArray('loadAllCustomerGasContractList')">
                    <span class="cardText">Eigen:&nbsp;</span><?php echo $jsonArray['user_ownGasCustomerNumber']; ?>
                </div>
                <div class="childCom">
                    <span class="cardText">Filialen:&nbsp;</span><?php echo $jsonArray['user_childGasCustomerNumber']; ?>
                </div>
            </div>
            <div id="totalDslCustomerNumber" class="cards">
                <div class="header">
                    DSL-Kunden
                </div>
                <div class="graphics">
                    <img src="<?php echo $image_path . 'icons/dsl.png'; ?>">
                </div>
                <div class="total">
                    <?php echo $totalDslCustomerNumber; ?>
                </div>
                <div class="commission pointer" onclick="getDataArray('loadAllCustomerDslContractList')">
                    <span class="cardText">Eigen:&nbsp;</span><?php echo $jsonArray['user_ownDslCustomerNumber']; ?>
                </div>
                <div class="childCom">
                    <span class="cardText">Filialen:&nbsp;</span><?php echo $jsonArray['user_childDslCustomerNumber']; ?>
                </div>
            </div>
            <div id="totalMobileCustomerNumber" class="cards">
                <div class="header">
                    Mobilfunk-Kunden
                </div>
                <div class="graphics">
                    <img src="<?php echo $image_path . 'icons/mobile.png'; ?>">
                </div>
                <div class="total">
                    <?php echo $totalMobileCustomerNumber; ?>
                </div>
                <div class="commission pointer" onclick="getDataArray('loadAllCustomerMobileCommunicationContractList')">
                    <span class="cardText">Eigen:&nbsp;</span><?php echo $jsonArray['user_ownMobileCustomerNumber']; ?>
                </div>
                <div class="childCom">
                    <span class="cardText">Filialen:&nbsp;</span><?php echo $jsonArray['user_childMobileCustomerNumber']; ?>
                </div>
            </div>
            <div id="totalAllCustomerNumber" class="cards">
                <div class="header">
                    Alle Accounts
                </div>
                <div class="graphics">
                    <img src="<?php echo $image_path . 'icons/app.png'; ?>">
                </div>
                <div id="nextRank" class="total">
                    <?php echo $totalAllCustomerNumber; ?>
                </div>
                <div class="commission pointer" onclick="getDataArray('loadAllCustomer')">
                    <span class="cardText">Eigen:&nbsp;</span class=""><?php echo $jsonArray['user_ownAllCustomerNumber']; ?>
                </div>
                <div class="childCom">
                    <span class="cardText">Filialen:&nbsp;</span><?php echo $jsonArray['user_childAllCustomerNumber']; ?>
                </div>
            </div>
        </div>
        <div id="tableInserter"></div>
    </div>
</section>