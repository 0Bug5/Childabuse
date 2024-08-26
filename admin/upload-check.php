<?php
require "include/session.php";
require "../database/connection.php";

if (!isset($_POST['title']) || !isset($_POST['category']) || !isset($_POST['right']) || empty($_POST['title']) || empty($_POST['category']) || empty($_POST['right'])) {
    $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>All fields are required</strong></div>";
    exit($return);
} else {
    try {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $right = $_POST['right'];

        $query = $connection->prepare("insert into rights(category, title, body) values(?,?,?)");
        $query->bind_param('sss', $category, $title, $right);
        if ($query->execute()) {
            $return = "200";
            exit($return);
        } else {
            $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Please try again later</strong></div>";
            exit($return);
        }
    } catch (Exception $e) {
        $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Error occur</strong></div>";
        exit($return);
    }
}
