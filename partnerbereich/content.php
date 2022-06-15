<?php


// JSON-Daten vom Server laden
// $jsonArray = getJSON('singleUser');
include_once($root . "php/inc_branchStatistics.php");
// $data = getPartnerDashboardProvisions($_SESSION["user_id"]);
$balance = json_decode(getBalance($_SESSION['user_id']));
$data = getPartnerExpectedProvisions($_SESSION["user_id"]);
$totalBranchData = (array) json_decode(getTotalBranchUnitsAndEarnedBalance($_SESSION["user_id"]));
// print_r($data);
// print_r($data);

// print_r($data);
// $ownCommission = pointToComma($jsonArray['user_ownCommission']); //number_format($_SESSION['user_ownCommission'], 2, ',', '');
// $childCommission = pointToComma($jsonArray['user_childCommission']); //number_format($_SESSION['user_childCommission'], 2, ',', '');
// $ownSaldo = pointToComma($jsonArray['user_ownSaldo']); //number_number_format($_SESSION['user_ownSaldo'], 2, ',', '');
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="scoolContainer">
            <div id="scoolList">
                <div id="scoolList1" class="scoolList" data-video-name="<?php echo $_SESSION['marketing_scool_video'][1]['videoName']; ?>" onclick="dataLoader(this,0);">
                    <?php echo $_SESSION['marketing_scool_video'][1]['listName']; ?>
                </div>
                <div id="scoolList2" class="scoolList" data-video-name="<?php echo $_SESSION['marketing_scool_video'][2]['videoName']; ?>" onclick="dataLoader(this,0);">
                    <?php echo $_SESSION['marketing_scool_video'][2]['listName']; ?>
                </div>
                <div id="scoolList3" class="scoolList" data-video-name="<?php echo $_SESSION['marketing_scool_video'][3]['videoName']; ?>" onclick="dataLoader(this,0);">
                    <?php echo $_SESSION['marketing_scool_video'][3]['listName']; ?>
                </div>
                <div id="scoolList4" class="scoolList" data-video-name="<?php echo $_SESSION['marketing_scool_video'][4]['videoName']; ?>" onclick="dataLoader(this,0);">
                    <?php echo $_SESSION['marketing_scool_video'][4]['listName']; ?>
                </div>
            </div>
            <div id="scoolVideo">
                <?php include_once $root . 'modules/videoplayer.php'; ?>
            </div>
        </div>
    </div>
    </div>
    <div id="startBlock2" class="movedown scroll flex flex-column">
        <div id="tableHeader" class="flex">
            <div>Einheiten &&nbsp;Provisionen</div>
        </div>
        <div id="tableBody" class="">
            <div id="einheitenFilialen" class="einheitenContainer">
                <div>Einheiten aus Filialen</div>
                <div id="einheitenFilialenValue" class="red"><?php echo floatval($data["totalIndirectOpenUnits"]);
                                                                ?></div>
                <div id="einheitenFilialenValue" class="lightGreen"><?php echo floatval($totalBranchData["indirectBranchesAllUnits"]);
                                                                    ?></div>
            </div>
            <div id="einheitenEigen" class="einheitenContainer">
                <div>Eigene Einheiten</div>
                <div id="einheitenEigenValue" class="red"><?php echo floatval($data["totalOwnOpenUnits"]);
                                                            ?></div>
                <div id="einheitenEigenValue" class="lightGreen"><?php echo floatval($totalBranchData["ownAllUnits"]);
                                                                    ?></div>
            </div>
            <div id="provisionenFilialen" class="einheitenContainer">
                <div>Provisionen aus Filialen</div>
                <div id="provisionenFilialenValue" class="red"><?php echo floatval($data["indirectBranchProvisionsExpected"]);
                                                                ?>&nbsp;€</div>
                <div id="provisionenFilialenValue" class="lightGreen"><?php echo floatval($totalBranchData["indirectBranchesTotalEarnings"]);
                                                                        ?>&nbsp;€</div>
            </div>
            <div id="provisionenEigen" class="einheitenContainer">
                <div>Eigene Provisionen</div>
                <div id="provisionenEigenValue" class="red"><?php echo floatval($data["ownProvisionsExpected"]);
                                                            ?>&nbsp;€</div>
                <div id="provisionenEigenValue" class="lightGreen"><?php echo floatval($totalBranchData["ownTotalEarnings"]);
                                                                    ?>&nbsp;€</div>
            </div>
        </div>
    </div>
    <div id="startBlock3" class="movedown scroll">
        <div id="aufbauContainer">
            <div id="aufbauFilialen" class="aufbauTable">
                <div class="aufbauHead">
                    Dein&nbsp;persönlicher&nbsp;Empfehlungslink: AUFBAU FILIALEN
                </div>
                <div class="aufbauBody" data-step="<?php echo $GLOBALS['domain'] . '/welcome?refUserId=' . $_SESSION['user_id']; ?>" onclick='copyToClipboard(this);'>
                    <div id="aufbauFilialLink">
                        <?php //echo 'Partner-Link für Partner: ' . $_SESSION['user_id']; 
                        ?>
                        Dein persönlicher Partner-Link
                    </div>
                    <div class="copy">kopieren
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="3" stroke="currentColor" fill="none">
                            <rect x="11.13" y="17.72" width="33.92" height="36.85" rx="2.5" />
                            <path d="M19.35,14.23V13.09a3.51,3.51,0,0,1,3.33-3.66H49.54a3.51,3.51,0,0,1,3.33,3.66V42.62a3.51,3.51,0,0,1-3.33,3.66H48.39" />
                        </svg>
                    </div>
                </div>
            </div>
            <div id="aufbauKunden" class="aufbauTable">
                <div class="aufbauHead backgroundDark">
                    Dein&nbsp;persönlicher&nbsp;Empfehlungslink: KUNDENGEWINNUNG
                </div>
                <div class="aufbauBody" data-step="<?php echo $GLOBALS['domain'] . '/welcomeCustomer?refUserId=' . $_SESSION['user_id']; ?>" onclick='copyToClipboard(this);'>
                    <div id="aufbauKundenLink">
                        <?php //echo 'Kunden-Link für Partner: ' . $_SESSION['user_id']; 
                        ?>
                        Dein persönlicher Kunden-Link
                    </div>
                    <div class="copy backgroundDark">kopieren
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="3" stroke="currentColor" fill="none">
                            <rect x="11.13" y="17.72" width="33.92" height="36.85" rx="2.5" />
                            <path d="M19.35,14.23V13.09a3.51,3.51,0,0,1,3.33-3.66H49.54a3.51,3.51,0,0,1,3.33,3.66V42.62a3.51,3.51,0,0,1-3.33,3.66H48.39" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="startBlock4" class="movedown scroll">
        <div id="verdienstContainer">
            <div id="verdienstHead">
                Dein aktuelles Provisionsguthaben
            </div>
            <div id="verdienstBody">
                <div id="verdienstText">
                    Bereit zur Anforderung
                </div>
                <div id="verdienstBetrag" class="green">
                    <?php echo $balance->availableBalance; ?>&nbsp;€
                </div>
                <!--<div id="saldoButton" class="btn btn-orange">
                    Saldomitteilung anzeigen
                </div>-->
            </div>
        </div>
    </div>
</section>


<script>

</script>