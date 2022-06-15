<?php
$root = '../../../../media/webseite/icons/';
$new = json_decode($response);
//echo $new->user_id;
?>
<div id="startOrderContainer">
    <div id="firstLine">
        <image src="<?php echo $root . 'info.png' ?>">Neues Angebot für die Belieferung mit Strom erstellen für Kunde: <?php echo $new->user_firstName . ' ' . $new->user_surName; ?>
    </div>
    <div id="buttonLine">
        <div id="signature" class="button"><input type="checkbox"> Digitale Unterschrift</div>
        <div id="checkOffer" class="button"><input type="checkbox" checked> Angebot überprüfen???</div>
        <div id="saveOffer" class="button">
            <image src="<?php echo $root . 'save.png' ?>">Speichern
        </div>
        <div id="exitOffer" class="button"><b>X</b>&nbsp:Zurück zum Tarifrechner</div>
    </div>
    <div class="dataContainer">
        <div id="nameContainer">
            <div class="topLine">
                Anschlussinhaber
            </div>
            <form>
                <div id="salutationLine">
                    <div id="salutation">
                        <span class="label">Anrede:</span>
                        <select tabindex="1" id="inputSalutation" name="inputSalutation" title="Bitte auswählen">
                            <option>bitte wählen</option>
                            <option>Herr</option>
                            <option>Frau</option>
                        </select>
                    </div>
                    <div id="titel">
                        <span class="label">Titel:</span>
                        <input tabindex="2" type="text" name="customer_title" id="customer_title" size="10" value="<?php echo $new->customer_title; ?>">
                    </div>
                    <div id="nameLine">
                        <div id="firstname">
                            <span class="label">Vorname:</span>
                            <input tabindex="3" type="text" name="user_firstName" id="user_firstName" size="10" value="<?php echo $new->user_firstName; ?>">
                        </div>
                        <div id="surname">
                            <span class="label">Nachname:</span>
                            <input tabindex="4" type="text" name="user_surName" id="user_surName" size="10" value="<?php echo $new->user_surName; ?>">
                        </div>
                        <div id="birthDate">
                            <span class="label">Geburtsdatum:</span>
                            <input tabindex="5" type="text" name="user_birthDate" id="user_birthDate" size="10" value="<?php echo $new->user_birthDate; ?>">
                        </div>
                    </div>
                    <div id="phoneLine">
                        <div id="mobile">
                            <span class="label">Mobiltelefon:</span>
                            <input tabindex="6" type="text" name="user_mobile" id="user_mobile" size="14" value="<?php echo $new->user_mobile; ?>">
                        </div>
                        <div id="phone">
                            <span class="label">Telefon:</span>
                            <input tabindex="7" type="text" name="customer_phone" id="customer_phone" size="14" value="<?php echo $new->customer_phone; ?>">
                        </div>
                    </div>
                </div>
            </form>
            <div class="bottomLine">
                <label>
                    Abweichender Rechnungsempfänger
                    <input type="checkbox">
                    <span></span>
                </label>
            </div>
        </div>
    </div>
</div>