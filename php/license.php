<?php
function getAvailableLicensesForCountry()
{
    $countryCode = "DE";
    $db = DbConNew();
    $stmt = $db->prepare("SELECT c.place, c.zip,  c.place as label, r.resident_number, SUM(CEIL(r.resident_number / 2 * 0.15 / 300) - (SELECT COUNT(work_location_zip) FROM partner WHERE work_location_zip = c.zip)) as available_region_licenses FROM city c INNER JOIN resident r ON r.zip = c.zip WHERE c.country_code = :countryCode GROUP BY c.place");
    // $stmt = $db->prepare("SELECT DISTINCT  place, zip FROM city WHERE country_code = :countryCode");
    $stmt->bindParam(":countryCode", $countryCode);
    $stmt->execute();
    $data = $stmt->fetchAll();

    return json_encode($data, JSON_UNESCAPED_UNICODE);
}
