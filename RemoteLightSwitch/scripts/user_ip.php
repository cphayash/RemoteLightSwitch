<?php
$user_ip = getenv('REMOTE_ADDR');
echo "You got here from: " . $user_ip;
$other_ip = $_SERVER['REMOTE_ADDR'];
echo "<br>The other ip is: " . $other_ip;
// These return the same values :/
?>
