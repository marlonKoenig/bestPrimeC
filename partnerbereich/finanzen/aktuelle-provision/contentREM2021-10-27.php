<?php

// JSON-Daten vom Server laden
$jsonArray = getJSON('singleUser');

$user_ownPaidCommission = $jsonArray['user_ownPaidCommission'];
$user_childCommission = $jsonArray['user_childCommission'];
$totalCommission = $user_ownPaidCommission + $user_childCommission;
$totalCommission = pointToComma($totalCommission);
$user_ownSaldo = pointToComma($jsonArray['user_ownSaldo']);
$user_ownOpenCommission = pointToComma($jsonArray['user_ownOpenCommission']);
$user_ownSaldo = pointToComma($jsonArray['user_ownSaldo']);
$jsonArray2 = getJSON('incomeList');
$totalAllIncome = $jsonArray2['income_all_power'] + $jsonArray2['income_all_gas'] + $jsonArray2['income_all_dsl'] + $jsonArray2['income_all_mobile'] + $jsonArray2['income_all_shopping'];
$totalOwnIncome = $jsonArray2['income_own_power'] + $jsonArray2['income_own_gas'] + $jsonArray2['income_own_dsl'] + $jsonArray2['income_own_mobile'] + $jsonArray2['income_own_shopping'];
$totalChildIncome = $jsonArray2['income_child_power'] + $jsonArray2['income_child_gas'] + $jsonArray2['income_child_dsl'] + $jsonArray2['income_child_mobile'] + $jsonArray2['income_child_shopping'];

/** Tabellenwerte, Link und Bezeichnung für PDF-Dokument müssen noch angepasst werden
 * sowohl hier, als auch in der commissionTable.php
 */
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
                    <?php echo $totalCommission; ?>&nbsp;€
                </div>
                <div class="commission" title="Deine eigenen bereits abgerechneten und überwiesenen Beträge">
                    <span
                        class="cardText">Eigen:&nbsp;</span><?php echo pointToComma($user_ownPaidCommission); ?>&nbsp;€
                </div>
            </div>
            <div id="userOwnSaldo" class="cards">
                <div class="header">
                    Mein aktuelles Provisionsguthaben
                </div>
                <div class="graphics">
                    <img src="<?php echo $image_path . 'icons/wallet.png'; ?>">
                </div>
                <div class="gesamt">
                    <?php echo $user_ownSaldo; ?>&nbsp;€
                </div>
            </div>
            <div id="futureCommission" class="cards">
                <div class="header">
                    Zu erwartende Provision
                </div>
                <div class="graphics">
                    <img src="<?php echo $image_path . 'icons/cash.png'; ?>">
                </div>
                <div class="gesamt">
                    <?php echo $totalCommission; ?>&nbsp;€
                </div>
                <div class="commission">
                    <span class="cardText">Eigen:&nbsp;</span><?php echo $user_ownOpenCommission; ?>&nbsp;€
                </div>
            </div>
        </div>

        <div id="tableContainer"><?php // Einfügepunkt für commissionTable.php 
                                    ?>
            <div id="headline">Provisionsanforderungen</div>
            <div id="commissionTable">
                <div class="TableRow first">
                    <div class="table-cell text">
                        <b>Maximal verfügbare Provision</b>
                    </div>
                    <div class="table-cell value">
                        <?php echo $user_ownSaldo; ?> €
                    </div>
                    <div class="table-cell sendButton">
                        &nbsp;
                    </div>
                </div>
                <div class="TableRow second">
                    <div class="table-cell text">
                        Provisionsanfrage
                    </div>
                    <div class="table-cell value">
                        <input type="number" name="commissionQuery" id="commissionQuery">
                    </div>
                    <div class="table-cell sendButton">
                        <div id="commissionQueryButton" onclick="sendCommissionQuery();">
                            Anfrage absenden
                        </div>
                    </div>
                </div>
            </div>
            <div id="headline">Historie bisheriger Provisionsanforderungen</div>
            <div id="commissionHistoryTable" class="table">
                <div class="TableRow headline">
                    <div class="table-cell id">Anfrage-ID</div>
                    <div class="table-cell status">Status</div>
                    <div class="table-cell value">Betrag</div>
                    <div class="table-cell currency">Währung</div>
                    <div class="table-cell queryTime">Anfrage-Zeitpunkt</div>
                    <div class="table-cell payTime">Freigabe-Zeitpunkt</div>
                    <div class="table-cell document">Aktion</div>
                </div>
                <div class="TableRow">
                    <div class="table-cell id">26</div>
                    <div class="table-cell status"><span>wartet auf Freigabe</span></div>
                    <div class="table-cell value">500,00</div>
                    <div class="table-cell currency">Euro</div>
                    <div class="table-cell queryTime">26.11.2021 16:37:39</div>
                    <div class="table-cell payTime"> </div>
                    <div class="table-cell document"><a href="<?php echo $root . 'media/webseite/documents/AGB.pdf'; ?>"
                            target="blank">Gutschrift</a></div>
                </div>
            </div>
        </div>
    </div>
</section>