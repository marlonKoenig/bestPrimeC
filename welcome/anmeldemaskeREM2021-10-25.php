<div id="inputContainerTable">
    <div class="inputTableRow">
        <div class="leftRow">
            <span class="label">Anrede:*</span>
            <select tabindex="1" id="inputSalutation" name="inputSalutation" data-display-name="Anrede" title="Bitte auswählen">
                <option value="" hidden disabled selected>bitte wählen</option>
                <option value="0">Herr</option>
                <option value="1">Frau</option>
            </select>
        </div>
        <div class="rightRow">
            <span class="label">Geburtsdatum:*</span>
            <div id="birthdayField">
                <input tabindex="2" type="text" name="birthDay" id="birthDay" title="Bitte Tag eingeben" placeholder="TT" size="3">
                <input tabindex="3" type="text" name="birthMonth" id="birthMonth" title="Bitte Monat eingeben" placeholder="MM" size="3">
                <input tabindex="4" type="text" name="birthYear" id="birthYear" title="Bitte Jahr vierstellig eingeben" placeholder="JJJJ" size="3">
            </div>
        </div>
    </div>
    <div class="inputTableRow">
        <div class="leftRow">
            <span class="label">Vorname:*</span>
            <input tabindex="5" type="text" name="firstName" id="firstName" placeholder="Vorname" size="40">
        </div>
        <div class="rightRow">
            <span class="label">Straße:</span>
            <div id="streetField">
                <input tabindex="7" type="text" name="street" id="street" placeholder="Straße" size="30">
                <input tabindex="8" type="text" name="streetNumber" id="streetNumber" placeholder="Hs.-Nr." size="3">
            </div>
        </div>
    </div>
    <div class="inputTableRow">
        <div class="leftRow">
            <span class="label">Nachname:*</span>
            <input tabindex="6" type="text" name="surName" id="surName" placeholder="Nachname" size="40">
        </div>
        <div class="rightRow">
            <span class="label">Zusatz:</span>
            <input tabindex="9" type="text" name="addressAppendix" id="addressAppendix" placeholder="Zusatz" size="40">
        </div>
    </div>
    <div class="inputTableRow">
        <div class="leftRow">
            <span class="label">Ausweisnummer:</span>
            <input tabindex="13" type="text" name="idNumber" id="idNumber" placeholder="Ausweisnummer" size="40">
        </div>
        <div class="rightRow">
            <span class="label">PLZ:</span>
            <input tabindex="11" type="number" name="zip" id="zip" placeholder="PLZ" size="5">
        </div>
    </div>
    <div class="inputTableRow">
        <div class="leftRow">
            <span class="label">Firma:</span>
            <input tabindex="14" type="text" name="company" id="company" placeholder="Firma" size="40">
        </div>
        <div class="rightRow">
            <span class="label">Ort:</span>
            <input tabindex="12" type="text" name="city" id="city" placeholder="Ort" size="40">
        </div>
    </div>
    <div class="inputTableRow">
        <div class="leftRow">
            <span class="label">USt.-ID:</span>
            <input tabindex="15" type="text" name="taxId" id="taxId" placeholder="USt.-ID:" size="40">
        </div>
        <div class="rightRow">

        </div>
    </div>
    <div class="inputTableRow">
        <div class="leftRow">
            <span class="label">Telefon:</span>
            <input tabindex="16" type="tel" name="phone" id="phone" placeholder="Telefonnummer" size="40">
        </div>
        <div class="rightRow">
            <span class="label">E-Mail:*</span>
            <input tabindex="19" tabindex="1" type="text" name="email" id="email" placeholder="E-Mail" size="40">
        </div>
    </div>
    <div class="inputTableRow">
        <div class="leftRow">
            <span class="label">FAX:</span>
            <input tabindex="17" type="tel" name="fax" id="fax" placeholder="FAX-Nummer" size="40">
        </div>
        <div class="rightRow">
            <span class="label">E-Mail wiederholen:*</span>
            <input tabindex="20" type="text" name="emailRepeat" id="emailRepeat" placeholder="E-Mail wiederholen" size="40">
        </div>
    </div>
    <div class="inputTableRow">
        <div class="leftRow">
            <span class="label">Mobil:*</span>
            <input tabindex="18" type="tel" name="mobile" id="mobile" placeholder="Mobil-Nummer" size="40">
        </div>
        <div class="rightRow">
            <span class="label">Webseite:</span>
            <input tabindex="21" type="url" name="url" id="url" placeholder="Webseite" size="40">
        </div>
    </div>
    <div class="inputTableRow">
        <div class="leftRow">
            <span class="label">Passwort:*</span>
            <input tabindex="22" type="text" name="password" id="password" placeholder="Passwort" size="40">
        </div>
        <div class="rightRow">
            <span class="label">Passwort wiederholen:*</span>
            <input tabindex="23" type="text" name="passwordRepeat" id="passwordRepeat" placeholder="Passwort wiederholen" size="40">
        </div>
    </div>
    <div class="inputTableRow marginTopMedium">
        <div class="leftRow" style="width:100%;">
            <input type="checkbox" id="gtcAccepted" name="gtcAccepted" style="appearance:auto;">
            <label for="gtcAccepted" style="font-size:0.8em;">Ich akzeptiere die <a target="_blank" style="color:blue;text-decoration:underline;" href="<?php echo $GLOBALS['domain'] . "\media\webseite\documents\AGB.pdf"; ?>">AGB*</a></label>
        </div>
    </div>
    <div class="inputTableRow marginTopMedium">
        <div class="leftRow" style="width:100%;">
            <input type="checkbox" id="privacyPolicyAccepted" name="privacyPolicyAccepted" style="appearance:auto;">
            <label for="gtcAccepted" style="font-size:0.8em;">Ich akzeptiere die <a target="_blank" style="color:blue;text-decoration:underline;" href=" <?php echo $GLOBALS['domain'] . "\media\webseite\documents\Datenschutzerklärung.pdf"; ?>">Datenschutzbestimmungen*</a></label>
        </div>
    </div>
    <div class="inputTableRow marginTopMedium">
        <div class="leftRow" style="width:100%;">
            <input type="checkbox" id="newsletterSubscribed" name="newsletterSubscribed" style="appearance:auto;">
            <label for="gtcAccepted" style="font-size:0.8em;">Ich möchte Produktinformationen und Neuigkeiten per E-Mail erhalten.</label>
        </div>
    </div>
</div>
<div id="inputContainerFooter">
    <div tabindex="24" id="sendButton" class="btn btn-green" data-step="5" onclick="loadWelcome(this);">Weiter zur Kasse</div>
</div>