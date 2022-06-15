<?php
$counter = 1;
// $json = file_get_contents('../js/singleUser.json');
$json = $userData;
$jsonArray = (array) json_decode($json, true);
$jsonArray = (array) $jsonArray[0];
// print_r($jsonArray);
if ($jsonArray["user_status"] == true) {
    $user_status = '<div id ="user_status" class="microContainer"><div class="caption">Paket:</div><div class="text green">bezahlt</div></div>';
} else {
    $user_status = '<div id ="user_status" class="microContainer"><div class="caption">Paket:</div><div class="text red">offen</div></div>';
}
if ($jsonArray["user_license"] == true) {
    $user_license = '<div id ="user_license" class="microContainer"><div class="caption">Aktiv für Folgemonat:</div><div class="text green">ja</div></div>';
} else {
    $user_license = '<div id ="user_license" class="microContainer"><div class="caption">Aktiv für Folgemonat:</div><div class="text red">nein</div></div>';
}
?>
<div id="detailsContainer" class="">
    <div id="firstName" class="microContainer">
        <div class="caption">Vorname:</div>
        <div class="text"><?php echo $jsonArray['firstName']; ?></div>
    </div>
    <div id="surName" class="microContainer">
        <div class="caption">Nachname:</div>
        <div class="text"><?php echo $jsonArray['lastName']; ?></div>
    </div>
    <div id="user_workPlace" class="microContainer">
        <div class="caption">Gebiet:</div>
        <div class="text"><?php echo $jsonArray['user_workPlace']; ?></div>
    </div>
    <div id="regDate" class="microContainer">
        <div class="caption">Reg.-Datum:</div>
        <div class="text"><?php echo date("m.d.Y", strtotime($jsonArray['regDate'])); ?></div>
    </div>
    <?php echo $user_status; ?>
    <?php echo $user_license; ?>
    <div id="user_directChilds" class="microContainer">
        <div class="caption">Eigene Filialen:</div>
        <div class="text"><?php echo $jsonArray['directBranches']; ?></div>
    </div>
    <div id="user_totalChilds" class="microContainer">
        <div class="caption">Gesamt Filialen:</div>
        <div class="text"><?php echo $jsonArray["totalBranches"]; ?></div>
    </div>
    <div id="rank" class="microContainer">
        <div class="caption">Karriere-Stufe:</div>
        <div class="text"><?php echo $jsonArray['rank']; ?></div>
    </div>
    <div id="user_missingUnits" class="microContainer">
        <div class="caption">Fehlende Einheiten für nächste Stufe:</div>
        <div class="text"><?php echo $jsonArray['missingUnitsToNextRank']; ?></div>
    </div>
    <div id="user_picture"><img src=""></div>
</div>