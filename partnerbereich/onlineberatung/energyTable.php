<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('geladen');
    })
    console.log('geladen');
    document.querySelector('#PLZ').innerHTML = '';
</script>

<div id="powerContainer">
    <div id="offerContainer">
        <h2>Neues Angebot</h2>
        <div>Passenden Tarif berechnen und Angebot erstellen</div>
        <div class="tableHead">Kundenart:</div>
        <div class="buttonTable">
            <div>
                <div id="privateHome" class="auswahlbutton group01" onclick="groupSelector(this, 'group01')">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="1" stroke="currentColor" fill="none">
                        <path d="M51.61,25.21,33.2,11.4a2,2,0,0,0-2.4,0L12.39,25.21a2,2,0,0,0-.8,1.6V53.45a2,2,0,0,0,2,2H25a2,2,0,0,0,2-2V45a2,2,0,0,1,2-2h7a2,2,0,0,1,2,2v8.45a2,2,0,0,0,2,2H50.41a2,2,0,0,0,2-2V26.81A2,2,0,0,0,51.61,25.21Z" />
                    </svg>
                    <div class="auswahlbuttonText">Privat (inkl. MwSt)</div>
                </div>
            </div>
            <div>
                <div id="factoryHome" class="auswahlbutton group01" onclick="groupSelector(this, 'group01')">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="1" stroke="currentColor" fill="none">
                        <path d="M34.82,52.73H14.69V22.18a1,1,0,0,1,.52-.87L33.34,11.4a1,1,0,0,1,1.48.88Z" stroke-linecap="round" />
                        <path d="M48.87,52.73H34.92V21.59L48.4,29.3a1,1,0,0,1,.47.85Z" stroke-linecap="round" />
                        <line x1="28.1" y1="24.86" x2="21.06" y2="24.86" stroke-linecap="round" />
                        <line x1="43.66" y1="32.41" x2="40.14" y2="32.41" stroke-linecap="round" />
                        <line x1="43.66" y1="36.9" x2="40.14" y2="36.9" stroke-linecap="round" />
                        <line x1="43.66" y1="41.71" x2="40.14" y2="41.71" stroke-linecap="round" />
                        <line x1="43.66" y1="46.19" x2="40.14" y2="46.19" stroke-linecap="round" />
                        <line x1="28.1" y1="30.44" x2="21.06" y2="30.44" stroke-linecap="round" />
                        <line x1="28.1" y1="35.94" x2="21.06" y2="35.94" stroke-linecap="round" />
                        <line x1="28.1" y1="41.44" x2="21.06" y2="41.44" stroke-linecap="round" />
                        <line x1="28.1" y1="46.94" x2="21.06" y2="46.94" stroke-linecap="round" />
                        <line x1="9.46" y1="52.73" x2="54.54" y2="52.73" stroke-linecap="round" />
                    </svg>
                    <div class="auswahlbuttonText">Gewerbe (exkl. MwSt)</div>
                </div>
            </div>
        </div>
        <div class="tableHead">Energie wählen:</div>
        <div class="buttonTable">
            <div>
                <div id="strom" class="auswahlbutton group02" onclick="groupSelector(this, 'group02')">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="1" stroke="currentColor" fill="none">
                        <line x1="50.4" y1="24.38" x2="58.3" y2="23.14" />
                        <line x1="47.93" y1="17.11" x2="52.87" y2="14.2" />
                        <line x1="42.89" y1="11.73" x2="46.21" y2="4.51" />
                        <line x1="33.45" y1="10.69" x2="33.41" y2="4.96" />
                        <line x1="24.29" y1="12.09" x2="21.62" y2="4.51" />
                        <line x1="17.99" y1="17.03" x2="12.96" y2="14.29" />
                        <line x1="15.78" y1="23.97" x2="8.03" y2="22.66" />
                        <path d="M26.22,45.47c0-5.16-3.19-9.49-4.91-12.69A12.24,12.24,0,0,1,19.85,27c0-6.79,6.21-12.3,13-12.3" />
                        <path d="M39.48,45.47c0-5.16,3.19-9.49,4.91-12.69A12.24,12.24,0,0,0,45.85,27c0-6.79-6.21-12.3-13-12.3" />
                        <rect x="23.63" y="45.19" width="18.93" height="4.25" rx="2.12" />
                        <rect x="24.79" y="49.43" width="16.61" height="4.25" rx="2.12" />
                        <path d="M36.32,53.68v.84a3.23,3.23,0,1,1-6.44,0v-.84" />
                        <path d="M24.57,26.25a7.5,7.5,0,0,1,7.88-7.11" />
                    </svg>
                    <div class="auswahlbuttonText">Strom</div>
                </div>
            </div>
            <div>
                <div id="gas" class="auswahlbutton group02" onclick="groupSelector(this, 'group02')">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="1" stroke="currentColor" fill="none">
                        <path d="M37.34,7.36a.12.12,0,0,1,.18.13c-.47,1.86-2.78,12.63,5.57,19.62,8.16,6.84,8.41,17.13,2.33,24-7.27,8.23-19.84,6.78-25.25,1.37C16.36,48.69,9.44,36.33,21.29,26a.1.1,0,0,1,.16,0c.29,1.23,2.3,9,7.66,10,.25,0,.37-.11.25-.34C27.78,32.6,20.66,17,37.34,7.36Z" stroke-linecap="round" />
                    </svg>
                    <div class="auswahlbuttonText">Gas</div>
                </div>
            </div>
        </div>
        <div id="stromInput" class="inputContainer">
            <div id="energietyp">
                <div class="inputTable">
                    <div class="tableHead">Energietyp:</div>
                    <select id="energyType" class="selectListe" name="energyType" onchange="listSelector(this);">
                        <option value="keineAngabe">keine Angabe</option>
                        <option value="Haushaltsstrom">Haushaltsstrom</option>
                        <option value="Heizstrom">Heizstrom</option>
                    </select>
                </div>
            </div>
            <div id="PLZ">
                <div class="inputTable">
                    <div class="tableHead">Postleitzahl:</div>
                    <input type="number" id="plz" name="plz">
                </div>
            </div>
        </div>
        <div id="jahresverbrauch" class="inputContainer">
            <div id="KWH" class="inputTable">
                <div class="tableHead">Jahresverbrauch (kWh):</div>
                <input type="text" id="kwh" name="kwh">
            </div>
            <div id="personenzahl" class="inputTable">
                <div class="tableHead">Personen im Haushalt:</div>
                <div id="personenContainer">
                    <div id="one" class="persons" onclick="checkPersons('1')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="1" stroke="currentColor" fill="none">
                            <circle cx="32" cy="18.14" r="11.14" />
                            <path d="M54.55,56.85A22.55,22.55,0,0,0,32,34.3h0A22.55,22.55,0,0,0,9.45,56.85Z" />
                        </svg>
                        <div>1</div>
                    </div>
                    <div id="two" class="persons" onclick="checkPersons('2')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="1" stroke="currentColor" fill="none">
                            <circle cx="32" cy="18.14" r="11.14" />
                            <path d="M54.55,56.85A22.55,22.55,0,0,0,32,34.3h0A22.55,22.55,0,0,0,9.45,56.85Z" />
                        </svg>
                        <div>2</div>
                    </div>
                    <div id="three" class="persons" onclick="checkPersons('3')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="1" stroke="currentColor" fill="none">
                            <circle cx="32" cy="18.14" r="11.14" />
                            <path d="M54.55,56.85A22.55,22.55,0,0,0,32,34.3h0A22.55,22.55,0,0,0,9.45,56.85Z" />
                        </svg>
                        <div>3</div>
                    </div>
                    <div id="four" class="persons" onclick="checkPersons('4')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="1" stroke="currentColor" fill="none">
                            <circle cx="32" cy="18.14" r="11.14" />
                            <path d="M54.55,56.85A22.55,22.55,0,0,0,32,34.3h0A22.55,22.55,0,0,0,9.45,56.85Z" />
                        </svg>
                        <div>4</div>
                    </div>
                    <div id="five" class="persons" onclick="checkPersons('5')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke-width="1" stroke="currentColor" fill="none">
                            <circle cx="32" cy="18.14" r="11.14" />
                            <path d="M54.55,56.85A22.55,22.55,0,0,0,32,34.3h0A22.55,22.55,0,0,0,9.45,56.85Z" />
                        </svg>
                        <div>5</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="lastRow">
            <div id="yearly" class="">
                <div class="tableHead">Kosten pro Jahr (bisher):</div>
                <input type="text" id="yearlyCost" name="yearlyCost">
            </div>
            <div id="fireButton" class="btn btn-blue" onclick="sendEnergyQuery()">
                Berechnen
            </div>
        </div>

    </div>
    <div id="compareContainer">
        <div id="firstCompareLine">
            <h2>Dein Stromvergleich</h2>
            <div id="compareResults">
                <div>
                    <span id="compareHits">0</span>
                    <span id="compareText"> Tarife gefunden</span>
                </div>
                <div>
                    <!-- <span>Die Ergebnisse werden für das Gebiet: </span><span id="comparePLZ">00000</span><span> angezeigt.</span> -->
                </div>
            </div>
        </div>
        <div id="compareContent">
            <h3>Bitte lade Deine letzte Stromrechnung hoch</h3>
            <p><small>Diese Rechnungen hat Dein Kunde bereits hochgeladen.</small></p>
            <div id="refreshButton" onclick="refreshBillingList();">Liste aktualiseren</div>
            <div id="billingContainer">
                <div id="billLoadRow">
                    <!--  <form id="uploadform" method="post" enctype="multipart/form-data">
                        <input id="files" type="file" name="files[]" multiple>
                        <input id="billLoadButton" type="submit" value="Dateien hochladen" name="submit">
                    </form> -->
                    <div id="result"></div>
                </div>
                <div id="billOutputContainer">
                </div>
            </div>
        </div>
    </div>
</div>