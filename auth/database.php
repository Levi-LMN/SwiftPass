<?php

$hostName = "sql202.infinityfree.com";
$dbUser = "if0_36081483";
$dbPassword = "t2rSHu9GREE";
$dbName = "if0_36081483_swiftpass";

// Establishing a connection to the database
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// Check for connection errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

// ... rest of your code ...

?>
