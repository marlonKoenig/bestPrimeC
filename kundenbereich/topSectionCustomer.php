<?php

?>
<section id="topSection" class="">
    <a href="<?php echo $customer_path ?>">
        <img src="<?php echo $image_path . 'icons/Logo-bestPrime.png' ?>" class="logo" alt="BestPrime">
    </a>
    <div id="consultantContainer">
        <div>
            Dein Berater:
        </div>
        <div id="customer_dealerName">
            <?php echo $_SESSION['customer_dealerName']; ?>
        </div>
    </div>
    <div id="topsectionButtonContainer" class="none">
        <div id="buttonRow">
            <div id="callAdvisorButton" class="advisorButton" onclick="callAdvisor(this);">Mit Berater verbinden</div>
            <a id="viewAdvisor" href="https://jitsi.fem.tu-ilmenau.de/BestPrimeDev-<?php echo $_SESSION['user_id']; ?>" target="blank">
                <div id="viewAdvisorButton" class="advisorButton">Videoanruf mit Berater</div>
            </a>
        </div>
    </div>
</section>