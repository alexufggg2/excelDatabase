<?php 

set_time_limit(0);
header('Content-Type: text/html; charset=utf-8');


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$servername = "192.168.254.222";
$username = "root";
$password = "hksei24782332hk";
$dbname = "cloudsoft_emhk_repair_bak";

// Create connection to connect cloudsoft_emhk_repair
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");


$servername = "192.168.254.222";
$username = "root";
$password = "hksei24782332hk";
$dbname = "cloudsoft_emhk_repair2_bak";

/* $showTable = $conn->query("show tables;");

foreach ($showTable  as $key => $rs) {

    xdebug_var_dump($rs);
   
}


die();
 */



// Create connection connect cloudsoft_emhk_repair2
$conn2 = new mysqli($servername, $username, $password, $dbname);
$conn2->set_charset("utf8mb4");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>