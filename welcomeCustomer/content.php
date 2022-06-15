<div class="ui form" id="customerRegistrationForm" style="min-height: 75vh;">
    <!-- <div class="ui teal progress" id="calculationProgress" data-total="10">
        <div class="bar">
            <div class="progress"></div>
        </div>
    </div> -->
    <div class="ui teal progress" id="registrationProgress" data-total="11">
        <div class="bar">
            <div class="progress"></div>
        </div>
    </div>
    <input type="text" placeholder="Sponsor-ID" id="sponsorId" name="sponsorId" value="<?php echo $_GET["refUserId"]; ?>" disabled hidden>



    <div>
        <div class="ui message textAlignCenter">Berechne kostenlos was du bei deinen Fixkosten jährlich sparen könntest.</div><br><br>
        <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);">Weiter</div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter marginBottomSmall">Was zahlst Du monatlich für deinen Strom?</div><br><br>

        <div class="ui fluid labeled input">
            <div class="ui label">
                €
            </div>
            <input type="number" id="energyMonthlyCost" name="energyMonthlyCost" placeholder="Monatliche Kosten">
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this.parentElement);">Weiter</div>
        </div>
        <div class="ui fluid button btn-theme-reverse" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);">Überspringen</div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Was zahlst Du monatlich für Gas?</div><br><br>
        <div class="ui fluid labeled input">
            <div class="ui label">
                €
            </div>
            <input type="number" id="gasMonthlyCost" name="gasMonthlyCost" placeholder="Monatliche Kosten">
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this.parentElement);">Weiter</div>
        </div>
        <div class="ui fluid button btn-theme-reverse" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);">Überspringen</div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Was zahlst Du monatlich für DSL/Internet?</div><br><br>
        <div class="ui fluid labeled input">
            <div class="ui label">
                €
            </div>
            <input type="number" id="dslMonthlyCost" name="dslMonthlyCost" placeholder="Monatliche Kosten">
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this.parentElement);">Weiter</div>
        </div>
        <div class="ui fluid button btn-theme-reverse" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);">Überspringen</div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Was zahlst Du monatlich für TV Streaming?</div><br><br>
        <div class="ui fluid labeled input">
            <div class="ui label">
                €
            </div>
            <input type="number" id="tvMonthlyCost" name="tvMonthlyCost" placeholder="Monatliche Kosten">
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this.parentElement);">Weiter</div>
        </div>
        <div class="ui fluid button btn-theme-reverse" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);">Überspringen</div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Was zahlst Du monatlich für Mobilfunk?</div><br><br>
        <div class="ui fluid labeled input">
            <div class="ui label">
                €
            </div>
            <input type="number" id="mobileComMonthlyCost" name="mobileComMonthlyCost" placeholder="Monatliche Kosten">
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this.parentElement);">Weiter</div>
        </div>
        <div class="ui fluid button btn-theme-reverse" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);">Überspringen</div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Was zahlst Du monatlich für deine Versicherungen?</div><br><br>
        <div class="ui fluid labeled input">
            <div class="ui label">
                €
            </div>
            <input type="number" id="insuranceMonthlyCost" name="energyMonthlyCost" placeholder="Monatliche Kosten">
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this.parentElement);">Weiter</div>
        </div>
        <div class="ui fluid button btn-theme-reverse" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);">Überspringen</div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Was zahlst Du monatlich für deine laufenden Kosten?</div><br><br>
        <div class="ui fluid labeled input">
            <div class="ui label">
                €
            </div>
            <input type="number" id="runningMonthlyCost" name="runningMonthlyCost" placeholder="Monatliche Kosten">
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this.parentElement);">Weiter</div>
        </div>
        <div class="ui fluid button btn-theme-reverse" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);">Überspringen</div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Was zahlst Du monatlich für Lebensmittel?</div><br><br>
        <div class="ui fluid labeled input">
            <div class="ui label">
                €
            </div>
            <input type="number" id="foodMonthlyCost" name="foodMonthlyCost" placeholder="Monatliche Kosten">
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this.parentElement);">Weiter</div>
        </div>
        <div class="ui fluid button btn-theme-reverse" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);">Überspringen</div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Was zahlst Du jährlich für deine Reisebuchungen?</div><br><br>
        <div class="ui fluid labeled input">
            <div class="ui label">
                €
            </div>
            <input type="number" id="travelYearlyCost" name="travelYearlyCost" placeholder="Jährliche Kosten">
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this.parentElement);">Weiter</div>
        </div>
        <div class="ui fluid button btn-theme-reverse" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);">Überspringen</div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Was zahlst Du jährlich für Onlineshopping?</div><br><br>
        <div class="ui fluid labeled input">
            <div class="ui label">
                €
            </div>
            <input type="number" id="onlineShoppingYearlyCost" name="onlineShoppingYearlyCost" placeholder="Jährliche Kosten">
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this.parentElement);calculateSavings();">Weiter</div>
        </div>
        <div class="ui fluid button btn-theme-reverse" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);calculateSavings();">Überspringen</div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Das könntest Du geschätzt, ca. pro Jahr einsparen!</div><br><br>
        <div class="textAlignCenter bold">
            <span>Geschätztes Einsparpotential</span>
            <h1 style="color: #00B050;font-size:4em;" id="savingCalculation">1.000 - EUR!</h1>
        </div>
        <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);">Einsparpotential jetzt gratis prüfen</div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Die besten Angebote für die besten Kunden</div><br><br>
        <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('reset');$('#registrationProgress').progress({ total: 10 });showNextFormBox(this);">Jetzt starten</div>
    </div>



    <div class="displayNone">
        <div class="ui message textAlignCenter">Hallo schön Dich kennenzulernen. Du wirst jetzt durch die Eröffnung Deines Accounts geführt.</div><br><br>
        <div class="ui fluid button btn-theme marginVerticalSmall" onclick="$('#registrationProgress').progress('increment');showNextFormBox(this);">Weiter</div>
    </div>

    <div class="displayNone">
        <div class="ui message textAlignCenter">Wie lautet dein Vor- und Nachname</div><br><br>
        <!-- <div class="field">
            <label></label>
            <input type="text" id="nameAddition" name="nameAddition" placeholder="Namenszusatz (Optional)">
        </div> -->
        <div class="field">
            <label></label>
            <input type="text" id="firstName" name="firstName" placeholder="Vorname*" required data-display-name="Vorname">
        </div>
        <div class="field">
            <label></label>
            <input type="text" id="lastName" name="lastName" placeholder="Nachname*" required data-display-name="Nachname">
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="validateFormData(this.parentElement, ['firstName', 'lastName'])">Weiter</div>
        </div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Wann wurdest du geboren?</div><br><br>
        <div class="three fields">
            <div class="field">
                <select class="ui fluid dropdown" id="birthDateDay" name="birthDate[day]" data-display-name="Geburtstag">
                    <option value="" disabled hidden selected>Tag*</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
            </div>
            <div class="field">
                <select class="ui fluid search dropdown" id="birthDateMonth" name="birthDate[month]" data-display-name="Geburtsmonat">
                    <option value="" disabled hidden selected>Monat*</option>
                    <option value="01">Januar</option>
                    <option value="02">Februar</option>
                    <option value="03">März</option>
                    <option value="04">April</option>
                    <option value="05">Mai</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Dezember</option>
                </select>
            </div>
            <div class="field">
                <select class="ui fluid search dropdown" id="birthDateYear" name="birthDate[year]" data-display-name="Geburtsjahr">
                    <option value="" disabled hidden selected>Jahr*</option>
                    <option value="1940">1940</option>
                    <option value="1941">1941</option>
                    <option value="1942">1942</option>
                    <option value="1943">1943</option>
                    <option value="1944">1944</option>
                    <option value="1945">1945</option>
                    <option value="1946">1946</option>
                    <option value="1947">1947</option>
                    <option value="1948">1948</option>
                    <option value="1949">1949</option>
                    <option value="1950">1950</option>
                    <option value="1951">1951</option>
                    <option value="1952">1952</option>
                    <option value="1953">1953</option>
                    <option value="1954">1954</option>
                    <option value="1955">1955</option>
                    <option value="1956">1956</option>
                    <option value="1957">1957</option>
                    <option value="1958">1958</option>
                    <option value="1959">1959</option>
                    <option value="1960">1960</option>
                    <option value="1961">1961</option>
                    <option value="1962">1962</option>
                    <option value="1963">1963</option>
                    <option value="1964">1964</option>
                    <option value="1965">1965</option>
                    <option value="1966">1966</option>
                    <option value="1967">1967</option>
                    <option value="1968">1968</option>
                    <option value="1969">1969</option>
                    <option value="1970">1970</option>
                    <option value="1971">1971</option>
                    <option value="1972">1972</option>
                    <option value="1973">1973</option>
                    <option value="1974">1974</option>
                    <option value="1975">1975</option>
                    <option value="1976">1976</option>
                    <option value="1977">1977</option>
                    <option value="1978">1978</option>
                    <option value="1979">1979</option>
                    <option value="1980">1980</option>
                    <option value="1981">1981</option>
                    <option value="1982">1982</option>
                    <option value="1983">1983</option>
                    <option value="1984">1984</option>
                    <option value="1985">1985</option>
                    <option value="1986">1986</option>
                    <option value="1987">1987</option>
                    <option value="1988">1988</option>
                    <option value="1989">1989</option>
                    <option value="1990">1990</option>
                    <option value="1991">1991</option>
                    <option value="1992">1992</option>
                    <option value="1993">1993</option>
                    <option value="1994">1994</option>
                    <option value="1995">1995</option>
                    <option value="1996">1996</option>
                    <option value="1997">1997</option>
                    <option value="1998">1998</option>
                    <option value="1999">1999</option>
                    <option value="2000">2000</option>
                    <option value="2001">2001</option>
                    <option value="2002">2002</option>
                    <option value="2003">2003</option>
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                </select>
            </div>

        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="validateFormData(this.parentElement, ['birthDateDay', 'birthDateMonth', 'birthDateYear'])">Weiter</div>
        </div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Was ist Dein Geschlecht?*</div><br><br>
        <div class="field">
            <div class="ui radio checkbox">
                <input type="radio" id="male" value="0" name="gender">
                <label for="male">Männnlich</label>
            </div>
        </div>
        <div class="field">
            <div class="ui radio checkbox">
                <input type="radio" id="female" value="1" name="gender">
                <label for="female">Weiblich</label>
            </div>
        </div>
        <div class="field">
            <div class="ui radio checkbox">
                <input type="radio" id="diverse" value="2" name="gender">
                <label for="diverse">Divers</label>
            </div>
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="validateFormData(this.parentElement, ['gender'])">Weiter</div>
        </div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Nun benötigen wir noch Deine Adresse</div><br><br>
        <div class="fields">
            <div class="twelve wide field">
                <input type="text" placeholder="Straße*" id="street" name="street" required data-display-name="Straße">
            </div>
            <div class="four wide field">
                <input type="number" placeholder="Nr.*" id="houseNumber" name="houseNumber" required data-display-name="Hausnummer">
            </div>
        </div>
        <div class="field">
            <input type="text" placeholder="Adresszusatz (optional)" id="houseNumberAppendix" name="houseNumberAppendix" required>
        </div>
        <div class="two fields">
            <div class="field">
                <input type="number" placeholder="PLZ*" id="zip" name="zip" required data-display-name="Postleitzahl">
            </div>
            <div class="field">
                <input type="text" placeholder="Ort*" id="city" name="city" required data-display-name="Ort">
            </div>
        </div>
        <div class="field">
            <input type="text" placeholder="Land" id="country" name="country" disabled value="Deutschland" required>
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="validateFormData(this.parentElement, ['street', 'houseNumber', 'zip', 'city', 'country'])">Weiter</div>
        </div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Unter welcher E-Mail-Adresse erreichen wir Dich am Besten?</div><br><br>

        <div class="field">
            <input type="text" id="email" name="email" required data-display-name="E-Mail" placeholder="E-Mail">

        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="validateFormData(this.parentElement, ['email'])">Weiter</div>
        </div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Wähle ein Passwort, welches aus Groß-, sowie aus Kleinbuchstaben und Sonderzeichen besteht.</div><br><br>

        <div class="field">
            <input type="password" id="password" name="password" placeholder="Passwort">
        </div>
        <div class="field">
            <input type="password" id="passwordRepeat" name="passwordRepeat" placeholder="Passwort wiederholen">
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="validateFormData(this.parentElement, ['password'])">Weiter</div>
        </div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Bitte akzeptiere noch die AGB, bevor wir Deinen Account eröffnen.</div><br><br>

        <div class="field">
            <div class="ui checkbox">
                <input type="checkbox" id="agbAccepted" name="agbAccepted" data-display-name="AGB" tabindex="0">
                <label>Ich akzeptiere die <a href='<?php echo $image_path . "/documents/AGB.pdf"; ?>' target="_blank">AGB</a>*</label>
            </div>
        </div>
        <div class="field">
            <div class="ui checkbox">
                <input type="checkbox" id="privacyPolicyAccepted" name="privacyPolicyAccepted" data-display-name="Datenschutzerklärung" tabindex="0">
                <label>Ich habe die <a href='<?php echo $image_path . "/documents/Datenschutzerklärung.pdf"; ?>' target="_blank">Datenschutzerklärung</a> gelesen*</label>
            </div>
        </div>
        <div class="field">
            <div class="ui checkbox">
                <input type="checkbox" tabindex="0" id="newsletterSubscribed" name="newsletterSubscribed">
                <label>Ich möchte Produktinformationen und Neuigkeiten per E-Mail erhalten.</label>
            </div>
        </div>
        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="validateFormData(this.parentElement, ['agbAccepted', 'privacyPolicyAccepted'])">Weiter</div>
        </div>
    </div>
    <div class="displayNone">
        <div class="ui message textAlignCenter">Bitte gib Deine handynummer ein.</div><br><br>

        <div class="ui fluid labeled input marginBottomSmall">
            <div class="ui label">
                +49
            </div>
            <input type="number" id="mobileNumber" name="mobileNumber" data-display-name="Telefonnummer" placeholder="Telefonnummer">
        </div>

        <div class="two ui buttons">
            <div class="ui button btn-theme-reverse marginVerticalSmall" onclick="$('#registrationProgress').progress('decrement');showLastFormBox(this.parentElement);">Zurück</div>
            <div class="ui fluid button btn-theme marginVerticalSmall" onclick="submitCustomerRegistrationForm();">Weiter</div> //validateFormData(this.parentElement, ['mobileNumber'])
        </div>
    </div>
    <!-- <div class="displayNone">
        <div class="ui message textAlignCenter">Wir haben Dir einen Verifizierungscode an 000 gesendet. Solltest du keinen Code erhalten haben, können wir Dir gernen <a href="#">einen neuen Code zusenden</a></div><br><br>

        <div class="field">
            <input type="number" name="mobileNumberCode" placeholder="Code">
        </div>
        <div class="ui fluid button btn-theme marginVerticalSmall" onclick="submitCustomerRegistrationForm();">Weiter</div>
    </div> -->
