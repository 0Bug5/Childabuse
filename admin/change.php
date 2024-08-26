<?php
require "include/session.php";
require "../database/connection.php";

if (!isset($_POST['password1']) || !isset($_POST['password2']) || !isset($_POST['password3']) || empty($_POST['password1']) || empty($_POST['password2']) || empty($_POST['password3'])) {
    $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>All fields are required</strong></div>";
    exit($return);
} else {
    try {
        $pass1 = $_POST['password1'];
        $pass2 = $_POST['password2'];
        $pass3 = $_POST['password3'];
        $id = $_SESSION['id'];

        $select = $connection->prepare("SELECT password from users where id = ? and password = ?");
        $select->bind_param('is', $id, $pass1);
        $select->execute();
        $select_res = $select->get_result();
        if ($select_res->num_rows < 1) {
            $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Invalid Password</strong></div>";
            exit($return);
        } elseif ($pass2 != $pass3) {
            $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Password must matched</strong></div>";
            exit($return);
        } elseif (strlen($pass2) < 8) {
            $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Atleaset eight in length</strong></div>";
            exit($return);
        } else {
            $update = $connection->prepare("UPDATE users set password = ? where id = ?");

            $update->bind_param('si', $pass2, $id);
            $update->execute();
            if ($update) {
                $return = "200";
                exit($return);
            } else {
                $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Please try again later</strong></div>";
                exit($return);
            }
        }
    } catch (Exception $e) {
        $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Error occur</strong></div>";
        exit($return);
    }
}
