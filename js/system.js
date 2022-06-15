"use strict";

const root = "https://code2025.de/BestPrimeDev/";
const loginPage = root + "logIn";
const forwardPages = {
  partner: root + "partnerbereich",
  customer: root + "kundenbereich",
  licenseKeyPaymentPage: root + "partnerbereich" + "/lizenz-erwerben",
  partnerFinance: root + "partnerbereich/finanzen/aktuelle-provision",
};
let api = root + "php/api.php";
let sendEnergy = {};
let sendKey = {}; // globales Objekt zur "Spiegelung" des Stromrechners

/** dataLoader
 * is called by onclick and loads the contents of the corresponding data attribute
 * is identified by "this". video container is accessed via class,
 * this allows multiple video modules on one page.
 * Additionally the appropriate image for the start view is selected
 * @param object element = this object -> for dataset
 * @param string target = a number, which specifies which element of video class='videoTarget' should be addressed
 */
function dataLoader(element, target) {
  let data = element.dataset.videoName;
  let videoSrc = document.querySelectorAll(".videoTarget");
  let i = parseInt(target); // übermittelte Variable ist immer ein string
  videoSrc[i].src = root + "media/webseite/videos/" + data;
  let posterArray = data.split(".");
  videoSrc[i].poster = "media/webseite/videos/" + posterArray[0] + ".jpeg";
  let mom = videoSrc[i]; // der entsprechende Container wird zum Objekt
  let child = mom.childNodes;
  console.log("Länge: ", child.length);
}

/** CountDownModule
 * is called in the end section of topSection.php, after checking for BPX = True.
 * will also be called from all subpages used by BPX partner.
 * Creates a module that will be displayed either in the top menu (PC) or below it (smartphone).
 * @param string targetTime = the specification of the target time in seconds (PHP-Unix-TimeStamp).
 * @return no return, because direct output on the page.
 */

function countDownModul(targetTime) {
  // Loop, der den CountDown aufruft
  let loop = setInterval(function () {
    countDown(targetTime);
  }, 1000);

  /** countDown
   * der eigentliche CountDown */
  function countDown(targetTime) {
    let date = new Date().getTime() / 1000; // aktueller Zeitpunkt in s
    date = Math.floor(date);

    // Initialisierung der Konstanten
    const bodies = document.querySelectorAll(".counterContainerBody");

    // Berechnungen
    let gap = targetTime - date;
    const textDay = pad(parseInt(gap / 86400));
    let rest = gap - textDay * 86400;
    const textHour = pad(parseInt(rest / 3600));
    rest = rest - textHour * 3600;
    const textMinute = pad(parseInt(rest / 60));
    const textSecond = pad(rest - textMinute * 60);

    // Ablauf der Funktion einleiten
    if (textDay < 1) {
      // der letzte Tag hat begonnen
      for (let i = 0; i < bodies.length; i++) {
        // bei jedem Vorkommen einfügen
        bodies[i].classList.add("redBG");
      }
    }
    if (gap < 1) {
      clearInterval(loop);
      killCounterModul();
    }
    // Alle Werte aktalisieren (an zwei Positionen, deshalb via Klasse)
    refreshItem(".dayBody", textDay);
    refreshItem(".hourBody", textHour);
    refreshItem(".minuteBody", textMinute);
    refreshItem(".secondsBody", textSecond);
  }
}

/** refreshItem
 * refreshes all items matching the specified selector
 * with the value passed as value
 * @param string selector = the value in CSS notation
 * @param string value = the new value to be used
 * @return = no return
 */
function refreshItem(selector, value) {
  let item = document.querySelectorAll(selector);
  for (let i = 0; i < item.length; i++) {
    // bei jedem Vorkommen einfügen
    item[i].innerText = value;
  }
}

/** killCounterModule
 * After the 30 days have expired, or at a later call of CountDownModul
 * the module should no longer be displayed
 */
function killCounterModul() {
  let counterModul = document.querySelectorAll(".counterModul"); // (an zwei Positionen, deshalb via Klasse)
  for (let i = 0; i < counterModul.length; i++) {
    // bei jedem Vorkommen einfügen
    counterModul[i].remove();
  }
}

/** pad
 * pads the passed number to two digits and returns it
 * @param int number = the number to be checked
 * @return string = the padded number
 */
function pad(number) {
  if (number < 10) {
    let ergebnis = "0" + number.toString();
    return ergebnis;
  }
  return number;
}

/** copyToClipboard
 * is called from the dashboard in the table personal recommendation link
 * copies the data to the clipboard
 * @param {content} data
 */
function copyToClipboard(data) {
  let dataValue = data.getAttribute("data-step");
  // Wert in die Zwischenablage schreiben
  navigator.clipboard.writeText(dataValue).then((res) => {
    alert(
      "Daten wurden in den Zwischenspeicher kopiert. \nSie können den Link jetzt an anderer Stelle einfügen."
    );
  });
}

////////////////////////
///// Tarifrechner /////
///// Strom & Gas //////
////////////////////////

/** groupSelector
 * selects the calling element in the tariff calculator as "active".
 * and frees all other elements in the same group from this class
 * additionally the object "energyType" is filled
 * @param object object = the calling element via this
 * @param string class = the CSS class that defines this group.
 */
function groupSelector(objekt, klasse) {
  let id = objekt.id;
  let energyType = document.querySelector("#energyType");
  let elementList = document.querySelectorAll("." + klasse);
  for (let i = 0; i < elementList.length; i++) {
    // alle Elemente durchlaufen
    elementList[i].classList.remove("activ");
    if (elementList[i].id == id) {
      elementList[i].classList.add("activ");
    }
  }
  switch (
    id // DropDown für Stromart disable und Befüllung des sendEnergy-Arrays
  ) {
    case "privateHome":
      sendEnergy["customerType"] = "privateHome";
      sendKey.customerType = "privateHome";
      transmissionToAdvisor(sendKey);
      break;
    case "factoryHome":
      sendEnergy["customerType"] = "factoryHome";
      sendKey.customerType = "factoryHome";
      transmissionToAdvisor(sendKey);
      break;
    case "strom":
      energyType.disabled = false;
      sendEnergy["energyType"] = "power";
      sendKey.energyType = "power";
      transmissionToAdvisor(sendKey);
      break;
    case "gas":
      energyType.disabled = true;
      sendEnergy["energyType"] = "gas";
      sendKey.energyType = "gas";
      transmissionToAdvisor(sendKey);
      break;
  }
}

/** checkPersons
 * retrieves the value of the selected persons in the tariff calculator electricity and marks the number accordingly colored
 * additionally fills the object "sendEnergy
 * @param string val = the passed value as string
 */
