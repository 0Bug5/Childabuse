<?php
require "include/session.php";
require "../database/connection.php";

if (!isset($_POST['title']) || !isset($_POST['category']) || !isset($_POST['id']) || !isset($_POST['right']) || empty($_POST['title']) || empty($_POST['category']) || empty($_POST['right']) || empty($_POST['id'])) {
    $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>All fields are required</strong></div>";
    exit($return);
} else {
    try {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $right = $_POST['right'];

        $query = $connection->prepare("update rights set category = ?, title = ?, body = ? where id = ?");
        $query->bind_param('sssi', $category, $title, $right, $id);
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
