<?php
/**
 * Created by PhpStorm.
 * User: amina
 * Date: 29.04.2018
 * Time: 09:56
 */

require("database.php");

$password = "";
$loggedin = false;
if (isset($_POST["psw"])) {
    $password = $_POST["psw"];




    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }



    $currenttimestamp = time();
    $currenttime = date("Y-m-d H:i:s", $currenttimestamp - 3600);
    $sql = "SELECT log_id, false_login_count, timestamp FROM login_log WHERE timestamp>='" . $currenttime . "'";
    $result = $conn->query($sql);

    $proceed_login = true;
    $false_login_count = 0;
    $log_id = 0;

    if ($result->num_rows > 0) {
        // output data of each row
        if ($row = mysqli_fetch_assoc($result)) {
            $false_login_count = ((int)$row["false_login_count"]);
            $log_id = ((int)$row["log_id"]);

            if ($false_login_count > 3) {
                $proceed_login = false;
            }
        }
    }

    if ($proceed_login) {
        $sql = "SELECT user_id FROM user WHERE password='" . $password . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $loggedin = true;
        }
        else if ($false_login_count > 0){
            $false_login_count++;
            $sql = "UPDATE login_log SET false_login_count=".$false_login_count." WHERE log_id=".$log_id;

            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
            //$conn->query($sql);
        }
        else {
            $sql = "INSERT INTO login_log (false_login_count) VALUES (1)";
            $conn->query($sql);
        }
    }

    $conn->close();

}

require( "start.php" );

