<?php
$name = $_GET['name'];
$age = $_GET['age'];
echo "Hello, ".$name."!<br><br>";

if (is_numeric($age)) {
	echo 'You are '.$age.' years old!';
}
?>
