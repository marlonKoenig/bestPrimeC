<?php
$response = file_get_contents('../../js/customerData.json');
$jsonArray = json_decode($response, true);
$user_salutation = $jsonArray['user_salutation'];
$user_birthDate = explode('-', $jsonArray['user_birthDate']);
// $birthYear = $user_birthDate[0];
// $birthMonth = $user_birthDate[1];
// $birthDay = $user_birthDate[2];
switch ($user_salutation) {
    case 0:
        $genderSelector = '<option value="0" selected>Herr</option>' .
            '<option value="1">Frau</option>';
        break;
    case 1:
        $genderSelector = '<option value="0">Herr</option>' .
            '<option value="1" selected>Frau</option>';
        break;
}
?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="inputContainerTable">
            <p>Persönliche Daten ändern:</p>
            <div class="inputTableRow">
                <div class="leftRow">
                    <span class="label">Anrede:*</span>
                    <select tabindex="1" id="inputSalutation" name="inputSalutation" data-display-name="Anrede"
                        title="Bitte auswählen">
                        <option value="" hidden disabled>bitte wählen</option>
                        <?php echo $genderSelector; ?>
                    </select>
                </div>
                <div class="rightRow">
                    <span class="label">Firma:</span>
                    <input tabindex="13" type="text" name="company" id="company" placeholder="Firma" size="40"
                        value="<?php echo $jsonArray['customer_title']; ?>">
                </div>
            </div>
            <div class="inputTableRow">
                <div class="leftRow">
                    <span class="label">Vorname:*</span>
                    <input tabindex="2" type="text" name="firstName" id="firstName" placeholder="Vorname" size="40"
                        value="<?php echo $jsonArray['user_firstName']; ?>">
                </div>
                <div class="rightRow">
                    <span class="label">USt.-ID:</span>
                    <input tabindex="14" type="text" name="taxId" id="taxId" placeholder="USt.-ID:" size="40"
                        value="<?php echo $jsonArray['customer_title']; ?>">
                </div>
            </div>
            <div class="inputTableRow">
                <div class="leftRow">
                    <span class="label">Nachname:*</span>
                    <input tabindex="3" type="text" name="surName" id="surName" placeholder="Nachname" size="40"
                        value="<?php echo $jsonArray['user_surName']; ?>">
                </div>
                <div class="rightRow">
                    <span class="label">Webseite:</span>
                    <input tabindex="15" type="url" name="url" id="url" placeholder="Webseite" size="40"
                        value="<?php echo $jsonArray['customer_title']; ?>">
                </div>
            </div>
            <div class="inputTableRow">
                <div class="leftRow">
                    <span class="label">Geburtsdatum:*</span>
                    <div id="birthdayField">
                        <input tabindex="4" type="text" name="birthDay" id="birthDay" placeholder="TT" size="3"
                            value="<?php echo $user_birthDate[2]; ?>">
                        <input tabindex="5" type="text" name="birthMonth" id="birthMonth" placeholder="MM" size="3"
                            value="<?php echo $user_birthDate[1]; ?>">
                        <input tabindex="6" type="text" name="birthYear" id="birthYear" placeholder="JJJJ" size="3"
                            value="<?php echo $user_birthDate[0]; ?>">
                    </div>
                </div>
                <div class="rightRow">
                    <span class="label">Telefon:</span>
                    <input tabindex="16" type="tel" name="phone" id="phone" placeholder="Telefonnummer" size="40"
                        value="<?php echo $jsonArray['customer_phone']; ?>">
                </div>
            </div>
            <div class="inputTableRow">
                <div class="leftRow">
                    <span class="label">Straße:*</span>
                    <div id="streetField">
                        <input tabindex="7" type="text" name="street" id="street" placeholder="Straße" size="30"
                            value="<?php echo $jsonArray['user_street']; ?>">
                        <input tabindex="8" type="text" name="streetNumber" id="streetNumber" placeholder="Hs.-Nr."
                            size="3" value="<?php echo $jsonArray['user_houseNumber']; ?>">
                    </div>
                </div>
                <div class="rightRow">
                    <span class="label">Mobil:*</span>
                    <input tabindex="17" type="tel" name="mobile" id="mobile" placeholder="Mobil-Nummer" size="40"
                        value="<?php echo $jsonArray['user_mobile']; ?>">
                </div>
            </div>
            <div class="inputTableRow">
                <div class="leftRow">
                    <span class="label">Zusatz:</span>
                    <input tabindex="9" type="text" name="addressAppendix" id="addressAppendix" placeholder="Zusatz"
                        size="40" value="<?php echo $jsonArray['user_additionalAdress']; ?>">
                </div>
                <div class="rightRow">
                    <span class="label">FAX:</span>
                    <input tabindex="18" type="tel" name="fax" id="fax" placeholder="FAX-Nummer" size="40"
                        value="<?php echo $jsonArray['customer_fax']; ?>">
                </div>
            </div>
            <div class="inputTableRow">
                <div class="leftRow">
                    <span class="label">PLZ:*</span>
                    <input tabindex="10" type="number" name="zip" id="zip" placeholder="PLZ" size="5"
                        value="<?php echo $jsonArray['user_zip']; ?>">
                </div>
                <div class="rightRow">
                    <span class="label">E-Mail:*</span>
                    <input tabindex="19" type="text" name="email" id="email" placeholder="E-Mail" size="40"
                        value="<?php echo $jsonArray['user_email']; ?>">
                </div>
            </div>
            <div class="inputTableRow">
                <div class="leftRow">
                    <span class="label">Ort:*</span>
                    <input tabindex="11" type="text" name="city" id="city" placeholder="Ort" size="40"
                        value="<?php echo $jsonArray['user_residence']; ?>">
                </div>
                <div class="rightRow">
                    <span class="label">Ausweisnummer:</span>
                    <input tabindex="12" type="text" name="idNumber" id="idNumber" placeholder="Ausweisnummer" size="40"
                        value="<?php echo $jsonArray['customer_title']; ?>">
                </div>
            </div>
            <p>Passwort ändern:</p>
            <div class="inputTableRow">
                <div class="leftRow">
                    <span class="label">Bisheriges Passwort:*</span>
                    <input tabindex="20" type="text" name="oldPassword" id="oldPassword"
                        placeholder="bisheriges Passwort" size="40">
                </div>
                <div class="rightRow">&nbsp;
                </div>
            </div>
            <div class="inputTableRow">
                <div class="leftRow">
                    <span class="label">Passwort:</span>
                    <input tabindex="21" type="text" name="password" id="password" placeholder="neues Passwort"
                        size="40">
                </div>
                <div class="rightRow">
                    <span class="label">Passwort wiederholen:*</span>
                    <input tabindex="22" type="text" name="passwordRepeat" id="passwordRepeat"
                        placeholder="neues Passwort wiederholen" size="40">
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="inputTableRow marginTopMedium">
                <div class="leftRow" style="width:100%;">
                    <input tabindex="25" type="checkbox" id="newsletterSubscribed" name="newsletterSubscribed"
                        style="appearance:auto;">
                    <label for="gtcAccepted" style="font-size:0.8em;">Ich möchte Produktinformationen und
                        Neuigkeiten per E-Mail erhalten.</label>
                </div>
            </div>
        </div>
    </div>
</section>