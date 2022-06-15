<?php
$ownCommission = number_format($_SESSION['user_ownCommission'], 2, ',', '');
$childCommission = number_format($_SESSION['user_childCommission'], 2, ',', '');
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="tgrHeadline">Comming soon... Wird demnächst freigeschaltet!</div>
        <div id="pictureContainer">
            <div id="unternehmer">
                <img src="<?php echo $image_path; ?>/images/unternehmerLanding.png">
            </div>
            <div id="unternehmer">
                <img src="<?php echo $image_path; ?>/images/studententenLanding.png">
            </div>
            <div id="unternehmer">
                <img src="<?php echo $image_path; ?>/images/AlleineLanding.png">
            </div>
            <div id="unternehmer">
                <img src="<?php echo $image_path; ?>/images/handwerkerLanding.png">
            </div>
            <div id="unternehmer">
                <img src="<?php echo $image_path; ?>/images/networkerLanding.png">
            </div>
            <div id="unternehmer">
                <img src="<?php echo $image_path; ?>/images/arbeitslosLanding.png">
            </div>
        </div>
    </div>
</section>