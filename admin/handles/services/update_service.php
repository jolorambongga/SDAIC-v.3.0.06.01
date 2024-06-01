<?php

require_once('../../../includes/config.php');

try {

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$service_id = $_POST['service_id'];
	$service_name = $_POST['service_name'];
	$description = $_POST['description'];
	$duration = $_POST['duration'];
	$cost = $_POST['cost'];
	$doctor_id = $_POST['doctor_id'];

	$sql = "UPDATE tbl_Services SET service_name = ?, description = ?, duration = ?, cost = ?, doctor_id = ?
			WHERE service_id = ?;";

	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(1, $service_name, PDO::PARAM_STR);
	$stmt->bindParam(2, $description, PDO::PARAM_STR);
	$stmt->bindParam(3, $duration, PDO::PARAM_STR);
	$stmt->bindParam(4, $cost, PDO::PARAM_STR);
	$stmt->bindParam(5, $doctor_id, PDO::PARAM_STR);
	$stmt->bindParam(6, $service_id, PDO::PARAM_STR);

	$stmt->execute();


	header('Content-Type: application/json');

	echo json_encode(array("status" => "success", "process" => "update service"));


} catch (PDOException $e) {
	echo json_encode(["status" => "error", "message" => $e->getMessage(), "report" => "update catch reached"]);
}