function checkPersons(val) {
  //console.log("checkPersons: "+val);
  let elementList = document.querySelectorAll(".persons");
  for (let i = 0; i < elementList.length; i++) {
    // bei jedem Vorkommen einfügen
    elementList[i].classList.remove("activ");
    if (i < val) {
      elementList[i].classList.add("activ");
    }
  }
  let kwhInput = document.querySelector("#kwh");
  console.log(kwhInput.value + "Val: " + val);
  switch (val) {
    case "1":
      kwhInput.value = 1500;
      sendKey.kwh = 1500;
      sendKey.persons = 1;
      transmissionToAdvisor(sendKey);
      break;
    case "2":
      kwhInput.value = 2500;
      sendKey.kwh = 2500;
      sendKey.persons = 2;
      transmissionToAdvisor(sendKey);
      break;
    case "3":
      kwhInput.value = 3500;
      sendKey.kwh = 3500;
      sendKey.persons = 3;
      transmissionToAdvisor(sendKey);
      break;
    case "4":
      kwhInput.value = 4250;
      sendKey.kwh = 4250;
      sendKey.persons = 4;
      transmissionToAdvisor(sendKey);
      break;
    case "5":
      kwhInput.value = 5000;
      sendKey.kwh = 5000;
      sendKey.persons = 5;
      transmissionToAdvisor(sendKey);
      break;
  }
  sendEnergy["numberOfPersons"] = val;
}

/** sendEnergyQuery
 * is called by the onclick on "send" on the page electricity calculator
 * collects the data from the input mask and sends it via json() to api.php
 * let sendEnergy = {}; was noted at the beginning to make the object globally available
 */
function sendEnergyQuery() {
  let energyOptions = document.querySelector("#energyType").value;
  switch (energyOptions) {
    case "keineAngabe":
      sendEnergy["energyTypeDropdown"] = "strom allgemein";
      break;
    case "Haushaltsstrom":
      sendEnergy["energyTypeDropdown"] = "Haushaltsstrom";
      break;
    case "Heizstrom":
      sendEnergy["energyTypeDropdown"] = "Heizstrom";
      break;
  }
  let plz = document.querySelector("#plz").value;
  if (plz.length == 5) {
    plz = parseInt(plz);
    sendEnergy["plz"] = plz;
    document.querySelector("#comparePLZ").innerHTML = plz;
  } else {
    alert("Bitte eine gültige Postleitzahl eingeben.");
    return false;
  }
  let consumption = document.querySelector("#kwh").value;
  consumption = parseInt(consumption);
  if (isNaN(consumption)) {
    alert(
      "Bitte beim Verbrauch nur ganze Zahlen eingeben oder Personenzahl markieren."
    );
    return false;
  } else {
    sendEnergy["kwh"] = consumption;
  }
  let footer = document.querySelector("#footer");
  let userData = JSON.parse(footer.dataset.array);
  sendEnergy["user_id"] = userData["user_ID"];
  if (userData["customer_dealerID"]) {
    sendEnergy["customer_dealerID"] = userData["customer_dealerID"];
  }
  sendEnergy["role"] = userData["role"];
  let yearlyCost = document.querySelector("#yearlyCost").value;
  yearlyCost = yearlyCost.replace(",", ".");
  yearlyCost = parseFloat(yearlyCost);
  sendEnergy["yearlyCost"] = yearlyCost;
  sendEnergy["funktion"] = "sendEnergy";
  console.log("sendEnergy: " + JSON.stringify(sendEnergy));
  spinner("#powerContainer");
  json("startBlock1", sendEnergy); // compareContainer
}

/** startOrder
 * is called by onclick when ordering a tariff and initiates the ordering process
 * passes this and carries the number of the current tariff in the data-offer
 */
function startOrder(elem) {
  sendEnergy["supplier_offerNumber"] = elem.dataset.offer;
  sendEnergy["supplier_offerType"] = elem.dataset.offerType;
  sendEnergy["funktion"] = "startOrder";
  console.log("Dataset: ");
  console.log(sendEnergy["user_id"]);
  spinner("#startBlock1");
  json("startBlock1", sendEnergy);
  // Mach was draus
}

////////////////////////
//// Businessrechner ///
////////////////////////

/** incValue
 * is called by oncklick and passes this
 * @object this the own object for calculation
 */
function incValue(val) {
  let wertNode = findValueNode(val);
  //console.log('incValue', wertNode.nodeValue);
  let wert = parseInt(wertNode.nodeValue);
  wert++;
  wertNode.nodeValue = wert;
  // console.log('incValueNeu: '+wertNode.parentElement.id);
  //calculateValue(wertNode, wert);
  calculateValue();
}

/** decValue
 * is called by oncklick and passes this
 * @object this the own object for calculation
 */
function decValue(val) {
  let wertNode = findValueNode(val);
  //console.log('incValue', wertNode.nodeValue);
  let wert = parseInt(wertNode.nodeValue);
  if (wert > 0) {
    wert--;
    wertNode.nodeValue = wert;
  }
  calculateValue();
  //console.log('incValueNeu: '+wert);
}

/** findValueNode
 * is called by incValue and decValue, finds the matching value node and returns it
 * @return the value node
 */
function findValueNode(val) {
  let parent = val.parentElement;
  let childList = parent.children;
  // Über die Liste itterieren
  for (let i = 0; i < childList.length; i++) {
    //console.log("incValue: "+childList[i].className);
    // Den Textknoten mit dem Wert ermitteln
    if (childList[i].className == "wert") {
      let wert = parseInt(childList[i].firstChild.nodeValue);
      //console.log( 'findValue Node: '+(wert+3));
      return childList[i].firstChild;
    }
  }
}

/** calculateValue
 * is called from incValue and decValue, calculates the total result and prints it out
 */
function calculateValue() {
  let eigeneEinheiten = document.getElementById(
    "berechnungsContainerInputSelbstValue"
  ).firstChild.nodeValue;
  // console.log('calculateValue', eigeneEinheiten);
  let eigeneFilialen = document.getElementById(
    "berechnungsContainerInputFilialZahlValue"
  ).firstChild.nodeValue;
  if (eigeneFilialen > 0) {
    let outputImage = document.getElementById("outputImage");
    //alert('calculateImage: groß!');
    outputImage.src = root + "media/webseite/icons/filialen.png";
  } else {
    //alert('calculateImage: 0');
    outputImage.src = root + "media/webseite/icons/one-man-show.png";
    document.getElementById(
      "berechnungsContainerInputFilialEinheitenValue"
    ).firstChild.nodeValue = 0;
  }
  // console.log('calculateValue', eigeneFilialen);
  let filialEinheiten = document.getElementById(
    "berechnungsContainerInputFilialEinheitenValue"
  ).firstChild.nodeValue;
  // console.log('calculateValue', filialEinheiten);
  let differenz = eigeneFilialen * filialEinheiten * 20;
  let gesamtVerdienst = eigeneEinheiten * 50 + differenz;
  // console.log('gesamtVerdienst', gesamtVerdienst);
  document.getElementById("berechnungsContainerValue").firstChild.nodeValue =
    gesamtVerdienst;
}

/** loadDetails
 * is called by an onclick on the button in "my-stores" and passes this
 * then loads to the position the content of the file fetched by post
 */
function loadDetails(elem) {
  let dataArray = {};
  let user_id = elem.getAttribute("data-user_id");
  dataArray["user_id"] = user_id;
  console.log(user_id);
  let elemENT = document.querySelector("#loadIn");
  elemENT.innerHTML = "<b>wird geladen</b>";
  //console.log(elem, ' wurde aufgerufen');
  /* Anfrage vorbereiten */
  dataArray["funktion"] = "loadUser";
  //console.log(dataArray);
  json("loadIn", dataArray);
}

/** closeTable
 * closes the table with a display:none
 * requested by an X in the upper right corner
 */
