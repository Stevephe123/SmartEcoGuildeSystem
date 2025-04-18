<?php
// db.php
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

$Username = "PHPUser";
$Password = "meiyoupassword";  // Your password (change if needed)
$Localhost = "localhost";
$dbName = "dbcomment";

// Create database connection (without selecting database yet)
$Con = new mysqli($Localhost, $Username, $Password);

// Check connection
if ($Con->connect_errno) {
    echo "Connect failed: " . $Con->connect_error;
    exit();
}

// Create database if not exists
$Query = "CREATE DATABASE IF NOT EXISTS $dbName";
$Con->query($Query);

// Select the database
$Con->select_db($dbName);

// Create table if not exists
$TableSQL = "CREATE TABLE IF NOT EXISTS tblcomment (
    cmtId INT(8) PRIMARY KEY AUTO_INCREMENT,
    comment VARCHAR(255)
)";
$Con->query($TableSQL);
?>
