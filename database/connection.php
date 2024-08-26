<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "human";

$connection = new mysqli($host, $user, $pass, $database);

if($connection->connect_errno)  {
    die("Error: ". $d->connect_error);
}