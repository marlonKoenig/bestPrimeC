<?php
$ownCommission = number_format($_SESSION['user_ownCommission'], 2, ',', '');
$childCommission = number_format($_SESSION['user_childCommission'], 2, ',', '');
$ownSaldo = number_format($_SESSION['user_ownSaldo'], 2, ',', '');
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
        <div>Zu erwartende Einheiten&nbsp;&Provisionen</div>
        </div>
        <div id="tableBody" class="">
            <div id="einheitenFilialen">
                <div>Einheiten aus Filialen</div>
                <div id="einheitenFilialenValue" class="red"><?php echo $_SESSION['user_childUnits']; ?></div>
            </div>
            <div id="einheitenEigen">
                <div>Eigene Einheiten</div>
                <div id="einheitenEigenValue" class="red"><?php echo $_SESSION['user_ownUnits']; ?></div>
            </div>
            <div id="provisionenFilialen">
                <div>Provisionen aus Filialen</div>
                <div id="provisionenFilialenValue" class="red"><?php echo $childCommission; ?>&nbsp;€</div>
            </div>
            <div id="provisionenEigen">
                <div>Eigene Provisionen</div>
                <div id="provisionenEigenValue" class="red"><?php echo $ownCommission; ?>&nbsp;€</div>
            </div>
        </div>
    </div>
    <div id="startBlock3" class="movedown scroll">
        <div id="aufbauContainer">
            <div id="aufbauFilialen" class="aufbauTable">
                <div class="aufbauHead">
                    Dein&nbsp;persönlicher&nbsp;Empfehlungslink: AUFBAU FILIALEN
                </div>
                <div class="aufbauBody" onclick='copyToClipboard(this);'>
                    <div id="aufbauFilialLink" >
                        <?php echo $_SESSION['link_partner'] . $_SESSION['user_id']; ?>
                    </div>
                    <div class="copy">kopieren
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="3" stroke="currentColor" fill="none">
                            <rect x="11.13" y="17.72" width="33.92" height="36.85" rx="2.5"/>
                            <path d="M19.35,14.23V13.09a3.51,3.51,0,0,1,3.33-3.66H49.54a3.51,3.51,0,0,1,3.33,3.66V42.62a3.51,3.51,0,0,1-3.33,3.66H48.39"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div id="aufbauKunden" class="aufbauTable">
                <div class="aufbauHead">
                    Dein&nbsp;persönlicher&nbsp;Empfehlungslink: KUNDENGEWINNUNG
                </div>
                <div class="aufbauBody" onclick='copyToClipboard(this);'>
                    <div id="aufbauKundenLink">
                        <?php echo $_SESSION['link_kunde'] . $_SESSION['user_id']; ?>
                    </div>
                    <div class="copy">kopieren
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="3" stroke="currentColor" fill="none">
                            <rect x="11.13" y="17.72" width="33.92" height="36.85" rx="2.5"/>
                            <path d="M19.35,14.23V13.09a3.51,3.51,0,0,1,3.33-3.66H49.54a3.51,3.51,0,0,1,3.33,3.66V42.62a3.51,3.51,0,0,1-3.33,3.66H48.39"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="startBlock4" class="movedown scroll">
        <div id="verdienstContainer">
            <div id="verdienstHead">
                Dein aktueller Saldo
            </div>
            <div id="verdienstBody">
                <div id="verdienstText">
                    Bereit zur Rechnungsstellung
                </div>
                <div id="verdienstBetrag" class="green">
                    <?php echo $ownSaldo; ?>&nbsp;€
                </div>
                <div id="saldoButton" class="btn btn-orange">
                    Saldomitteilung anzeigen
                </div>
            </div>
        </div>
    </div>
</section>

