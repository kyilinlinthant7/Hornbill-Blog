<?php
$host = 'localhost:3307';
$dbname = 'hornbill_blog';
$dbuser = 'root';
$dbpass = '';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);

if(!$conn) {
    echo "Database connection fail!";
}