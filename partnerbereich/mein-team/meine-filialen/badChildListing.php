
<?php 
include_once "../php/inc_functions.php";
$counter = 1;
$jsonArray = getJSON('badChildListing');
$count = count($jsonArray['user_childs']);
$hasChild = false; // Initialisierung für den Fall einer fehlerhaften Abfrage
echo '<div id="badChildListingContainer">';
    foreach ($jsonArray['user_childs'] as $Array)
    {
        $border = 'good';
        if ($Array['user_status']){
            $user_status = '<div class="user_status">Status: <span class="green">aktiv</span></div>';
        } else {
            $user_status = '<div class="user_status">Status: <span class="red">inaktiv!</span></div>';
            $border = 'bad';
        }
        if ($Array['user_licence']){
            $user_licence = '<div class="user_licence">Lizenz: <span class="green">aktiv</span></div>';
        } else {
            $user_licence = '<div class="user_licence">Lizenz: <span class="red">inaktiv!</span></div>';
            $border = 'bad';
        }
        if ($Array['user_ownFault']==false){
            $user_ownFault = '<div class="user_ownFault">Störung: <span class="green">nein</span></div>';
        } else {
            $user_ownFault = '<div class="user_ownFault">Störung: <span class="red">ja!</span></div>';
            $border = 'bad';
        }
    echo '<div id="depth'.$counter.'" class="badChildField '.$border.'">';
        echo '<div class="user_partnerID">Partner-ID:'.$Array['user_partnerID'].'</div>';
        echo $user_status;
        echo $user_licence;
        echo '<div class="user_rank">Karriere-Stufe:'.$Array['user_rank'].'</div>';
        echo $user_ownFault;
    echo '</div>';
    echo '<div class="verticalLine"></div>';
    $counter++;
    }


echo '';
?>

</div>