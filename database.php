<?php

$serverName = "172.16.3.3";
$username = "root";
$password = "tpmroot";
$dbName = "tugas";

$connection = new mysqli($serverName, $username, $password, $dbName);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
echo "Connected successfully";

?>