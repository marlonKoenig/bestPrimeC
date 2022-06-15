<?php
$ownCommission = number_format($_SESSION['user_ownCommission'], 2, ',', '');
$childCommission = number_format($_SESSION['user_childCommission'], 2, ',', '');
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <h2>Berechne hier Deinen Verdienst einfach selbst</h2>
        <div id="berechnungsContainer">
            <div id="inputContainer">
                <div id="berechnungsContainerInputSelbst" class="inputBerechnungsContainer">
                    Wie viele Einheiten produzierst Du im Monat?
                    <div class="inputArea">
                        <span id="berechnungsContainerInputSelbstValue" class="wert">0</span>
                        <span id="berechnungsContainerInputSelbstValuePlus" class="plus" onclick="incValue(this)"><img src="<?php echo $image_path . 'icons/plus.png' ?>" alt="plus" class="circle"></span>
                        <span id="berechnungsContainerInputSelbstValueMinus" class="minus" onclick="decValue(this)"><img src="<?php echo $image_path . 'icons/minus.png' ?>" alt="minus" class="circle"></span>
                    </div>
                </div>
                <div id="berechnungsContainerInputFilialZahl" class="inputBerechnungsContainer">
                Wie viele Filialen hast Du gesamt?
                    <div class="inputArea">
                        <span id="berechnungsContainerInputFilialZahlValue" class="wert">0</span>
                        <span id="berechnungsContainerInputFilialZahlValuePlus" class="plus" onclick="incValue(this)"><img src="<?php echo $image_path . 'icons/plus.png' ?>" alt="plus" class="circle"></span>
                        <span id="berechnungsContainerInputFilialZahlValueMinus" class="minus" onclick="decValue(this)"><img src="<?php echo $image_path . 'icons/minus.png' ?>" alt="minus" class="circle"></span>
                    </div>
                </div>
                <div id="berechnungsContainerInputFilialEinheiten" class="inputBerechnungsContainer">
                Wie viele Einheiten produzieren deine Filialen im Monat?
                    <div class="inputArea">
                        <span id="berechnungsContainerInputFilialEinheitenValue" class="wert">0</span>
                        <span id="berechnungsContainerInputFilialEinheitenValuePlus" class="plus" onclick="incValue(this)"><img src="<?php echo $image_path . 'icons/plus.png' ?>" alt="plus" class="circle"></span>
                        <span id="berechnungsContainerInputFilialEinheitenValueMinus" class="minus" onclick="decValue(this)"><img src="<?php echo $image_path . 'icons/minus.png' ?>" alt="minus" class="circle"></span>
                    </div>
                </div>
            </div>
            <div id="outputContainer">
                <img id="outputImage" src="<?php echo $image_path . 'icons/one-man-show.png' ?>">
                <div id="outputContainerErgebnis">
                    <div>Dein Verdienst monatlich:</div>
                    <div id="outputContainerErgebnisBereich">
                        <span>€&nbsp;</span>
                        <span id="berechnungsContainerValue">0</span>
                    </div>
                </div>
            </div>
        </div>
        <div id="fussnote">*Grundlage für die Berechnung: Selbst ∅&nbsp;50&nbsp;€ pro Einheit und Differenz ∅&nbsp;20&nbsp;€
</div>
    </div>
</section>