function closeTable() {
  let elem = document.querySelector("#detailsTabelle");
  elem.style.display = "none";
}

/** loadWelcome
 * is called via onclick in welcome.php and passes this
 * extracts the number of the pass via data and requests the corresponding * file from the server via location.href.
 * file from the server.
 * All data is written to localStorage either directly or via collectInputData(),
 * from which they are then fetched via writeValues() without a network load.
 */
function loadWelcome(val) {
  let dataStep = val.getAttribute("data-step");
  let userRef =
    "?refUserId=" +
    parseInt(
      document.querySelector("#refContainer").getAttribute("data-user-ref")
    );
  console.log(userRef + " step=" + dataStep);
  if (dataStep == 1) {
    let inputData = document.getElementById("inputSelect").value;
    localStorage.setItem("land", inputData);
    location.href = "selectCity.php" + userRef;
  } else if (dataStep == 2) {
    let targetCity = document.getElementById("targetCity").value.trim();
    let targetCityZip = document
      .getElementById("targetCity")
      .dataset.zip.trim();
    localStorage.setItem("targetCity", targetCity);
    localStorage.setItem("targetCityZip", targetCityZip);
    location.href = "fillForm.php" + userRef;
  } else if (dataStep == 3) {
    collectInputData();
    $.post(
      root + "php/api.php",
      getPartnerRegistrationData(),
      function (response) {
        console.log(response);
        response = JSON.parse(response);
        if (response.userRegistration != "success") {
          let html = "";
          Object.keys(response).forEach((key) => {
            if (key == "userRegistration") return;
            html += response[key] + "<br>";
          });
          Swal.fire({
            title: "Eingabefehler",
            icon: "error",
            html: html,
            showCloseButton: true,
            showCancelButton: false,
            confirmButtonText: "Verstanden",
          });
          return;
        } else {
          localStorage.setItem("registeredUserId", response.userId);
          location.href = "showPayment.php" + userRef;
        }
      }
    );
    // writeValues();
  }
}

/** getPartnerRegistrationData
 * retrieves the data from the localStorage and prepares it * for sending to the DB.
 * for sending to the DB
 */
function getPartnerRegistrationData() {
  const fields = [
    "surName",
    "targetCity",
    "passwordRepeat",
    "salutation",
    "mobile",
    "land",
    "taxId",
    "zip",
    "city",
    "fax",
    "streetNumber",
    "password",
    "continent",
    "emailRepeat",
    "street",
    "url",
    "idNumber",
    "birthDate",
    "addressAppendix",
    "company",
    "email",
    "sponsorID",
    "firstName",
    "phone",
    "gtcAccepted",
    "privacyPolicyAccepted",
    "newsletterSubscribed",
  ];
  let data = {};
  fields.forEach((field) => {
    data[field] = localStorage.getItem(field);
  });
  data["funktion"] = "registerPartner";
  return data;
}

/** collectInputData
 * is called by loadWelcome()
 * reads the data of the current input fields and writes them to the localStorage
 * there they will be fetched later to fill the success form without network traffic
 */
function collectInputData() {
  let inputList = document.getElementsByTagName("input");
  let inputData = document.getElementById("inputSalutation").value;
  localStorage.setItem("salutation", inputData);
  for (let i = 0; i < inputList.length; i++) {
    //console.log('Name: ' + inputList[i].name + ' Wert: ' + inputList[i].value);
    if (inputList[i].name == "birthDay") {
      let birthDay = parseInt(inputList[i].value);
      i++;
      let birthMonth = parseInt(inputList[i].value);
      i++;
      let birthYear = parseInt(inputList[i].value);
      if (birthYear < 30) {
        birthYear = birthYear + 2000;
      } else if (birthYear < 100) {
        birthYear = birthYear + 1900;
      }
      let birthDate = birthDay + "." + birthMonth + "." + birthYear;
      localStorage.setItem("birthDate", birthDate);
    } else {
      const booleanMap = { false: 0, true: 1 };
      if (inputList[i].type == "checkbox") {
        localStorage.setItem(
          inputList[i].name,
          booleanMap[inputList[i].checked]
        );
        continue;
      }
      console.log(inputList[i].name);
      localStorage.setItem(inputList[i].name, inputList[i].value.trim());
    }
  }
}

/** writeValues
 * is called by loadWelcome
 * waits a short time and then loads the values into Success.php
 */
function writeValues() {
  let inputArray = {};
  console.log("writeValues");
  setTimeout(function () {
    let idNames = [
      "salutation",
      "birthDate",
      "firstName",
      "surName",
      "street",
      "streetNumber",
      "addressAppendix",
      "zip",
      "city",
      "idNumber",
      "company",
      "taxId",
      "phone",
      "fax",
      "mobile",
      "email",
      "url",
    ];

    for (let Key in idNames) {
      let id = idNames[Key];
      let wert = localStorage.getItem(id);
      console.log(id + ": " + wert);
      document.getElementById(id).innerHTML = wert;
      inputArray[id] = wert;
    }
    // console.log('Länge: '+inputArray.length);
    inputArray["funktion"] = "sendWelcome";
    json("loadIn", inputArray);
    console.log("writeValues TimeOut beendet");
  }, 1000);
}

/** loadCommission
 * is called by onclick on the TimeButton on the page current-commission
 * passes this for evaluation which button was clicked
 * @param elem = the object of the button for evaluation
 */
function loadCommission(elem) {
  window.location.href =
    forwardPages.partnerFinance + "?timespan=" + elem.dataset.period;
}

/** loadBadChild
 * is called by onclick on the My Teams page, in the store view area for faults.
 * loads the appropriate branch with a tree view that extends to the branch with the fault.
 * passes this to retrieve data-user_id.
 */
function loadBadChild(elem) {
  spinner("#badChildTree");
  let user_id = elem.getAttribute("data-user_id");
  console.log(user_id);
  let dataArray = {};
  dataArray.funktion = "loadBadChild";
  dataArray.user_id = user_id;
  console.log(dataArray);
  json("badChildTree", dataArray);
}

/** getDataArray
 * requests a JSON array
 * @param string data = function name, which data it is about.
 * @param int customerid = The ID of the customer to load (optional)
 */
function getDataArray(data, customerId) {
  console.log("Data: " + customerId);
  let dataSendArray = {};
  dataSendArray.funktion = data;
  if (customerId) {
    dataSendArray.customer_id = customerId;
  }
  let footer = document.querySelector("#footer");
  let userData = JSON.parse(footer.dataset.array);
  dataSendArray.user_id = userData["user_ID"];
  dataSendArray.customer_dealerID = userData["customer_dealerID"];

  json("tableInserter", dataSendArray);
}

let customerIdForConnection = ""; // is needed in "loadLiveData" and filled in "connectToCustomer".
let receiverSwitch = "";

/** connectToCustomer
 * establishes the connection to retrieve the customer inputs
 * @param string data = function name, what data it is about.
 */
