<?php
include_once($root . "php/inc_branchStatistics.php");

$counter = 1;
$json = @file_get_contents($root . 'js/customerList.json');
$jsonArray = json_decode($json, true);
// JSON-Daten vom Server laden
// $jsonArray = getJSON('customerList');
$jsonArray = (array) json_decode(getBranchCustomerAreaStatistics($_SESSION["user_id"]));

$totalCustomerNumber = $jsonArray['user_ownCustomerNumber'] + $jsonArray['user_childCustomerNumber'];
$totalPowerCustomerNumber = $jsonArray['user_ownPowerCustomerNumber'] + $jsonArray['user_childPowerCustomerNumber'];
$totalGasCustomerNumber = $jsonArray['user_ownGasCustomerNumber'] + $jsonArray['user_childGasCustomerNumber'];
$totalDslCustomerNumber = $jsonArray['user_ownDslCustomerNumber'] + $jsonArray['user_childDslCustomerNumber'];
$totalMobileCustomerNumber = $jsonArray['user_ownMobileCustomerNumber'] + $jsonArray['user_childMobileCustomerNumber'];
$totalAllCustomerNumber = $jsonArray['user_ownAllCustomerNumber'] + $jsonArray['user_childAllCustomerNumber'];

?>
<section id="contentContainer" class="flex flex-column">
    <div id="startBlock1" class="movedown scroll">
        <div id="customerDataContainer">
            <div id="customerData">
                <div class="headline">Kundenstammdaten</div>
                <select id="inputSelect" name="inputSelect">
                    <option disabled>Belgien</option>
                    <option disabled>Polen</option>
                    <option disabled>Frankreich</option>
                    <option disabled>Österreich</option>
                    <option selected>Deutschland</option>
                    <option disabled>Schweiz</option>
                    <option disabled>Türkei</option>
                    <option disabled>Griechenland</option>
                </select>
                <div class="row">
                    <span class="label">PLZ:</span>
                    <input type="number" name="zip" id="zip" placeholder="PLZ" size="5">
                </div>
                <div class="row">
                    <span class="label">Name:</span>
                    <input type="text" name="surName" id="surName" placeholder="Kundenname" size="20">
                </div>
                <div id="buttonRow">
                    <div id="buttonGreen">aktualisieren</div>
                    <div id="buttonBlack">neuer Kunde</div>
                </div>
            </div>
            <div id="contractColumn">
                <div class="headline">Belieferung</div>
                <div id="contractData">
                    <div id="delivery" class="row">
                        <input name="startDelivery" id="startDelivery" type="date" placeholder="Belieferung ab" size="10">
                        <input name="endDelivery" id="endDelivery" type="date" placeholder="Belieferung bis" size="10">
                    </div>
                </div>
                <div class="headline">Vertragsende</div>
                <div id="contractEnd" class="row">
                    <input name="startContractEnd" id="startContractEnd" type="date" placeholder="Vertragsende ab" size="10">
                    <input name="endContractEnd" id="endContractEnd" type="date" placeholder="Vertragsende bis" size="10">
                </div>
            </div>
            <div id="filterColumn">
                <div class="headline">Kundenstammdaten</div>
                <select id="filterSelect" name="filterSelect">
                    <option>bitte wählen</option>
                    <option>Strom</option>
                    <option>Gas</option>
                    <option>DSL</option>
                    <option>Mobilfunk</option>
                </select>
                <div id="inverter">
                    <input type="checkbox" id="infertFilter" name="infertFilter" style="appearance:auto;">
                    <label for="newsletterSubscribed" style="font-size:0.8em;">
                        nur Kunden anzeigen, die keine Vertäge des ausgewählten Produkttyps haben
                    </label>
                </div>
            </div>
        </div>
        <div id="answerContainer">
            <span class="red">keine Bestandsdaten gefunden</span><br>
            <span>Leider konnten mit den von Dir angegebenen Suchparametern keine Kunden in Deinem Bestand gefunden werden.</span>
        </div>
        <div id="tableInserter"></div>
    </div>
</section>