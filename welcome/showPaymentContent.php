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
                    <img id="icon2" src="<?php echo $image_path; ?>icons/haken-gruen.png">
                </div>
                <div id="step2">
                    Stadtauswahl
                </div>
                <div>
                    <img id="icon3" src="<?php echo $image_path; ?>icons/haken-gruen.png">
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

            <div class="flex-row marginTopBig no-break">
                <img src="<?php echo $GLOBALS["domain"]; ?>/media/webseite/images/paymentProduct.png" alt="" style="align-self: flex-start" class="marginRightMedium">
                <div class="marginLeftMedium">
                    <h3 class="marginTopNone">STM-Store</h3>
                    <div>
                        Store Flat Inhalte:<br>
                        <ul>
                            <li>
                                Produkt Module: <b>Strom / DSL / Mobilfunk / Lebensmittel / Reisen und vieles mehr</b>
                            </li>
                            <li>
                                Zugang zum <b>storeXX Learn Space</b>
                            </li>
                        </ul>
                        <br>
                        <h3 class="lineThrough">statt: 2.990€<small> brutto</small></h3>
                        <h3 class="marginTopMedium">jetzt nur: <span class="underline fontSizeMedium">690&nbsp;€
                            </span>(brutto*)
                        </h3>
                        *einmalig und nach 12 Monaten jährlich 99.-€ (brutto) Verlängerungsgebühr
                    </div>
                    <br><br>
                    <div class="btn btn-green marginNone" onclick="payPartnerLicense();">Bezahlen</div>
                </div>
            </div>

        </div>
    </div>
</section>