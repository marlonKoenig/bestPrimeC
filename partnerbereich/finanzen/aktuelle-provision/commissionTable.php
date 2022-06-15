<?php
// zum testen
//$response = file_get_contents('../../../js/singleUser.json');
$payOutHistory = json_decode($payOutHistory, true);
$maxAvailableBalanceForTransferring = json_decode($maxAvailableBalanceForTransferring, true);
// print_r($payOutHistory);
/** Tabellenwerte, Link und Bezeichnung für PDF-Dokument müssen noch angepasst werden
 * sowohl hier, als auch in der content.php
 */
?>
<div id="headline">Provisionsanforderungen</div>
<div id="commissionTable">
    <div class="TableRow first">
        <div class="table-cell text">
            <b>Maximal verfügbare Provision</b>
        </div>
        <div class="table-cell value">
            <?php echo $maxAvailableBalanceForTransferring['maxAvailableBalanceForTransferring']; ?> €
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
        <div class="table-cell document">Provisionsabrechnung</div>
    </div>

    <?php
    $statusMap =  array("waiting_for_approval" => "Warten auf Freigabe", "transferred" => "Überwiesen", "rejected", "Abgelehnt");
    foreach ($payOutHistory as $payOut) {
        $status = isset($statusMap[$payOut["status"]]) ? $statusMap[$payOut["status"]] : "";
        $transferredTime = $payOut["transferred_timestamp"] ? date("d.m.Y H:i:s", strtotime($payOut["transferred_timestamp"])) : "";
        echo '    <div class="TableRow">
        <div class="table-cell id">' . $payOut["id"] . '</div>
        <div class="table-cell status"><button>' . $status . '</button></div>
        <div class="table-cell value">' . intval(str_replace($payOut["amount"], ".", ",")) . '</div>
        <div class="table-cell currency">Euro</div>
        <div class="table-cell queryTime">' . date("d.m.Y H:i:s", strtotime($payOut["request_timestamp"])) . '</div>
        <div class="table-cell payTime">' . $transferredTime . '</div>
        <div class="table-cell document"></div>
        </div>';
        // <div class="table-cell document"><a href="<?php echo \'../../../media/webseite/documents/AGB.pdf\'; " target="blank">Gutschrift</a></div>
    }

    ?>

    <!-- <div class="TableRow">
        <div class="table-cell id">26</div>
        <div class="table-cell status"><span>wartet auf Freigabe</span></div>
        <div class="table-cell value">500,00</div>
        <div class="table-cell currency">Euro</div>
        <div class="table-cell queryTime">26.11.2021 16:37:39</div>
        <div class="table-cell payTime"> </div>
        <div class="table-cell document"><a href="<?php echo '../../../media/webseite/documents/AGB.pdf'; ?>" target="blank">Gutschrift</a></div>
    </div> -->
</div>