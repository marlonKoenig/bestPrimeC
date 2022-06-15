<?php
$ownCommission = number_format($_SESSION['user_ownCommission'], 2, ',', '');
$childCommission = number_format($_SESSION['user_childCommission'], 2, ',', '');
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="dslContainer">
            <div id="dslFirstLine">
                <div id="plzContainer" class="firstLineDataContainer">
                    <label for="plz" class="firstLineDescription">PLZ</label> 
                    <input name="plz" id="plz" maxlength="5" placeholder="00000">
                </div>
                <div id="ortContainer" class="firstLineDataContainer">
                    <label for="ort" class="firstLineDescription">Ort</label> 
                    <input name="ort" id="ort" maxlength="45" placeholder="Musterort">
                </div>
                <div id="strasseContainer" class="firstLineDataContainer">
                    <label for="strasse" class="firstLineDescription">Straße</label> 
                    <input name="strasse" id="strasse" maxlength="45" placeholder="Musterstraße">
                </div>
                <div id="hsNrContainer" class="firstLineDataContainer">
                    <label for="hsNr" class="firstLineDescription">Haus-Nr.</label> 
                    <input name="hsNr" id="hsNr" maxlength="5" placeholder="00">
                </div>
                <div id="dslContainerButton">
                    <div class="btn btn-blue">Tarife anzeigen</div>
                </div>
            </div>
            <div id="dslContent">
                <div id="dslTable" class="tableRow">
                    <div class="anbieter headLine">Anbieter</div>
                    <div class="tarif headLine">Tarifname</div>
                    <div class="highlight headLine">Tarif-Highlights</div>
                    <div class="aktion headLine">Aktion</div>
                    <div class="gg headLine">GG</div>
                    <div class="ag headLine">AG</div>
                    <div class="einheiten headLine">Einheiten</div>
                    <div class="order headLine">Bestellen</div>

                    <div class="anbieter"><img src="<?php echo $image_path ?>icons/vodafone-512.webp"></div>
                    <div class="Tarif">Red Light extra</div>
                    <div class="highlight">
                        <div class="hl1">1</div>
                        <div class="hl2">2</div>
                        <div class="hl3">3</div>
                        <div class="hl4">4</div>
                        <div class="hl5">5</div>
                        <div class="hl6">6</div>
                    </div>
                    <div class="aktion" title="Folgeaktion möglich">A</div>
                    <div class="gg">19,99</div>
                    <div class="ag">69,99</div>
                    <div class="einheiten">1 EH</div>
                    <div class="order">
                        <div class="btn btn-blue">Antrag erfassen</div>
                    </div>
                    
                    <div class="anbieter"><img src="<?php echo $image_path ?>icons/vodafone-512.webp"></div>
                    <div class="Tarif">Red Light extra</div>
                    <div class="highlight">
                        <div class="hl1">1</div>
                        <div class="hl2">2</div>
                        <div class="hl3">3</div>
                        <div class="hl4">4</div>
                        <div class="hl5">5</div>
                        <div class="hl6">6</div>
                    </div>
                    <div class="aktion">A</div>
                    <div class="gg">19,99</div>
                    <div class="ag">69,99</div>
                    <div class="einheiten">1 EH</div>
                    <div class="order">
                        <div class="btn btn-blue">Antrag erfassen</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>