<?php

$servername = "localhost";
$username = "root";
$password = "R34d0nly";
$dbname = "home_automation";

try {
	echo "Preparing MySQL connection...";
	$conn = new PDO("mysql:host=$servername; dbname = $dbname", $username, $password);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<br><br>Preparing to process MySQL query...<br><br>";
	$sql = "SELECT * FROM LIGHTS ORDER BY update_sys_time DESC LIMIT 1";
	$conn->exec(sql);
	$data = $conn->fetchAll(PDO::FETCH_ASSOC);
//	echo $data;
//	echo $conn;
	echo "Hi there!";
} catch(PDOException $e) {
	echo $sql."<br>".$e->getMessage();
}

