<section id="welcomContentContainer" class="flex flex-column">
    <div id="welcomeStartBlock" class="movedown scroll">
        <div id="inputContainer">
            <div id="inputContainerHeader">
                <div>
                    <img id="icon1" src="<?php echo $image_path; ?>icons/red-arrow-right.png">
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
                <div id="worldPicture" class="picture">
                    <img src="<?php echo $server; ?>/media/webseite/images/europe.png" alt="Die Welt gehört Dir">
                </div>
                <div id="inputTable">
                    <label for="inputSelect">
                        Wähle Dein Land aus:
                        <select id="inputSelect" name="inputSelect">
                            <option disabled>Belgien</option>
                            <option disabled>Polen</option>
                            <option disabled>Frankreich</option>
                            <option disabled>Österreich</option>
                            <option selected>Deutschland</option>
                            <option disabled>Schweiz</option>
                            <option disabled>Türkei</option>
                            <option disabled>Griechenland</option>
                        </select>
                    </label>
                    <div id="refContainer" data-user-ref="<?php echo $_GET["refUserId"]; ?>">
                        <div id="loadButton" class="btn btn-orange" data-step="1" onclick="loadWelcome(this)">weiter
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>