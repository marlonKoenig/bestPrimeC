<?php
$ownCommission = number_format($_SESSION['user_ownCommission'], 2, ',', '');
$childCommission = number_format($_SESSION['user_childCommission'], 2, ',', '');
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="kfzContainer">
            <div id="offerContainer">
                <h2>Neues Angebot</h2>
                <div id="intro">Passenden Tarif berechnen und Angebot erstellen</div>
                <div class="tableHead">Deckung:</div>
                <div id="deckung">
                    <div id="haftpflicht" onclick="groupSelector(this, 'group01')" class="group01">
                        nur<br>Haftplficht
                    </div>
                    <div id="teilkasko" onclick="groupSelector(this, 'group01')" class="group01">
                        nur<br>Teilkasko
                    </div>
                    <div id="vollkasko" onclick="groupSelector(this, 'group01')" class="group01">
                        nur<br>Vollkasko
                    </div>
                </div>
                <div class="tableHead">Selbstbeteiligung Vollkasko:</div>
                <div id="teilKasko" class="selbstBeteiligung">
                    <div id="teilKaskoOhne" onclick="groupSelector(this, 'group02')" class="group02">
                        Ohne
                    </div>
                    <div id="euro150teilKasko" onclick="groupSelector(this, 'group02')" class="group02">
                        150&nbsp;€
                    </div>
                    <div id="euro300teilKasko" onclick="groupSelector(this, 'group02')" class="group02">
                        300&nbsp;€
                    </div>
                    <div id="euro500teilKasko" onclick="groupSelector(this, 'group02')" class="group02">
                        500&nbsp;€
                    </div>
                    <div id="euro1000teilKasko" onclick="groupSelector(this, 'group02')" class="group02">
                        1000&nbsp;€
                    </div>
                    <div id="euro2500teilKasko" onclick="groupSelector(this, 'group02')" class="group02">
                        2500&nbsp;€
                    </div>
                </div>
                <div class="tableHead">Selbstbeteiligung Vollkasko:</div>
                <div id="vollKasko" class="selbstBeteiligung">
                    <div id="vollKaskoOhne" onclick="groupSelector(this, 'group03')" class="group03">
                        Ohne
                    </div>
                    <div id="euro150vollKasko" onclick="groupSelector(this, 'group03')" class="group03">
                        150&nbsp;€
                    </div>
                    <div id="euro300vollKasko" onclick="groupSelector(this, 'group03')" class="group03">
                        300&nbsp;€
                    </div>
                    <div id="euro500vollKasko" onclick="groupSelector(this, 'group03')" class="group03">
                        500&nbsp;€
                    </div>
                    <div id="euro1000vollKasko" onclick="groupSelector(this, 'group03')" class="group03">
                        1000&nbsp;€
                    </div>
                    <div id="euro2500vollKasko" onclick="groupSelector(this, 'group03')" class="group03">
                        2500&nbsp;€
                    </div>
                </div>
                <div class="tableHead">Werkstattauswahl:</div>
                <div id="werkstatt">
                    <div id="frei" onclick="groupSelector(this, 'group04')" class="group04">
                        Frei
                    </div>
                    <div id="versicherer" onclick="groupSelector(this, 'group04')" class="group04">
                        Durch<br>Versicherer
                    </div>
                    <div id="alle" onclick="groupSelector(this, 'group04')" class="group04">
                        Alle Tarife
                    </div>
                </div>
                <div class="tableHead">Zahlweise:</div>
                <div id="zahlweise">
                    <div id="monat" onclick="groupSelector(this, 'group05')" class="group05">
                        Monatlich
                    </div>
                    <div id="viertel" onclick="groupSelector(this, 'group05')" class="group05">
                        Viertel-Jährlich
                    </div>
                    <div id="halb" onclick="groupSelector(this, 'group05')" class="group05">
                        Halb-Jährlich
                    </div>
                    <div id="jahr" onclick="groupSelector(this, 'group05')" class="group05">
                        Jährlich
                    </div>
                </div>
                <div class="tableHead">Kilometerleistung:</div>
                <div id="kilometerLeistung">
                    <label for="kilometer">Kilometerleistung (jährlich):</label>
                    <input id="kilometer" type="number" min="10000" max="100000" step="5000" value="10000" name="kilometer" />
                </div>
                <div id="fireButton" class="btn btn-blue">
                    Absenden
                </div>
            </div>
            <div id="compareKfzInsurance">
                <img src="<?php echo $image_path ?>images/kfz-rheinland.jpeg">
                <img src="<?php echo $image_path ?>images/kfz-fahrlehrer.jpeg">
                <img src="<?php echo $image_path ?>images/kfz-generali.jpeg">
                <img src="<?php echo $image_path ?>images/kfz-zurich.jpeg">
                <img src="<?php echo $image_path ?>images/kfz-allianz.jpeg">
            </div>
        </div>
        <h3>Diese Seite ist derzeit noch in der Entwicklung und wird in der nächsten Phase fertiggestellt.</h3>
    </div>
</section>