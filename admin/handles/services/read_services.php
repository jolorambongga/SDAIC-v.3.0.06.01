<?php

require_once('../../../includes/config.php');

try {

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT s.service_id, s.service_name, s.description, s.duration, s.cost, s.doctor_id, d.doctor_name
			FROM tbl_Services AS s
			LEFT JOIN tbl_Doctors AS d
			ON s.doctor_id = d.doctor_id;";

	$stmt = $pdo->query($sql);

	$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

	header('Content-Type: application/json');

	echo json_encode(array("status" => "success", "process" => "read services", "data" => $services));


} catch (PDOException $e) {
	echo json_encode(["status" => "error", "message" => $e->getMessage(), "report" => "read catch reached"]);
}