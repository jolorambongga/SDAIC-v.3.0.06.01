<?php

require_once('../../../includes/config.php');

try {

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT d.first_name, d.middle_name, d.last_name ";

	$stmt = $pdo->query($sql);

	$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

	header('Content-Type: application/json');

	echo json_encode(array("status" => "success", "process" => "read doctors", "data" => $doctors));


} catch (PDOException $e) {
	echo json_encode(["status" => "error", "message" => $e->getMessage(), "report" => "catch reached"]);
}