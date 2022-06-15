<?php
$ownCommission = number_format($_SESSION['user_ownCommission'], 2, ',', '');
$childCommission = number_format($_SESSION['user_childCommission'], 2, ',', '');
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="mobilContainer">
            <div id="mobilFirstLine">
                <div id="telekom" class="logoSection">
                    <img src="<?php echo $image_path; ?>icons/Telekom_logo.jpg" />
                </div>
                <div id="vodafone" class="logoSection">
                    <img src="<?php echo $image_path; ?>icons/Vodafone-Logo.jpg" />
                </div>
                <div id="einsUndEins" class="logoSection">
                    <img src="<?php echo $image_path; ?>icons/1_and_1_logo.jpeg" />
                </div>
                <div id="otelo" class="logoSection">
                    <img src="<?php echo $image_path; ?>icons/Otelo-Logo.jpeg" />
                </div>
                <div id="yourfone" class="logoSection">
                    <img src="<?php echo $image_path; ?>icons/yourfone.png" />
                </div>
                <div id="oTwo" class="logoSection">
                    <img src="<?php echo $image_path; ?>icons/O2_logo.jpeg" />
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
            <h3>Diese Seite ist derzeit noch in der Entwicklung und wird in der nächsten Phase fertiggestellt.</h3>
        </div>
    </div>
</section>