function connectToCustomer(data) {
  // console.log("Data: " + customerId);
  let connectButton = document.querySelector("#connectButton");
  if (!receiverSwitch) {
    receiverSwitch = 1;
    connectButton.classList.add("inactive");
    connectButton.innerHTML = "Verbindung trennen";
  } else {
    receiverSwitch = 0;
    connectButton.classList.remove("inactive");
    connectButton.innerHTML = "Mit Kunden verbinden";
  }
  let connectionSendArray = {};
  connectionSendArray.customer_id = data;
  customerIdForConnection = data;
  let footer = document.querySelector("#footer");
  let userData = JSON.parse(footer.dataset.array);
  connectionSendArray.funktion = "insertEnergyTable";
  connectionSendArray.user_id = userData["user_ID"];
  console.log(JSON.stringify(connectionSendArray));
  json("insertEnergyTable", connectionSendArray);
}

/** startConnection
 * initialization for the loop
 */
function startConnection() {
  let liveArray = {};
  let footer = document.querySelector("#footer");
  let userData = JSON.parse(footer.dataset.array);
  liveArray.funktion = "transmitDataUserToDealer";
  // liveArray.user_id = 1234;
  liveArray.user_id = userData["user_ID"];
  liveArray.customer_id = customerIdForConnection;
  console.log(JSON.stringify(liveArray));

  setTimeout(function () {
    refreshBillingList();
    json("loadLiveData", liveArray);
  }, 10);
}

/** loadLiveData
 * then loads the data and sends it to the form (fillLiveForm)
 */
function loadLiveData(responseText) {
  console.log(
    "Customer-ID: " + customerIdForConnection + " Data: " + responseText
  );
  let liveArray = {};
  let footer = document.querySelector("#footer");
  let userData = JSON.parse(footer.dataset.array);
  liveArray.funktion = "transmitDataUserToDealer";
  liveArray.user_id = userData["user_ID"];
  liveArray.customer_id = customerIdForConnection;
  if (receiverSwitch) {
    setTimeout(function () {
      json("loadLiveData", liveArray);
      fillLiveForm(responseText);
    }, 250);
  }
}

/** fillLiveForm
 * Then fills the form independently of the loop run
 */
function fillLiveForm(data) {
  // let energy;
  let json = JSON.parse(data);
  console.log(json["customerType"]);
  switch (json["energyTypeDropdown"]) {
    case "strom allgemein":
      document.querySelector("#energyType").options.selectedIndex = 0;
      break;
    case "Haushaltsstrom":
      document.querySelector("#energyType").options.selectedIndex = 1;
      break;
    case "Heizstrom":
      document.querySelector("#energyType").options.selectedIndex = 2;
      break;
  }
  switch (json["customerType"]) {
    case "privateHome":
      document.querySelector("#privateHome").classList.add("activ");
      document.querySelector("#factoryHome").classList.remove("activ");
      break;
    case "factoryHome":
      document.querySelector("#factoryHome").classList.add("activ");
      document.querySelector("#privateHome").classList.remove("activ");
      break;
    default:
      document.querySelector("#privateHome").classList.remove("activ");
      document.querySelector("#factoryHome").classList.remove("activ");
      break;
  }
  switch (json["energyType"]) {
    case "power":
      document.querySelector("#strom").classList.add("activ");
      document.querySelector("#gas").classList.remove("activ");
      break;
    case "gas":
      document.querySelector("#gas").classList.add("activ");
      document.querySelector("#strom").classList.remove("activ");
      break;
    default:
      document.querySelector("#strom").classList.remove("activ");
      document.querySelector("#gas").classList.remove("activ");
      break;
  }
  let elementList = document.querySelectorAll(".persons");
  for (let i = 0; i < elementList.length; i++) {
    // bei jedem Vorkommen einfügen
    elementList[i].classList.remove("activ");
    if (i < json["persons"]) {
      elementList[i].classList.add("activ");
    }
  }
  document.querySelector("#plz").value = json["plz"];
  document.querySelector("#kwh").value = json["kwh"];
  document.querySelector("#yearlyCost").value = json["yearlyCost"];
}

/** refreshBillingList
 * is called in "energyTable" by clicking on button
 * and in startConnection (initial)
 */
function refreshBillingList() {
  let url = root + "partnerbereich/onlineberatung/billingTable.php";
  let datas = "customer_id:" + customerIdForConnection;
  $.post(
    url,
    {
      customer_id: customerIdForConnection,
    },
    function (result) {
      $("#billOutputContainer").html(result);
    }
  );
}

/** sendCommissionQuery
 * is called on the page "finanzen/aktuelle-provision" and sends
 * the requested amount
 */
function sendCommissionQuery() {
  let sendArray = {};
  if (document.querySelector("#commissionQuery")) {
    let commissionQuery = parseFloat(
      document.querySelector("#commissionQuery").value
    );
    sendArray.amount = commissionQuery;
  }
  let footer = document.querySelector("#footer");
  let userData = JSON.parse(footer.dataset.array);
  sendArray.user_id = userData["user_ID"];
  sendArray.funktion = "sendCommissionQuery";
  let selector = "tableContainer";
  json(selector, sendArray);
  console.log("commissionQuery");
}

/** showDevelopment
 * is called by onclick on the field "express-bonus" in the partner area (30 days)
 * expects the number of successful direct stores for the field express-bonus
 * these will then be displayed as a popup
 */
