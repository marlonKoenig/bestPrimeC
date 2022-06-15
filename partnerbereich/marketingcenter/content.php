<?php
$ownCommission = number_format($_SESSION['user_ownCommission'], 2, ',', '');
$childCommission = number_format($_SESSION['user_childCommission'], 2, ',', '');
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        Bitte wähle eine entsprechende Unterkategorie:
        <ul>
            <Li>
                <a href="businessrechner">Businessrechner</a>
            </Li>
            <Li>
                <a href="onlineberatung">Online-Beratung</a>
            </Li>
            <Li>
                <a href="tgr24">TGR 24</a>
            </Li>
            <Li>
                <a href="socialpost">Social Postings</a>
            </Li>
        </ul>
    </div>
</section>