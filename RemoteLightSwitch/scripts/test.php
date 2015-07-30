<?php
        $con = mysql_connect("localhost","user","password");
        if (!$con) {
                die('Could not connect: ' . mysql_error());
        }

        mysql_select_db("home_automation", $con);

        $query=mysql_query("SELECT * FROM home_automation.lights");
        // $row = mysql_fetch_assoc($query);
        $row = mysql_fetch_array($query);
        // $_SESSION = $row

        $id = mysql_result($query, $i, "id");
        $update_sys_time = mysql_result($query, $i, "update_sys_time");
        $device_id = mysql_result($query, $i, "device_id");
        $device_name = mysql_result($query, $i, "device_name");
        $status = mysql_result($query, $i, "status");

	function hello() {
		echo "Hello!";
	}

        if($query) {
                // print_r($row);
		echo $row['device_name'];
                echo "Device name: $device_name <br>Status: $status <br>ID: $id<br>System update time: $update_sys_time<br>Status: $status ";
                // echo $id;
                // echo $update_sys_time;
                // echo $status;

                echo '<script language="javascript"> alert("Hello!");</script>';
                $_SESSION['query'] = $device_name;
		echo "This is a line. <br> And this should be a new line.<br>";
		
		echo "<br> <script language='javascript' type='text/javascript'> hello() { 
				alert('Hello there!'); 
			} </script>
			<input id='button1' type='button' onclick='hello();' value='Go!'/>";

		// echo '<br><script type="text/javascript"> hello() {
                //                alert("Hello there!");
                //        } </script>
                //        <input id="button1" type="button" onclick="hello();" value="Go!"/>';
        }
        else {
                echo "An error occurred!";
        }
?>
