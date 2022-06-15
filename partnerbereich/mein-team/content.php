<?php
// JSON-Daten vom Server laden
$jsonArray = getJSON('singleUser');

include_once($root . "php/inc_branchStatistics.php");
$cardData = json_decode(getMyTeamPageData($_SESSION["user_id"]));
$bestBranchesUnits = json_decode(getBestBranchOfUserUnits($_SESSION["user_id"]));
$bestBranchesNewDirectBranches = json_decode(getBestBranchOfUserDirectBranches($_SESSION["user_id"]));
$directBranches = json_decode(getDirectBranchesPartnerData($_SESSION["user_id"]));
$units =  getAllUnitsFromBranch($_SESSION["user_id"]);

// $user_ownPaidCommission = $jsonArray['user_ownPaidCommission'];
// $user_childCommission = $jsonArray['user_childCommission'];
// $totalCommission = $user_ownPaidCommission + $user_childCommission;
// $totalCommission = pointToComma($totalCommission);
// $user_childCommission = pointToComma($user_childCommission);
// $user_ownPaidCommission = pointToComma($user_ownPaidCommission);
// $totalChilds = $jsonArray['user_directChilds'] + $jsonArray['user_grandChilds'];
// $user_ownSaldo = pointToComma($jsonArray['user_ownSaldo']);
// $user_unitsCompareLastMonth = $jsonArray['user_unitsCompareLastMonth'];
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="teamContainer">
            <div id="userOwnCommission" class="cards" title="Bereits abgerechnete und überwiesene Beträge">
                <div class="header">
                    Meine Gesamt Provisionen
                </div>
                <div class="grafik">
                    <img src="<?php echo $image_path . 'icons/money.png'; ?>">
                </div>
                <div class="gesamt">
                    <?php echo $cardData->totalEarnedBalance; ?>&nbsp;€
                </div>
                <div class="commission" title="Deine eigenen bereits abgerechneten und überwiesenen Beträge">
                    <span class="cardText">Eigen:&nbsp;</span><?php echo $cardData->ownTotalEarnedBalance; ?>&nbsp;€
                </div>
                <div class="childCom" title="Die bereits abgerechneten und überwiesenen Beträge, Deiner Filialen">
                    <span class="cardText">Filialen:&nbsp;</span><?php echo $cardData->teamTotalEarnedBalance; ?>&nbsp;€
                </div>
            </div>
            <div id="userOwnChilds" class="cards">
                <div class="header">
                    Meine Filialen
                </div>
                <div class="grafik">
                    <img src="<?php echo $image_path . 'icons/childs.png'; ?>">
                </div>
                <div class="gesamt">
                    <?php echo $cardData->totalBranches; ?>
                </div>
                <div class="commission">
                    <span class="cardText">Team-Filialen:&nbsp;</span><?php echo $cardData->indirectBranches; ?>
                </div>
                <a href="meine-filialen" class="childCom">
                    <div>
                        <span class="cardText">Direkte Filialen:</span><?php echo $cardData->directBranches; ?>
                    </div>
                </a>
            </div>
            <div id="userOwnRank" class="cards">
                <div class="header">
                    Nächste Karrierestufe
                </div>
                <div class="grafik">
                    <img src="<?php echo $image_path . 'icons/oscar.png'; ?>">
                </div>
                <div id="nextRank" class="gesamt">
                    <?php echo $cardData->nextRankDisplayName; ?>
                </div>
                <div class="commission">
                    <span class="cardText">Fehlende Einheiten im Qualifikationsmonat:</span><span
                        id="missingUnits"><?php echo $cardData->missingUnitsToNextRank; ?></span><span class="cardText">
                        EH</span>
                </div>
            </div>
            <div id="userOwnSaldo" class="cards">
                <div class="header end"><span
                        id="userOwnSaldoValue"><?php echo $cardData->availableBalance; ?></span><span class="cardText">
                        €</span></div>
                <div class="grafik">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="3" stroke="currentColor"
                        fill="none">
                        <path
                            d="M15.68,52.27,8.27,41.12a1.2,1.2,0,0,1,.34-1.67l4.68-3a1.21,1.21,0,0,1,1.64.32l7.56,11a1.2,1.2,0,0,1-.32,1.67L17.35,52.6A1.2,1.2,0,0,1,15.68,52.27Z"
                            stroke-linecap="round" />
                        <path
                            d="M15.76,37.9l7.8-4.9a2.17,2.17,0,0,1,1.7-.27c2.77.71,11.1,3,14.17,4.08,2.31.81,3.24,3.09,2.31,4.59-1.26,2-3.18,1.81-4.56,1.42l-.55-.2-5.46-2.33"
                            stroke-linecap="round" />
                        <path
                            d="M21.81,46.75l2.55-1.46,14.43,4a1.06,1.06,0,0,0,.88-.14c2-1.3,10.71-7.06,15-10.09a2.4,2.4,0,0,0,.3-4,3.1,3.1,0,0,0-3.71-.33c-1.5.84-5.67,3.94-5.67,3.94"
                            stroke-linecap="round" />
                        <path d="M47.24,27.77A9.23,9.23,0,1,1,45.5,12.05" />
                        <line x1="27.76" y1="18.2" x2="43.13" y2="18.2" />
                        <line x1="27.76" y1="22.89" x2="41.28" y2="22.89" />
                    </svg>
                </div>
                <div class="commission">
                    Provisions Guthaben zum Abruf bereit
                </div>
            </div>
            <div id="userOwnDeficit" class="cards">
                <div class="header end"><span id="userOwnDeficitValue"><?php echo 0; ?></span><span class="cardText">
                        EH</span></div>
                <div class="grafik">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="3" stroke="currentColor"
                        fill="none">
                        <line x1="32.4" y1="54.7" x2="32.4" y2="9.25" />
                        <polyline points="50.41 37.47 32.25 54.7 15.71 37.47" />
                    </svg>
                </div>
                <div class="commission">
                    Einheiten Defizit zum Vormonat
                </div>
            </div>
            <div id="userNewChilds" class="cards">
                <div class="header end"><span
                        id="user_newChildsValue"><?php echo $cardData->branchSizeGrowthToLastMonth; ?></span></div>
                <div class="grafik">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="3" stroke="currentColor"
                        fill="none">
                        <line x1="32.4" y1="9.25" x2="32.4" y2="54.7" />
                        <polyline points="50.41 26.48 32.25 9.25 15.71 26.48" />
                    </svg>
                </div>
                <div class="commission">
                    Filiale Zuwachs zum Vormonat
                </div>
            </div>
        </div>
        <div id="childProblemsContainer">
            <div id="childProblemsHeadline"><span id="leftSide">Meine direkten Filialen:</span> <span
                    id="rightSide"><?php echo count($directBranches); ?></span></div>
            <div id="childProblemsOverview">
                <?php
                $i = 0;
                foreach ($directBranches as $branch) {
                    echo '<div class="childField" onclick="" data-user_id="10000' . $i . '" title="Filialen mit Störungen, werden hier rot angezeigt">'; //loadBadChild(this)
                    echo '<img src="' . $image_path . 'icons/child-white.png">';
                    echo '<div class="childTextField"><span class="green">' . $branch->directBranchSubBranches . '</span>/<span class="red">0</span></div>';
                    echo '</div>';
                    $i++;
                }
                ?>
            </div>
        </div>
        <div id="badChildTree"></div>
        <div id="tableContainer">
            <div id="childTable" class="tableContainer">
                <div class="tableContainerHeader">
                    <div>Meine besten Filialen</div>
                    <div class="subTitle">(Eigenumsatz aktueller Monat)</div>
                </div>
                <div class="table">
                    <div class="table-row">
                        <div class="name">Name</div>
                        <div class="einheiten">Einheiten</div>
                        <div class="stadt">Stadt</div>
                    </div>

                    <?php
                    $counter = count($bestBranchesUnits);
                    $forLen = count($bestBranchesUnits) > 7 ? 7 : count($bestBranchesUnits);
                    for ($i = 0; $i < $forLen; $i++) {
                        $branch = $bestBranchesUnits[$i];
                        echo "<div class='table-row'>
                        <div class='name'>{$branch->userName}</div>
                        <div class='einheiten'>{$branch->units}</div>
                        <div class='stadt'>{$branch->location}</div>
                        </div>";
                    }
                    //echo empty rows so that it looks better
                    while ($counter < 7) {
                        echo "<div class='table-row'>
                        <div class='name'>&nbsp;</div>
                        <div class='einheiten'>&nbsp;</div>
                        <div class='stadt'>&nbsp;</div>
                        </div>";

                        $counter++;
                    }

                    ?>
                </div>
            </div>
            <div id="recruiterTable" class="tableContainer">
                <div class="tableContainerHeader">
                    <div>Meine besten Recruiter</div>
                    <div class="subTitle">(Erstlinien aktueller Monat)</div>
                </div>
                <div class="table">
                    <div class="table-row">
                        <div class="name">Name</div>
                        <div class="einheiten">Erstlinien</div>
                        <div class="stadt">Stadt</div>
                    </div>


                    <?php
                    $counter = count($bestBranchesNewDirectBranches);
                    $forLen = count($bestBranchesNewDirectBranches) > 7 ? 7 : count($bestBranchesNewDirectBranches);
                    for ($i = 0; $i < $forLen; $i++) {
                        $branch = $bestBranchesNewDirectBranches[$i];
                        echo "<div class='table-row'>
                        <div class='name'>{$branch->userName}</div>
                        <div class='einheiten'>{$branch->newDirectBranches}</div>
                        <div class='stadt'>{$branch->location}</div>
                        </div>";
                    }
                    //echo empty rows so that it looks better
                    while ($counter < 7) {
                        echo "<div class='table-row'>
                        <div class='name'>&nbsp;</div>
                        <div class='einheiten'>&nbsp;</div>
                        <div class='stadt'>&nbsp;</div>
                        </div>";

                        $counter++;
                    }

                    ?>


                    <!-- <div class="table-row">
                        <div class="name">Savas</div>
                        <div class="einheiten">900</div>
                        <div class="stadt">Regensburg</div>
                    </div>
                    <div class="table-row">
                        <div class="name">Sylvia</div>
                        <div class="einheiten">800</div>
                        <div class="stadt">Dachau</div>
                    </div>
                    <div class="table-row">
                        <div class="name">Mert</div>
                        <div class="einheiten">750</div>
                        <div class="stadt">Bad Tölz</div>
                    </div>
                    <div class="table-row">
                        <div class="name">Maximilian</div>
                        <div class="einheiten">740</div>
                        <div class="stadt">Regensburg</div>
                    </div>
                    <div class="table-row">
                        <div class="name">Markus</div>
                        <div class="einheiten">720</div>
                        <div class="stadt">Erding</div>
                    </div>
                    <div class="table-row">
                        <div class="name">Kevin</div>
                        <div class="einheiten">150</div>
                        <div class="stadt">München</div>
                    </div>
                    <div class="table-row">
                        <div class="name">Mona Lisa</div>
                        <div class="einheiten">112</div>
                        <div class="stadt">Paris</div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>