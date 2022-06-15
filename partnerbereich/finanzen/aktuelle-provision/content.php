<?php

// JSON-Daten vom Server laden
$jsonArray = getJSON('singleUser');

include_once($root . "php/billing.php");
include_once($root . "php/inc_branchStatistics.php");
$expectedProvisions = getPartnerExpectedProvisions($_SESSION["user_id"]);
$balance = json_decode(getBalance($_SESSION["user_id"]));
// print_r($balance);
if (!isset($_GET["timespan"])) $_GET["timespan"] = "";
$revenueForTimestamp = json_decode(getRevenueForTimespan($_SESSION["user_id"], $_GET["timespan"]));
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="teamContainer">
            <div id="userOwnCommission" class="cards" title="Bereits abgerechnete und überwiesene Beträge">
                <div class="header">
                    Meine Gesamt Provisionen
                </div>
                <div class="graphics">
                    <img src="<?php echo $image_path . 'icons/money.png'; ?>">
                </div>
                <div class="total">
                    <?php echo pointToComma($balance->totalEarnedBalance); ?>&nbsp;€
                </div>
                <div class="commission" title="Deine eigenen bereits abgerechneten und überwiesenen Beträge">
                    <span class="cardText">Eigen:&nbsp;</span><?php echo pointToComma($balance->ownTotalEarnedBalance); ?>&nbsp;€
                </div>
            </div>
            <div id="userOwnSaldo" class="cards">
                <div class="header">
                    Mein aktuelles Provisionsguthaben
                </div>
                <div class="graphics">
                    <img src="<?php echo $image_path . 'icons/wallet.png'; ?>">
                </div>
                <div class="gesamt pointer" onclick="sendCommissionQuery();">
                    <?php echo pointToComma($balance->availableBalance); ?>&nbsp;€<br>
                </div>
                <div id="callCommisionQuery" onclick="sendCommissionQuery();">Jetzt auszahlen</div>
            </div>
            <div id="futureCommission" class="cards">
                <div class="header">
                    Zu erwartende Provision
                </div>
                <div class="graphics">
                    <img src="<?php echo $image_path . 'icons/cash.png'; ?>">
                </div>
                <div class="gesamt">
                    <?php echo $expectedProvisions['indirectBranchProvisionsExpected']; ?>&nbsp;€
                </div>
                <div class="commission">
                    <span class="cardText">Eigen:&nbsp;</span><?php echo $expectedProvisions["ownProvisionsExpected"]; ?>&nbsp;€
                </div>
            </div>
        </div>
        <div id="tableContainer">
            <div id="headline">Verdienste</div>
            <div id="flexRow">
                <div id="buttonContainer" class="card">
                    <div class="caption">&nbsp;</div>
                    <div id="buttonColumn" class="materialCard">
                        <div id="timeButton1" class="button" data-period="thisMonth" onclick="loadCommission(this)">Diesen Monat</div>
                        <div id="timeButton2" class="button" data-period="lastMonth" onclick="loadCommission(this)">Letzten Monat</div>
                        <div id="timeButton3" class="button" data-period="lastThreeMonths" onclick="loadCommission(this)">Letzte 3 Monate</div>
                        <div id="timeButton4" class="button" data-period="lastSixMonths" onclick="loadCommission(this)">Letzte 6 Monate</div>
                        <div id="timeButton5" class="button" data-period="wholeTime" onclick="loadCommission(this)">Alle Daten</div>
                    </div>
                </div>
                <div id="allIn" class="card">
                    <div class="caption">Alle Einnahmen</div>
                    <div class="materialCard col-2">
                        <div class="tableRow">
                            <div class="tableCell left">Strom</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->total_energy_contract_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">Gas</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->total_gas_contract_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">DSL</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->total_dsl_contract_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">Mobil</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->total_mobile_communication_contract_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">Shopping</div>
                            <div class="tableCell right">
                                <?php echo "0,00"; ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">XPress Bonus</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->total_xpress_bonus_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="spacer">&nbsp;</div>
                        <div class="tableRow">
                            <div class="tableCell left">Gesamt</div>
                            <div class="tableCell right green"><?php echo $revenueForTimestamp->totalRevenue; ?>&nbsp;€
                            </div>
                        </div>
                    </div>
                </div>
                <div id="ownIn" class="card">
                    <div class="caption">Eigene Einnahmen</div>
                    <div class="materialCard col-2">
                        <div class="tableRow">
                            <div class="tableCell left">Strom</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->own_energy_contract_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">Gas</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->own_gas_contract_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">DSL</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->own_dsl_contract_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">Mobil</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->own_mobile_communication_contract_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">Shopping</div>
                            <div class="tableCell right">
                                <?php echo "0,00"; ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">XPress Bonus</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->own_xpress_bonus_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="spacer">&nbsp;</div>
                        <div class="tableRow">
                            <div class="tableCell left">Gesamt</div>
                            <div class="tableCell right green"><?php echo pointToComma($revenueForTimestamp->ownTotalRevenue); ?>&nbsp;€
                            </div>
                        </div>
                    </div>
                </div>
                <div id="childsIn" class="card">
                    <div class="caption">Fillial Einnahmen</div>
                    <div class="materialCard col-2">
                        <div class="tableRow">
                            <div class="tableCell left">Strom</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->team_energy_contract_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">Gas</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->team_gas_contract_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">DSL</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->team_dsl_contract_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">Mobil</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->team_mobile_communication_contract_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">Shopping</div>
                            <div class="tableCell right">
                                <?php echo "0,00"; ?>&nbsp;€</div>
                        </div>
                        <div class="tableRow">
                            <div class="tableCell left">XPress Bonus</div>
                            <div class="tableCell right">
                                <?php echo pointToComma($revenueForTimestamp->team_xpress_bonus_revenue); ?>&nbsp;€</div>
                        </div>
                        <div class="spacer">&nbsp;</div>
                        <div class="tableRow">
                            <div class="tableCell left">Gesamt</div>
                            <div class="tableCell right green"><?php echo pointToComma($revenueForTimestamp->teamTotalRevenue); ?>&nbsp;€</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="commissionFooter">
                <div class="button blue" onclick="sendCommissionQuery();">Meine Provisionsabrechnungen</div>
            </div>
        </div>
    </div>
</section>

<script>
    const buttonColumn = document.querySelector('#buttonColumn').children;
    const urlTimespanString = '<?php echo $_GET["timespan"]; ?>';
    let buttonActivated = false;
    for (let i in buttonColumn) {
        try {
            let button = buttonColumn[i];
            if (button.dataset.period == urlTimespanString || (button.dataset.period == "wholeTime" && !urlTimespanString)) {
                button.classList.add("activ");
            };
        } catch (error) {
            console.log(error);
        }
    }
</script>