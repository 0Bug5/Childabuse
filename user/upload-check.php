<?php
require "include/session.php";
require "../database/connection.php";

if (!isset($_POST['title']) || !isset($_POST['body']) || empty($_POST['title']) || empty($_POST['body'])) {
    $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>All fields are required</strong></div>";
    exit($return);
} else {
    try {
        $title = $_POST['title'];
        $body = $_POST['body'];

        $query = $connection->prepare("insert into complaints(user_id, title, body) values(?,?,?)");
        $query->bind_param('iss', $myid, $title, $body);
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
