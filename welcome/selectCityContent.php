<section id="welcomContentContainer" class="flex flex-column">
    <div id="welcomeStartBlock" class="movedown scroll">
        <div id="inputContainer">
            <div id="inputContainerHeader">
                <div>
                    <img id="icon1" src="<?php echo $image_path; ?>icons/haken-gruen.png">
                </div>
                <div id="step1">
                    Länderauswahl
                </div>
                <div>
                    <img id="icon2" src="<?php echo $image_path; ?>icons/red-arrow-right.png">
                </div>
                <div id="step2">
                    Stadtauswahl
                </div>
                <div>
                    <img id="icon3" src="<?php echo $image_path; ?>icons/red-arrow-right.png">
                </div>
                <div id="step3">
                    Persönliche Daten
                </div>
                <div>
                    <img id="icon4" src="<?php echo $image_path; ?>icons/red-arrow-right.png">
                </div>
                <div id="step4">
                    Produkt auswählen
                </div>
            </div>
            <div id="sponsor"><span id="sponsorenText">Dein Sponsor: </span><span id="sponsorName"><?php echo $partnerData->firstName . " " . $partnerData->lastName; ?></span></div>

            <div class="inputArea">
                <div id="landPicture" class="picture">
                    <img src="<?php echo $server; ?>/media/webseite/images/germany.png" alt="Deutschland gehört jetzt Dir">
                </div>
                <div id="inputTable">
                    <label for="inputSelect">
                        Wähle Deine Stadt aus:
                        <input id="targetCity" name="targetCity" placeholder="Deine Stadt">
                    </label>
                    <div id="checkButton" class="btn btn-red">prüfen</div>
                    <div id="inputTableAnswer" class="none"></div>
                    <div id="refContainer" data-user-ref="<?php echo $_GET["refUserId"]; ?>">
                        <div id="loadButton" class="btn btn-green none" data-step="2" onclick="loadWelcome(this)" data-zip="">
                            weiter
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>