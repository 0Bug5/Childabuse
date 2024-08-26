<?php
require "include/session.php";
include "../database/connection.php";

if (!isset($_POST['body']) || !isset($_POST['title'])) {
    $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>All fields are required</strong></div>";
    exit($return);
} else {
    $title = $_POST['title'];
    $body = $_POST['body'];

    try {

        $query = $connection->prepare("insert into notifications(title, body) values(?,?)");
        $query->bind_param('ss', $title, $body);
        if ($query->execute()) {
            $return = "200";
            exit($return);
        } else {
            $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Please try again later</strong></div>";
            exit($return);
        }
    } catch (Exception $exception) {
        $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Error. Check database</strong></div>";
        exit($connection->error);
    }
}
