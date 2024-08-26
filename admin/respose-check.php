<?php
require "include/session.php";
require "../database/connection.php";

if (!isset($_POST['response']) || !isset($_POST['id']) || empty($_POST['response']) || empty($_POST['id'])) {
    $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>All fields are required</strong></div>";
    exit($return);
} else {
    try {
        $id = $_POST['id'];
        $response = $_POST['response'];

        $query = $connection->prepare("update complaints set response = ? where id = ?");
        $query->bind_param('si', $response, $id);
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
