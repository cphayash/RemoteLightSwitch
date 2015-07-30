<?php
$servername = "localhost";
$username = "user";
$password = "password";
$dbname = "database";

$update_sys_time = date('Y-m-d G:i:s');
$status = 1;
$device_name = "main_light";
$device_id = "1";
$ip_source = getenv('REMOTE_ADDR');


// Create connection
try {
	$conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO lights (update_sys_time, device_id, device_name, status, ip_addr)
		VALUES ('".$update_sys_time."', ".$device_id.", '".$device_name."', ".$status.", '".$ip_source."')";
	// use exec() because no results are returned
	$conn->exec($sql);
	// echo "New record created successfully";
	echo "Light is ON";
	}
catch(PDOException $e) {
	echo $sql."<br>".$e->getMessage();
	}

$conn = null;
?>