function showDevelopment(bonusPartnersNum) {
  let footer = document.querySelector("#footer");
  let userData = JSON.parse(footer.dataset.array);
  let user_id = userData["user_ID"];
  let html =
    '<div id="developmentContainer">' +
    '<div id="svgHead">XPRESS Bonus Übersicht</div>' +
    '<div id="svgContainer">' +
    '<div id="svgRow1">' +
    '<svg id="Capa_0" class="svgUser svgWhite" enable-background="new 0 0 189.524 189.524" height="51" viewBox="0 0 189.524 189.524" width="51" xmlns="http://www.w3.org/2000/svg"><g><g><path clip-rule="evenodd" d="m170.94 151.134c11.678-15.753 18.584-35.256 18.584-56.372 0-52.336-42.427-94.762-94.762-94.762-52.336 0-94.762 42.426-94.762 94.762 0 52.335 42.426 94.762 94.762 94.762 27.458 0 52.188-11.678 69.496-30.339 2.37-2.557 4.602-5.244 6.682-8.051zm-5.254-8.991c9.071-13.552 14.361-29.849 14.361-47.381 0-47.102-38.183-85.286-85.286-85.286-47.101 0-85.285 38.184-85.285 85.286 0 17.533 5.29 33.829 14.362 47.381 11.445-17.098 28.909-29.827 49.361-35.155-9.875-6.843-16.342-18.255-16.342-31.179 0-20.934 16.971-37.905 37.905-37.905s37.905 16.971 37.905 37.905c0 12.923-6.468 24.336-16.342 31.178 20.451 5.329 37.916 18.057 49.361 35.156zm-6.104 8.047c-13.299-21.869-37.353-36.476-64.819-36.476-27.467 0-51.522 14.607-64.821 36.477 15.642 18.275 38.878 29.857 64.82 29.857s49.178-11.583 64.82-29.858zm-64.82-45.952c15.701 0 28.429-12.727 28.429-28.429 0-15.701-12.727-28.429-28.429-28.429s-28.429 12.729-28.429 28.43 12.728 28.428 28.429 28.428z" fill-rule="evenodd"/></g></g></svg>' +
    '</div><div id="svgRow2">' +
    '<svg id="Capa_1" class="svgUser svgRed" enable-background="new 0 0 189.524 189.524" height="51" viewBox="0 0 189.524 189.524" width="51" xmlns="http://www.w3.org/2000/svg"><g><g><path clip-rule="evenodd" d="m170.94 151.134c11.678-15.753 18.584-35.256 18.584-56.372 0-52.336-42.427-94.762-94.762-94.762-52.336 0-94.762 42.426-94.762 94.762 0 52.335 42.426 94.762 94.762 94.762 27.458 0 52.188-11.678 69.496-30.339 2.37-2.557 4.602-5.244 6.682-8.051zm-5.254-8.991c9.071-13.552 14.361-29.849 14.361-47.381 0-47.102-38.183-85.286-85.286-85.286-47.101 0-85.285 38.184-85.285 85.286 0 17.533 5.29 33.829 14.362 47.381 11.445-17.098 28.909-29.827 49.361-35.155-9.875-6.843-16.342-18.255-16.342-31.179 0-20.934 16.971-37.905 37.905-37.905s37.905 16.971 37.905 37.905c0 12.923-6.468 24.336-16.342 31.178 20.451 5.329 37.916 18.057 49.361 35.156zm-6.104 8.047c-13.299-21.869-37.353-36.476-64.819-36.476-27.467 0-51.522 14.607-64.821 36.477 15.642 18.275 38.878 29.857 64.82 29.857s49.178-11.583 64.82-29.858zm-64.82-45.952c15.701 0 28.429-12.727 28.429-28.429 0-15.701-12.727-28.429-28.429-28.429s-28.429 12.729-28.429 28.43 12.728 28.428 28.429 28.428z" fill-rule="evenodd"/></g></g></svg>' +
    '<svg id="Capa_2" class="svgUser svgRed" enable-background="new 0 0 189.524 189.524" height="51" viewBox="0 0 189.524 189.524" width="51" xmlns="http://www.w3.org/2000/svg"><g><g><path clip-rule="evenodd" d="m170.94 151.134c11.678-15.753 18.584-35.256 18.584-56.372 0-52.336-42.427-94.762-94.762-94.762-52.336 0-94.762 42.426-94.762 94.762 0 52.335 42.426 94.762 94.762 94.762 27.458 0 52.188-11.678 69.496-30.339 2.37-2.557 4.602-5.244 6.682-8.051zm-5.254-8.991c9.071-13.552 14.361-29.849 14.361-47.381 0-47.102-38.183-85.286-85.286-85.286-47.101 0-85.285 38.184-85.285 85.286 0 17.533 5.29 33.829 14.362 47.381 11.445-17.098 28.909-29.827 49.361-35.155-9.875-6.843-16.342-18.255-16.342-31.179 0-20.934 16.971-37.905 37.905-37.905s37.905 16.971 37.905 37.905c0 12.923-6.468 24.336-16.342 31.178 20.451 5.329 37.916 18.057 49.361 35.156zm-6.104 8.047c-13.299-21.869-37.353-36.476-64.819-36.476-27.467 0-51.522 14.607-64.821 36.477 15.642 18.275 38.878 29.857 64.82 29.857s49.178-11.583 64.82-29.858zm-64.82-45.952c15.701 0 28.429-12.727 28.429-28.429 0-15.701-12.727-28.429-28.429-28.429s-28.429 12.729-28.429 28.43 12.728 28.428 28.429 28.428z" fill-rule="evenodd"/></g></g></svg>' +
    '<svg id="Capa_3" class="svgUser svgRed" enable-background="new 0 0 189.524 189.524" height="51" viewBox="0 0 189.524 189.524" width="51" xmlns="http://www.w3.org/2000/svg"><g><g><path clip-rule="evenodd" d="m170.94 151.134c11.678-15.753 18.584-35.256 18.584-56.372 0-52.336-42.427-94.762-94.762-94.762-52.336 0-94.762 42.426-94.762 94.762 0 52.335 42.426 94.762 94.762 94.762 27.458 0 52.188-11.678 69.496-30.339 2.37-2.557 4.602-5.244 6.682-8.051zm-5.254-8.991c9.071-13.552 14.361-29.849 14.361-47.381 0-47.102-38.183-85.286-85.286-85.286-47.101 0-85.285 38.184-85.285 85.286 0 17.533 5.29 33.829 14.362 47.381 11.445-17.098 28.909-29.827 49.361-35.155-9.875-6.843-16.342-18.255-16.342-31.179 0-20.934 16.971-37.905 37.905-37.905s37.905 16.971 37.905 37.905c0 12.923-6.468 24.336-16.342 31.178 20.451 5.329 37.916 18.057 49.361 35.156zm-6.104 8.047c-13.299-21.869-37.353-36.476-64.819-36.476-27.467 0-51.522 14.607-64.821 36.477 15.642 18.275 38.878 29.857 64.82 29.857s49.178-11.583 64.82-29.858zm-64.82-45.952c15.701 0 28.429-12.727 28.429-28.429 0-15.701-12.727-28.429-28.429-28.429s-28.429 12.729-28.429 28.43 12.728 28.428 28.429 28.428z" fill-rule="evenodd"/></g></g></svg>' +
    '<svg id="Capa_4" class="svgUser svgRed" enable-background="new 0 0 189.524 189.524" height="51" viewBox="0 0 189.524 189.524" width="51" xmlns="http://www.w3.org/2000/svg"><g><g><path clip-rule="evenodd" d="m170.94 151.134c11.678-15.753 18.584-35.256 18.584-56.372 0-52.336-42.427-94.762-94.762-94.762-52.336 0-94.762 42.426-94.762 94.762 0 52.335 42.426 94.762 94.762 94.762 27.458 0 52.188-11.678 69.496-30.339 2.37-2.557 4.602-5.244 6.682-8.051zm-5.254-8.991c9.071-13.552 14.361-29.849 14.361-47.381 0-47.102-38.183-85.286-85.286-85.286-47.101 0-85.285 38.184-85.285 85.286 0 17.533 5.29 33.829 14.362 47.381 11.445-17.098 28.909-29.827 49.361-35.155-9.875-6.843-16.342-18.255-16.342-31.179 0-20.934 16.971-37.905 37.905-37.905s37.905 16.971 37.905 37.905c0 12.923-6.468 24.336-16.342 31.178 20.451 5.329 37.916 18.057 49.361 35.156zm-6.104 8.047c-13.299-21.869-37.353-36.476-64.819-36.476-27.467 0-51.522 14.607-64.821 36.477 15.642 18.275 38.878 29.857 64.82 29.857s49.178-11.583 64.82-29.858zm-64.82-45.952c15.701 0 28.429-12.727 28.429-28.429 0-15.701-12.727-28.429-28.429-28.429s-28.429 12.729-28.429 28.43 12.728 28.428 28.429 28.428z" fill-rule="evenodd"/></g></g></svg>' +
    '<svg id="Capa_5" class="svgUser svgRed" enable-background="new 0 0 189.524 189.524" height="51" viewBox="0 0 189.524 189.524" width="51" xmlns="http://www.w3.org/2000/svg"><g><g><path clip-rule="evenodd" d="m170.94 151.134c11.678-15.753 18.584-35.256 18.584-56.372 0-52.336-42.427-94.762-94.762-94.762-52.336 0-94.762 42.426-94.762 94.762 0 52.335 42.426 94.762 94.762 94.762 27.458 0 52.188-11.678 69.496-30.339 2.37-2.557 4.602-5.244 6.682-8.051zm-5.254-8.991c9.071-13.552 14.361-29.849 14.361-47.381 0-47.102-38.183-85.286-85.286-85.286-47.101 0-85.285 38.184-85.285 85.286 0 17.533 5.29 33.829 14.362 47.381 11.445-17.098 28.909-29.827 49.361-35.155-9.875-6.843-16.342-18.255-16.342-31.179 0-20.934 16.971-37.905 37.905-37.905s37.905 16.971 37.905 37.905c0 12.923-6.468 24.336-16.342 31.178 20.451 5.329 37.916 18.057 49.361 35.156zm-6.104 8.047c-13.299-21.869-37.353-36.476-64.819-36.476-27.467 0-51.522 14.607-64.821 36.477 15.642 18.275 38.878 29.857 64.82 29.857s49.178-11.583 64.82-29.858zm-64.82-45.952c15.701 0 28.429-12.727 28.429-28.429 0-15.701-12.727-28.429-28.429-28.429s-28.429 12.729-28.429 28.43 12.728 28.428 28.429 28.428z" fill-rule="evenodd"/></g></g></svg>' +
    "</div>" +
    "</div>" +
    "</div>";
  // $.post(
  //   api,
  //   {
  //     funktion: "showDevelopment",
  //     user_ID: user_id,
  //   },
  //   function (result) {
  //     console.log("result: " + result);

  swal.fire({
    html: html,
    showCloseButton: true,
    showCancelButton: false,
    showConfirmButton: false,
    background: "#000",
  });
  let z = 1;
  if (bonusPartnersNum > 5) bonusPartnersNum = 5;
  for (let i = 0; i < bonusPartnersNum; i++) {
    let id = "Capa_" + z;
    z++;
    console.log("ID=" + id);
    document.getElementById(id).classList.remove("svgRed");
    document.getElementById(id).classList.add("svgGreen");
  }
  //   }
  // );
}

