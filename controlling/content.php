<?php

?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <button id="monthlyBilling" onclick="monthlyBilling();">Monatsauswertungen starten</button>
        <h2>Hallo <?php echo $_SESSION['user_firstName']; ?>,<br>
            hier siehst Du alle relevanten Informationen auf einen Blick.
        </h2>
        <div id="infoCenter">
            <div id="contractNumber" class="infoContainer no-break">
                <div class="infoContainerTop">Anzahl neuer Verträge in den letzten 24 Std.</div>
                <div class="infoContainerMiddle">1286</div>
                <div class="infoContainerBottom">&nbsp;<br>-Details-</div>
            </div>
            <div id="regDate" class="infoContainer no-break">
                <div class="infoContainerTop">Anzahl aktuell, offener Verträge</div>
                <div class="infoContainerMiddle">487</div>
                <div class="infoContainerBottom">&nbsp;<br>-Details-</div>
            </div>
            <div id="wallet" class="infoContainer no-break">
                <div class="infoContainerTop">Anzahl neuer Partner in den letzten 24 Std.</div>
                <div class="infoContainerMiddle">310</div>
                <div class="infoContainerBottom">&nbsp;<br>-Details-</div>
            </div>
            <div id="recommendation" class="infoContainer no-break">
                <div class="infoContainerTop">Anzahl neuer Störungen in den letzten 24 Std.</div>
                <div class="infoContainerMiddle">18</div>
                <div class="infoContainerBottom">&nbsp;<br>-Details-</div>
            </div>
        </div>
    </div>
</section>