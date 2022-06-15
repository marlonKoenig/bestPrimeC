<?php
// Anzahl der Verträge berechnen
$contractNumber = 0;
if ($_SESSION['customer_contractPower']) {
    $contractNumber++;
}
if ($_SESSION['customer_contractGas']) {
    $contractNumber++;
}
if ($_SESSION['customer_contractDsl']) {
    $contractNumber++;
}
if ($_SESSION['customer_contractMobile']) {
    $contractNumber++;
}
if ($_SESSION['customer_contractSolar']) {
    $contractNumber++;
}
$wallet = pointToComma($_SESSION['customer_wallet']);
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <h2>Hallo <?php echo $_SESSION['user_firstName']; ?>,<br>
            hier siehst Du alle relevanten Informationen auf einen Blick.
        </h2>
        <div id="infoCenter">
            <div id="regDate" class="infoContainer no-break">
                <div class="infoContainerTop">Du hast Deinen Account bei BestPrime seit</div>
                <div class="infoContainerMiddle"><?php echo date('d.m.Y', strtotime($_SESSION['user_regDate']));; ?>
                </div>
                <div class="infoContainerBottom">Deine Accountnummer lautet:<br><span id="user_id"><?php echo $_SESSION['user_id']; ?></span></div>
            </div>
            <div id="contractNumber" class="infoContainer no-break">
                <div class="infoContainerTop">Gesamtzahl Deiner Anträge bei BestPrime</div>
                <div class="infoContainerMiddle"><?php echo $contractNumber; ?></div>
                <div class="infoContainerBottom">&nbsp;<br><span id="contractNumberDetails" onclick="loadAllOwnContracts();">-Details-</span></div>
            </div>
            <div id="wallet" class="infoContainer no-break">
                <div class="infoContainerTop">Dein aktuelles Cashback Guthaben beträgt</div>
                <div class="infoContainerMiddle">
                    <span id="walletBpt"><?php echo $contractNumber; ?> BPT</span><br>
                    <span id="walletEuro">entspricht: <?php echo pointToComma($contractNumber); ?> €</span>
                </div>
                <div class="infoContainerBottom">&nbsp;<br>-Details-</div>
            </div>
            <div id="recommendation" class="infoContainer no-break">
                <div class="infoContainerTop">Anzahl Deiner erfolgreichen Empfehlungen</div>
                <div class="infoContainerMiddle"><?php echo $_SESSION['customer_recommendation']; ?></div>
                <div class="infoContainerBottom">&nbsp;<br>-Details-</div>
            </div>
        </div>
        <div id="tableContainer"></div>
    </div>
</section>