///////////////////////////
//// Kundenbereich ////////
///////////////////////////

let meldung1 = "<p>Das ist der Text</p>" + "<p>der wird toll!</p>";

/** loadAllOwnContracts
 * is called in the dashboard of the customer/blue tile/details and
 * loads the table with all owned contracts
 */
function loadAllOwnContracts() {
  let sendArray = {};
  let footer = document.querySelector("#footer");
  let userData = JSON.parse(footer.dataset.array);
  sendArray.user_id = userData["user_ID"];
  sendArray.funktion = "loadAllContractsFromOneCustomer";
  let selector = "tableContainer";
  json(selector, sendArray);
}

/** getOffer
 * is called via Oncklick on the page "Angebot einholen".
 * passes this from which ID and data elements are extracted
 * @param elem = this
 */
function getOffer(elem) {
  let queryItem;
  let parent = elem.parentElement;
  let user_id = parent.getAttribute("data-user_id").split(";");
  let offer = elem.id;
  switch (offer) {
    case "power":
      queryItem = "Strom / Gasvertrag";
      break;
    case "dsl":
      queryItem = "DSL-Vertrag";
      break;
    case "mobile":
      queryItem = "Mobilfunk-Vertrag";
      break;
    case "solar":
      queryItem = "Solaranlage";
      break;
  }
  let data =
    '<div id="alert1"><div id="text">Möchtest Du ein Angebot für<br>' +
    queryItem +
    '</div><div id="buttonRow"><div id="cancel">Abbrechen</div><div id="accept">Ja, ich möchte</div></div></div>';
  let data2 =
    '<div id="alert2"><h4>Glückwunsch!</h4><img src="' +
    root +
    'media/webseite/icons/daumen.png">' +
    '<div id="footer">Dein persönlicher Berater/in<br>wurde soeben informiert<br>und wird sich zeitnah bei Dir melden!</div></div>';
  let jsonArray = {};
  jsonArray.funktion = "getOffer";
  jsonArray.query = offer;
  jsonArray.user_id = user_id[0];
  jsonArray.dealer_id = user_id[1];
  Swal.fire({
    title: "Information",
    icon: "info",
    html: "Möchtest Du ein Angebot für einen " + queryItem + "?",
    showCloseButton: true,
    showCancelButton: true,
    confirmButtonText: "Ja",
    cancelButtonText: "Nein",
    reverseButtons: "true",
  }).then((res) => {
    if (!res.isConfirmed) return;

    fetch(
      root +
        `php/api.php?funktion=sendContractNotifyToPartner&contractType=${queryItem}&customerId=${jsonArray.user_id}&partnerId=${jsonArray.dealer_id}`
    )
      .then((res) => res.text())
      .then((res) => {
        res = JSON.parse(res);
        console.log(res);
        let bannerTitle = "Erfolgreich";
        let bannerIcon = "success";
        let bannerHtml =
          "Dein persönlicher Berater wurde kontaktiert und wird sich zeitnah bei dir melden.";

        if (res.partnerNotified) {
          bannerTitle = "Fehler";
          bannerIcon = "error";
          bannerHtml =
            "Dein persönlicher Berater/in konnte <b>nicht</b> kontaktiert werden. Bitte versuche es später erneut.";
        }
        Swal.fire({
          title: bannerTitle,
          icon: bannerIcon,
          html: bannerHtml,
          showCloseButton: true,
          showCancelButton: false,
          confirmButtonText: "Verstanden",
        });
      });
  });

  json("", jsonArray);
  console.log(jsonArray);
  console.log("Data-Atribut: " + offer);
  console.log("User: " + user_id[0] + " dealer: " + user_id[1]);
}

/** makeOrder
 * is called by onclick on the page startOrder
 * this will order the offered tariff
 * @param string offerID = the offer number by which the offered tariff is identifiable
 */
function makeOrder(offerID) {
  let sendArray = {};
  sendArray.offer_id = offerID;
  let footer = document.querySelector("#footer");
  let userData = JSON.parse(footer.dataset.array);
  sendArray.user_id = userData["user_ID"];
  sendArray.customer_dealerID = userData["customer_dealerID"];
  sendArray.kind = document.querySelector("#kind").innerHTML;
  sendArray.order_id = document.querySelector("#orderID").innerHTML;
  sendArray.funktion = "makeOrder";
  console.log(JSON.stringify(sendArray));
  // json("answerText", sendArray);
  $.post(
    api,
    {
      funktion: "addEnergyContract",
      userId: sendArray.user_id,
      headId: sendArray.customer_dealerID,
      units: 1,
      productId: 1,
      type: "energy",
    },
    function (res) {
      res = JSON.parse(res);
      if (res.contractCreated) {
        Swal.fire({
          title: "Erfolgreich",
          icon: "success",
          text: "Dein Vertrag wurde soeben eingereicht.",
          showCloseButton: true,
          showCancelButton: false,
          confirmButtonText: "Verstanden",
        }).then((res) => {
          window.location.href = forwardPages.customer;
        });
      } else {
      }
    }
  );
}

let transmissionToAdvisorSwitch = false;
/** callAdvisor
 * is displayed in the TopSection Customer and hidden by display:none
 * is shown again on the page optimierung/gas.index.php in the footer section
 * call by onclick on the button
 * establishes a connection to the consultant, who then sees in "real time" what the customer clicks on
 */
