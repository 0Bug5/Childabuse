<?php
session_start();
if (!isset($_SESSION["phone"]) || !isset($_SESSION["id"])  || !isset($_SESSION["role"]) || !isset($_SESSION["name"]) || !isset($_SESSION["email"])) {
    header("Location:../");
} else {
    $role = $_SESSION["role"];
    if ($role == "admin") {
        header("Location:../admin/");
    } else if ($role == "user") {
        header("Location:../user/");
    } else {
        header("Location:../");
    }
}
