<?php
include_once("inc_useful.php");


function sendTransmissionDataToDb($userId, $data)
{

    try {
        $data = json_encode($data);
        $db = DbConNew();
        $stmt = $db->prepare("SELECT data FROM partner_customer_transmission WHERE user_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            $stmt = $db->prepare("UPDATE partner_customer_transmission SET data = :data WHERE user_id = :userId");
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":data", $data);
            $stmt->execute();
            return json_encode(array("dataTransmission" => "success"));
        }
        $stmt = $db->prepare("INSERT INTO partner_customer_transmission (user_id, data) VALUES (:userId, :data)");
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":data", $data);
        $stmt->execute();
        return json_encode(array("dataTransmission" => "success"));
    } catch (\Throwable $th) {
        return $th;
        return json_encode(array("dataTransmission" => "failed"));
    }
}


function getTransmissionData($userId)
{
    try {
        $db = DbConNew();
        $stmt = $db->prepare("SELECT data FROM partner_customer_transmission WHERE user_id = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $user = $stmt->fetch();
        return $user["data"];
    } catch (\Throwable $th) {
        return "{}";
    }
}