function callAdvisor(elem) {
  let footer = document.querySelector("#footer");
  let userData = JSON.parse(footer.dataset.array);
  sendKey.user_id = userData["user_ID"];
  sendKey.customer_dealerID = userData["customer_dealerID"];
  sendKey.funktion = "sendKey";
  if (transmissionToAdvisorSwitch) {
    Swal.fire({
      title: "Bestätigung erforderlich",
      icon: "info",
      text: "Bist du sicher, dass du die Verbindung trennen möchtest?",
      showCloseButton: true,
      showCancelButton: true,
      showConfirmButton: true,
      reverseButtons: true,
      cancelButtonText: "Abbrechen",
      confirmButtonText: "Verbindung trennen",
    }).then((res) => {
      if (!res.isConfirmed) {
        return;
      }

      transmissionToAdvisorSwitch = false;
      elem.classList.remove("disabled");
      elem.innerHTML = "Mit Berater verbinden";
      console.log("Übertragung ist aus");
    });
  } else {
    Swal.fire({
      title: "Bestätigung erforderlich",
      icon: "info",
      text: "Bist du sicher, dass du die Verbindung aufbauen möchtest?",
      showCloseButton: true,
      showCancelButton: true,
      showConfirmButton: true,
      reverseButtons: true,
      cancelButtonText: "Abbrechen",
      confirmButtonText: "Verbindung aufbauen",
    }).then((res) => {
      if (!res.isConfirmed) {
        return;
      }
      transmissionToAdvisorSwitch = true;
      elem.classList.add("disabled");
      elem.innerHTML = "Verbindung trennen";
      console.log("Übertragung ist an");
      let plz = document.querySelector("#plz");
      plz.addEventListener("keyup", function (event) {
        sendKey.plz = plz.value;
        console.log("Sender: " + JSON.stringify(sendKey));
      });
      let offerContainer = document.querySelector("#offerContainer");
      offerContainer.addEventListener("keyup", function (event) {
        let plz = document.querySelector("#plz");
        sendKey.plz = plz.value;
        let kwh = document.querySelector("#kwh");
        sendKey.kwh = kwh.value;
        let yearlyCost = document.querySelector("#yearlyCost");
        sendKey.yearlyCost = yearlyCost.value;
        transmissionToAdvisor(sendKey);
      });
    });
  }
}

/** transmissionToAdvisor
 * transmits the data from sendEnergy and groupSelector
 */
function transmissionToAdvisor(dataArray) {
  if (transmissionToAdvisorSwitch) {
    console.log("Sender: " + JSON.stringify(sendKey));
    // ajax("sendKey", JSON.stringify(sendKey)); #TODO:
    $.post(api, sendKey, function (res) {
      console.log(res);
    });
  }
}

/** listSelector
 * is triggered by onchange and reports to transmissionToAdvisor
 */
function listSelector(elem) {
  let energyOptions = elem.value;
  switch (energyOptions) {
    case "keineAngabe":
      // sendEnergy["powerType"] = "strom allgemein";
      sendKey.energyTypeDropdown = "strom allgemein";
      transmissionToAdvisor(sendKey);
      break;
    case "Haushaltsstrom":
      // sendEnergy["powerType"] = "Haushaltsstrom";
      sendKey.energyTypeDropdown = "Haushaltsstrom";
      transmissionToAdvisor(sendKey);
      break;
    case "Heizstrom":
      // sendEnergy["powerType"] = "Heizstrom";
      sendKey.energyTypeDropdown = "Heizstrom";
      transmissionToAdvisor(sendKey);
      break;
  }
}

///////////////////////////
/// Controlling-Bereich ///
///////////////////////////

/** loadContract
 * is called by clicking on the table row and searches for the contract number,
 * to load the details of the contract
 */
function loadContract(elem) {
  console.log("Treffer");
  let sendData = {};
  let footer = document.querySelector("#footer");
  let userData = JSON.parse(footer.dataset.array);
  sendData["user_id"] = userData["user_ID"];
  sendData["role"] = userData["role"];
  sendData["funktion"] = "loadContract";
  let rowItems = elem.children;
  let contractNumber;
  for (let i = 0; i < rowItems.length; i++) {
    // console.log("im for" + rowItems[i].className);
    if (rowItems[i].className == "order_id") {
      sendData.contractNumber = rowItems[i].innerHTML;
    } else if (rowItems[i].className == "order_type") {
      sendData.orderType = rowItems[i].innerHTML;
    }
  }
  console.log(JSON.stringify(sendData));
  spinner("#introContractControlling");
  json("introContractControlling", sendData);
}

/** confirmContract
 * is called by onclick on the page check offer
 * this will trigger the points and commission calculation
 * @param string orderID = the order ID of the order to be confirmed
 */
function confirmContract(orderID) {
  let sendArray = {};
  sendArray.order_id = orderID;
  sendArray.funktion = "confirmContract";
  // console.log(JSON.stringify(sendArray));
  // json("answerText", sendArray);
  $.post(
    api,
    { funktion: "confirmContract", orderId: orderID },
    function (res) {
      console.log(res);
      res = JSON.parse(res);
      if (res.contractConfirmed) {
        Swal.fire({
          title: "Erfolgreich",
          icon: "success",
          html: "Der Vertrag wurde erfolgreich freigegeben.",
          showCloseButton: true,
          showCancelButton: false,
          confirmButtonText: "Weiter",
        }).then((res) => {
          location.reload();
        });
      }
    }
  );
}

/** monthlyBilling
 * button in the controlling dashboard, which is only relevant for the test phase
 * later the evaluation will be started by the workflow in controlling
 */
function monthlyBilling() {
  $.post(api, { funktion: "monthlyBilling" }, function (res) {});
  $("#monthlyBilling").text("Auswertung wurde gestartet").addClass("done");
}

///////////////////////////
//// Standard-Bereich /////
///////////////////////////

/** setHtml
 * sets at the ID the passed code
 * @param id = ID of the target without #
 * @param data = the code to be inserted
 */
function setHtml(id, data) {
  let target = document.getElementById(id);
  console.log("Data: " + data);
  target.innerHTML = data;
}

/** fileUpLoader
 * is called by form button e.g. in "tarifrechner/strom".
 * code comes from: "https://www.mediaevent.de/javascript/simple-file-upload.html"
 * A table with files is in kundenbereich/optimierung/tarifrechner/strom
 */
function fileUpLoader() {
  const url = root + "upload/fileUpLoader.php";
  const form = document.querySelector("#uploadform");
  const targetEnding = ["pdf", "jpg", "jpeg", "png", "gif"];
  let checker = 1;
  // Ein EventListener wartet auf das submit
  form.addEventListener("submit", function (evt) {
    evt.preventDefault();
    let files = document.querySelector("[type=file]").files;
    let formData = new FormData();
    if (files.length < 1) {
      // Prüfung, ob eine Datei ausgewählt wurde
      form.style.opacity = "0.5";
      setTimeout(function () {
        alert("Bitte zuerst eine Datei auswählen!");
        location.reload();
      }, 100);
    } else {
      for (let i = 0; i < files.length; i++) {
        let file = files[i];
        let ending = file["name"].split(".").at(-1); // Datei-Endung isolieren
        ending = ending.toLowerCase();
        if (!targetEnding.includes(ending)) {
          // Prüfung, ob die Dateiendung erlaubt ist
          console.log("Ending: " + ending + " ist nicht in: " + targetEnding);
          checker = 0;
          form.style.opacity = "0.5";
          setTimeout(function () {
            alert('Nur "gif","jpg","jpeg","png" oder"pdf"-Dateien" möglich!');
            document.querySelector("[type=file]").files = null; // Input[file] wieder resetten
            location.reload();
          }, 100);
        }
        console.log(ending);
        formData.append("files[]", file);
      }
      if (checker == 1) {
        fetch(url, {
          method: "POST",
          body: formData,
        }).then((response) => {
          console.log(response);
          if (response.status === 200) {
            document.querySelector("#result").innerHTML =
              '<span class="done">Dateien wurden geladen</span>';
          }
        });
      }
    }
  });
}

