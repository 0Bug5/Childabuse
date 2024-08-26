<?php
session_start();
if (!isset($_SESSION["phone"]) || !isset($_SESSION["id"])  || !isset($_SESSION["role"]) || !isset($_SESSION["name"]) || !isset($_SESSION["email"]) || $_SESSION['role'] != "admin") {
    header("Location:../");
}
