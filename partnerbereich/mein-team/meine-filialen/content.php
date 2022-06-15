<?php
$counter = 1; // Zähler für die Tabellenzeilen
// JSON-Daten vom Server laden
include_once($root . "php/inc_branchStatistics.php");
$jsonArray =  json_decode(getDirectBranchesPartnerData($_SESSION["user_id"]));
// $jsonArray = getJSON('multiUser');
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="introCard">
            Direkte Fillialen
        </div>
        <div id="teamTable" class="table">
            <div id="TableHead" class="TableRow headline">
                <div class="user_id">Fil-Nr.</div>
                <div class="user_status">Paket</div>
                <div class="sponsor">Sponsor</div>
                <div class="email">E-Mail</div>
                <div class="firstName">Vorname</div>
                <div class="surName">Nachname</div>
                <div class="regDate">Reg.-Datum</div>
                <div class="rank">Karriere-Stufe</div>
                <div class="user_workPlace">Gebiet</div>
                <div class="details">Details</div>
            </div>
            <?php
            foreach ($jsonArray as $Array) {
                if (true == true) { //$Array["user_status"]
                    $status = '<div class="user_status green">ja</div>';
                } else {
                    $status =  '<div class="user_status red">nein</div>';
                }
                echo '<div id="TableRow' . $counter . '" class="TableRow">';
                echo '<div class="user_id">' . $Array->partner_id . '</div>';
                // echo $status;
                echo '<div class="user_id green">bezahlt</div>';
                echo '<div class="sponsor">' . $Array->sponsorName . '</div>';
                echo '<div class="email">' . $Array->email . '</div>';
                echo '<div class="firstName">' . $Array->firstName . '</div>';
                echo '<div class="surName">' . $Array->lastName . '</div>';
                echo '<div class="regDate">' . date("d.m.Y", strtotime($Array->regDate)) . '</div>';
                echo '<div class="rank">' . $Array->rank . '</div>';
                echo '<div class="user_workPlace">' . $Array->user_workPlace . '</div>';
                echo '<div class="details" data-user_id="' . $Array->user_id . '" onclick="loadDetails(this)"><div class="btn btn-blue">Details</div></div>';
                echo '</div>';
                $counter++;
            }
            ?>
        </div>
        <div id="loadIn"></div>
    </div>
</section>