/** json -> sends the current data to api.php via JSON.
 * @param targetID = The ID where to insert. Without #
 * @param data the data to send to the dispatcher
 * @return no return
 */
function json(targetID, data) {
  let url = root + "php/api.php";
  //console.log(url);
  var request = new XMLHttpRequest();
  request.open("POST", url);
  request.setRequestHeader("Content-type", "application/json");
  request.addEventListener("load", function (event) {
    if (request.status >= 200 && request.status < 300) {
      // console.log(request.responseText);
      if (targetID) {
        let target = document.getElementById(targetID);
        //console.log(targetID);
        if (targetID == "insertEnergyTable") {
          startConnection();
        } else if (targetID == "loadLiveData") {
          console.log("json response");
          console.log(request.responseText);
          loadLiveData(request.responseText);
        }
        if (targetID != "loadLiveData") {
          // console.log("Ziel: " + targetID);
          target.innerHTML = request.responseText;
        }
      }
    } else {
      console.warn(request.statusText, request.responseText);
    }
  });
  request.send(JSON.stringify(data));
}

function testMelder() {
  alert("testMelder");
}

/** spinner
 * loads a spinner at the ID, which will later be replaced by real content
 * @param string id = ID (prefixed with "#"), thus also applicable in classes
 */
function spinner(id) {
  // let targetID = id;
  console.log("Ziel: " + id);
  let target = document.querySelector(id);
  target.innerHTML =
    '<svg class="spinner" width="180px" height="180px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg><br><p>Daten werden geladen</p>';
}

/** loadData is usually called by "onclick" and passes the target selector.
 * calls the function post() itself and passes the name of the desired function to it,
 * and the selector for returning the data
 * @param selector The target selector where the return is to be inserted
 * @return no return
 */
function loadData(selector, data) {
  let funktion = "test";
  switch (selector) {
    case "#loadIn":
      // Anfrage wurde aufgerufen
      funktion = "funktion=loadDetailsList";
      post(funktion, selector);
      break;
    case "#InputContainerContent":
      // WelcomeFormular wurde aufgerufen
      funktion = "funktion=welcome";
      post(data, selector);
      break;
    case ".mailCloak":
      // cloakMail fragt an
      // data bringt die dbList für die Anzahl der Listenabfrage mit sich
      funktion = "funktion=cloak";
      post(funktion, selector);
      break;
    case "#dsebody":
      // DSE fragt an
      // kein data, kein return
      funktion = "funktion=DSE";
      post(funktion);
      break;
    case "#dsebodySocial":
      // DSE fragt an
      // kein data, kein return
      funktion = "funktion=DSEsocial";
      post(funktion);
      break;
  }
}
/** post -> to reload data via POST.
 * is called by loadData and passes the desired function,
 * and the target selector
 * @param url the full destination address of dispatcher.php
 * @param function the desired function called by dispatcher.php
 * @param selector the target position for the return, can be any CSS selector,
 * if the selector exists more than once (class), it will be inserted at each occurrence
 * @return no return
 */
function post(funktion, selector) {
  let url = root + "dispatcher.php";
  //console.log('Post-Anfrage gesendet: '+funktion);
  var request = new XMLHttpRequest();
  request.open("POST", url);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.addEventListener("load", function (event) {
    if (request.status >= 200 && request.status < 300) {
      let elementList = document.querySelectorAll(selector);
      for (let i = 0; i < elementList.length; i++) {
        // bei jedem Vorkommen einfügen
        elementList[i].innerHTML = request.responseText;
        //console.log(selector+request.responseText);
      }
    } else {
      console.warn(request.statusText, request.responseText);
    }
  });
  request.send(funktion);
}

/** ajax -> sends the current data to dispatcher.
 * @param url the full destination address of dispatcher.php
 * @param function the desired function called by dispatcher.php
 * @param data the data to be sent to dispatcher
 * @return no return
 */
function ajax(funktion, data) {
  //console.log(funktion+' Daten: '+data);
  let funktionSend = "funktion=" + funktion + "&data=" + data;
  //console.log(funktionSend);
  let url = root + "dispatcher.php";
  //console.log(url);
  var request = new XMLHttpRequest();
  request.open("POST", url);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.addEventListener("load", function (event) {
    if (request.status >= 200 && request.status < 300) {
      console.log(request.responseText);
    } else {
      console.warn(request.statusText, request.responseText);
    }
  });
  request.send(funktionSend);
}

// Initialisierung
document.addEventListener("DOMContentLoaded", function (event) {
  let viewportHeigth = document.documentElement.clientHeight; // Höhe des aktuellen Views
  let z = 0; // Zähler für die Scrollüberwachung (sonst zu nervös)
  /** Scroll-Effekte */
  document.addEventListener("scroll", function () {
    if (document.querySelectorAll(".movedown")) {
      let movedown = document.querySelectorAll(".movedown");
      for (let i = 0; i < movedown.length; i++) {
        let moveItem = movedown[i].getBoundingClientRect().top;
        if (moveItem < viewportHeigth * 0.9) {
          movedown[i].classList.add("translateOrigin");
          //console.log('Hier bin ich jetzt ' + movedown[i].classList);
        }
      }
    }
  });
});

/** payPartnerLicense
 * is called on the "showPayment" page and initiates payment
 * (further processing still needs to be implemented)
 */
function payPartnerLicense() {
  $.post(
    api,
    { funktion: "payPartnerLicense", userId: localStorage.registeredUserId },
    function (res) {
      res = JSON.parse(res);
      if (res.unitsGiven) {
        Swal.fire({
          title: "Erfolgreich",
          icon: "success",
          html: "Dein Account wurde erfolgreich erstellt.",
          showCloseButton: true,
          showCancelButton: false,
          confirmButtonText: "Weiter",
        }).then((res) => {
          window.location.href = loginPage;
        });
      } else {
        Swal.fire({
          title: "Fehler",
          icon: "error",
          html: "Ein unerwarter Fehler ist aufgetreten.",
          showCloseButton: true,
          showCancelButton: false,
          confirmButtonText: "Weiter",
        });
      }
    }
  );
}

async function getCities(countryCode) {
  $.get(
    root + "php/api.php",
    {
      funktion: "getCitiesWithAvailableLicenses",
      countryCode: countryCode,
    },
    function (res) {
      try {
        console.log(res);
      } catch (error) {
        return "fehler beim laden";
      }
    }
  );
}

function checkPassword(str) {
  var re = /^(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  return re.test(str);
}

function validateEmail(email) {
  const re =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}
