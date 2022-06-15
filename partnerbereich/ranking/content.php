<?php

include_once $root . "php/inc_branchStatistics.php";

$dailyRanking = json_decode(getBestPartnersAllTime(getAllUsersFromBranch($_SESSION["user_id"]), "currentDay"), true);
$monthlyRanking = json_decode(getBestPartnersAllTime(getAllUsersFromBranch($_SESSION["user_id"]), "currentMonth"), true);
$allTimeRanking = json_decode(getBestPartnersAllTime(getAllUsersFromBranch($_SESSION["user_id"]), "allTime"), true);
$ownUnits = getAllUnitsFromBranch($_SESSION["user_id"], "x");

?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="firstRow" class="containerRow">
            <div id="videoContainer">
                <video controls class="videoTarget" src="<?php echo $image_path . 'videos/werbevideo.mp4'; ?>" type="video/mp4">
            </div>
            <div id="personalContainer">
                <div id="avatar">
                    <img src="<?php echo $image_path . 'icons/colorAvatar.png'; ?>">
                </div>
                <div id="textArea">
                    <div id="rightUp">
                        <img src="<?php echo $image_path . 'icons/medal.png'; ?>">
                        <span>Rangliste</span>
                    </div>
                    <div id="rightDown">
                        <div>Gesamtpunktzahl</div>
                        <div><?php echo $ownUnits["totalOwnClosedUnits"] + $ownUnits["totalIndirectClosedUnits"]; ?> Einheiten</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tableContainer">
            <div id="daylyTable">
                <h3 class="">
                    Top-Partner heute
                </h3>
                <div class="table">
                    <div class="TableRow headline">
                        <div class="ranking">Rang</div>
                        <div class="partnerName">Name</div>
                        <div class="units">Einheiten</div>
                    </div>
                    <?php
                    for ($i = 0; $i < count($dailyRanking); $i++) {
                        echo '<div class="TableRow">';


                        // if (count($dailyRanking) == $i + 1 && count($dailyRanking) < 10) {
                        //     echo '<div class="ranking"></div>';
                        //     echo '<div class="partnerName">Keine weiteren Datensätze vorhanden</div>';
                        //     echo '<div class="units">&nbsp;</div>';
                        // } else {
                        echo '<div class="ranking">' . $i + 1 . '</div>';
                        echo '<div class="partnerName">' . $dailyRanking[$i]["partnerName"] . '</div>';
                        echo '<div class="units">' . $dailyRanking[$i]["units"] . '</div>';
                        // }

                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <div id="monthlyTable">
                <h3 class="">
                    Top-Partner in diesem Monat
                </h3>
                <div class="table">
                    <div class="TableRow headline">
                        <div class="ranking">Rang</div>
                        <div class="partnerName">Name</div>
                        <div class="units">Einheiten</div>
                    </div>
                    <?php
                    for ($i = 0; $i < count($monthlyRanking); $i++) {
                        echo '<div class="TableRow">';


                        // if (count($monthlyRanking) - 1 == $i && count($monthlyRanking) < 10) {
                        //     echo '<div class="ranking"></div>';
                        //     echo '<div class="partnerName">Keine weiteren Datensätze vorhanden</div>';
                        //     echo '<div class="units">&nbsp;</div>';
                        // } else {
                        echo '<div class="ranking">' . $i + 1 . '</div>';
                        echo '<div class="partnerName">' . $monthlyRanking[$i]["partnerName"] . '</div>';
                        echo '<div class="units">' . $monthlyRanking[$i]["units"] . '</div>';
                        // }

                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <div id="allTable">
                <h3 class="">
                    Top-Partner aller Zeiten
                </h3>
                <div class="table">
                    <div class="TableRow headline">
                        <div class="ranking">Rang</div>
                        <div class="partnerName">Name</div>
                        <div class="units">Einheiten</div>
                    </div>
                    <?php
                    for ($i = 0; $i < count($allTimeRanking); $i++) {
                        echo '<div class="TableRow">';


                        // if (count($allTimeRanking) - 1 == $i && count($allTimeRanking) < 10) {
                        //     echo '<div class="ranking"></div>';
                        //     echo '<div class="partnerName">Keine weiteren Datensätze vorhanden</div>';
                        //     echo '<div class="units">&nbsp;</div>';
                        // } else {
                        echo '<div class="ranking">' . $i + 1 . '</div>';
                        echo '<div class="partnerName">' . $allTimeRanking[$i]["partnerName"] . '</div>';
                        echo '<div class="units">' . $allTimeRanking[$i]["units"] . '</div>';
                        // }

                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>