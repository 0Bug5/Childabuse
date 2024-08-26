<?php
session_start();
if (!isset($_SESSION["phone"]) || !isset($_SESSION["id"])  || !isset($_SESSION["role"]) || !isset($_SESSION["name"]) || !isset($_SESSION["email"]) || $_SESSION['role'] != "user") {
    header("Location:../");
}
$myid = $_SESSION['id'];