</div>

<script>
    function calculateSavings() {
        let savings = 0;
        savings += document.getElementById("energyMonthlyCost").value * 12 * 0.2;
        savings += document.getElementById("gasMonthlyCost").value * 12 * 0.2;
        savings += document.getElementById("dslMonthlyCost").value * 12 * 0.1;
        savings += document.getElementById("tvMonthlyCost").value * 12 * 0.05;
        savings += document.getElementById("mobileComMonthlyCost").value * 12 * 0.1;
        savings += document.getElementById("insuranceMonthlyCost").value * 12 * 0.2;
        savings += document.getElementById("runningMonthlyCost").value * 12 * 0.1;
        savings += document.getElementById("foodMonthlyCost").value * 12 * 0.05;
        savings += document.getElementById("travelYearlyCost").value * 0.06;
        savings += document.getElementById("onlineShoppingYearlyCost").value * 0.03;

        document.getElementById("savingCalculation").innerHTML = savings.toString().replace(".", ",") + " €";
    }


    function showNextFormBox(callEl) {
        callEl = callEl.parentNode;
        callEl.style.display = 'none';
        callEl.nextElementSibling.style.display = 'block';
    }

    function showLastFormBox(callEl) {
        callEl = callEl.parentNode;
        callEl.previousElementSibling.style.display = 'block';
        callEl.style.display = 'none';
    }

    async function validateFormData(callEl, elIdsToValidate) {
        let invalidFieldMessages = {};
        let el, elId;

        for (let i = 0; i < elIdsToValidate.length; i++) {
            elId = elIdsToValidate[i];
            switch (elId) {
                // case 'firstName':
                // case 'lastName':
                //     if (!el.value.trim()) {
                //         el.parentElement.classList.add("error")
                //         invalidFieldMessages[elId] = "Bitte überprüfe das Feld " + el.placeholder;
                //     }

                //     break;
                case 'birthDateYear':

                    let birthDay = document.getElementById("birthDateDay").value.toString();
                    let birthMonth = document.getElementById("birthDateMonth").value.toString();
                    let birthYear = document.getElementById("birthDateYear").value.toString();
                    if (!underAgeValidate(birthYear + "-" + birthMonth + "-" + birthDay)) invalidFieldMessages["birthDay"] = "Du bist leider zu jung um diese Plattform zu benutzen.";
                    break;
                case 'gender':
                    let genders = document.querySelectorAll('[name="gender"]:checked');
                    if (!genders.length) invalidFieldMessages["gender"] = "Bitte wähle ein Geschlecht aus";
                    break;

                case 'email':
                    el = document.getElementById(elId);
                    if (!el.value.trim() || !validateEmail(el.value)) {
                        el.parentElement.classList.add("error")
                        invalidFieldMessages[elId] = "Bitte gib eine gültige E-Mail Adresse ein";
                    }
                    let res = await $.get(
                        root + "php/api.php", {
                            "funktion": "checkIfUserExists",
                            "searchValues": [el.value, "e_mail"]
                        },
                        function(res) {
                            return res;
                        }
                    );
                    console.log("emal return");
                    console.log(res);
                    if (JSON.parse(res).userExists == true) invalidFieldMessages["elId"] = "Diese E-Mail Adresse wird bereits verwendet";
                    break;

                case 'agbAccepted':
                case 'privacyPolicyAccepted':
                    el = document.getElementById(elId);
                    if (!el.checked) {
                        invalidFieldMessages[elId] = "Bitte akzeptiere die " +
                            el.dataset.displayName;
                    }
                    break;

                case 'zip':
                    el = document.getElementById(elId);
                    if (!parseInt(el.value) || parseInt(el.value) < 10000 || parseInt(el.value) > 99999) invalidFieldMessages[elId] = "Bitte gib eine gültige Postleizahl ein";
                    break;


                case 'password':
                    console.log("here");
                    let password = document.getElementById(elId);
                    let passwordRepeat = document.getElementById("passwordRepeat");

                    if (password.value != passwordRepeat.value) {
                        password.parentElement.classList.add("error")
                        passwordRepeat.parentElement.classList.add("error")
                        invalidFieldMessages[elId] = "Die beiden Passwörter stimmen nicht überein";
                        break;
                    }
                    if (!checkPassword(password.value)) {
                        password.parentElement.classList.add("error")
                        passwordRepeat.parentElement.classList.add("error")
                        invalidFieldMessages[elId] = "Bitte wähle ein Passwort, welches aus Groß-, sowie aus Kleinbuchstaben und Sonderzeichen besteht.";
                    }

                    break;

                default:
                    console.log("no here");
                    el = document.getElementById(elId);
                    if (!el.value.trim()) {
                        el.parentElement.classList.add("error")
                        invalidFieldMessages[elId] = "Bitte überprüfe das Feld " + el.dataset.displayName;
                    };
                    break;
            }
        }
        console.log("invalidFieldMessages");
        console.log(invalidFieldMessages);
        if (Object.keys(invalidFieldMessages).length !== 0) {
            let errorMessage = "";
            for (const key in invalidFieldMessages) {
                errorMessage += invalidFieldMessages[key] + "<br>";
            }
            Swal.fire({
                title: 'Eingabefehler',
                icon: 'error',
                html: errorMessage,
                showCloseButton: true,
                showCancelButton: false,
                confirmButtonText: 'Verstanden'
            })
            return false;
        }

        $('#registrationProgress').progress('increment');
        showNextFormBox(callEl);
        return true;

    }

    function collectFormData() {
        let fields = document.getElementById("customerRegistrationForm").querySelectorAll("input");
        let formData = {};

        let birthDay = document.getElementById("birthDateDay").value;
        let birthMonth = document.getElementById("birthDateMonth").value;
        let birthYear = document.getElementById("birthDateYear").value;
        formData["birthDate"] = `${birthDay}.${birthMonth}.${birthYear}`;
        fields.forEach(field => {
            switch (field.type) {
                case "radio":
                case 'checkbox':
                    if (field.checked) {
                        formData[field.name] = 1;
                    } else if (field.name != "gender") {
                        formData[field.name] = 0;
                    }
                    break;

                default:

                    formData[field.name] = field.value;
                    break;
            }
        })
        formData["gender"] = document.querySelectorAll('[name="gender"]:checked')[0].value;
        formData["funktion"] = "registerNewCustomer";
        return formData;

    }

    function underAgeValidate(birthday) {
        // it will accept two types of format yyyy-mm-dd and yyyy/mm/dd
        var optimizedBirthday = birthday.replace(/-/g, "/");

        //set date based on birthday at 01:00:00 hours GMT+0100 (CET)
        var myBirthday = new Date(optimizedBirthday);

        // set current day on 01:00:00 hours GMT+0100 (CET)
        var currentDate = new Date().toJSON().slice(0, 10) + ' 01:00:00';

        // calculate age comparing current date and borthday
        var myAge = ~~((Date.now(currentDate) - myBirthday) / (31557600000));

        if (myAge < 18) {
            return false;
        } else {
            return true;
        }

    }

    function submitCustomerRegistrationForm() {

        $.post(
            root + "php/api.php",
            collectFormData(),
            function(response) {
                // Log the response to the console
                let res = JSON.parse(response);
                if (res.userRegistration) {
                    $('#registrationProgress').progress('increment');
                    Swal.fire({
                        title: 'Erfolgreich',
                        text: 'Dein Account wurde erfolgreich angelegt',
                        icon: 'success',
                        confirmButtonText: 'Weiter'
                    }).then(res => {
                        location.replace(loginPage);
                    });
                } else {
                    Swal.fire({
                        title: 'Fehler',
                        text: 'Bei deiner Accountanlage ist ein unerwarteter Fehler aufgetreten. Bitte kontaktiere den Support.',
                        icon: 'error',
                        confirmButtonText: 'Weiter'
                    });
                }
            }
        );
    }

    $('.ui.checkbox')
        .checkbox();
</script>