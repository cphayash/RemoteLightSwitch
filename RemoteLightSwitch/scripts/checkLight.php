<?php
$servername = "localhost";
$username = "user";
$password = "password";
$dbname = "database";

$update_sys_time = date('Y-m-d G:i:s');
$status = 1;
$device_name = "main_light";
$device_id = "1";

$isOn = 1;
$status_phrase = "Off";

// echo $update_sys_time.", ".$status.", ".$device_name.", ".$device_id;
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>ID</th><th></th><th>device_id</th><th>device_name</th><th>status</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

// Create connection
try {
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("SELECT * FROM lights ORDER BY update_sys_time DESC LIMIT 1");
        $query->execute();

	// set the resulting array to associative
	$result = $query->setFetchMode(PDO::FETCH_ASSOC);
	foreach(new TableRows(new RecursiveArrayIterator($query->fetchAll())) as $k=>$v) {
		echo $v;
		if ($k == "status") {
			$isOn = $v;
			// echo "IF!";
		}
	}	
 }
catch(PDOException $e) {
        echo "<br><br>Error: ".$e->getMessage();
}

if ($isOn === strval(1)) { $status_phrase = 'On'; }

$conn = null;
echo "</table>";
echo $isOn;
echo gettype($isOn);
echo $status_phrase;
echo "<br>".strval(1);
?>
