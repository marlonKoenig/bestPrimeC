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
    <div id="startBlock2bpl" class="movedown scroll flex flex-column no-break"> <!-- Sonderbehandlung für BPL -->
        <div id="bplGrid">
            <div id="container2" class="container">
                <div id="upgradeContainer">
                    <div id="upgradeHeader">
                        Dieses Design muss noch angepasst und mit Text versorgt werden!
                    </div>
                    <div id="upgradeBody" class="btn btn-blue">
                        <a href="https://www.mollie.com/de">
                            Hier klicken
                        </a>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</section>