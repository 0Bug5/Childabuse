<?php
include "../database/connection.php";

if (!isset($_POST['fullname']) || !isset($_POST['password']) || !isset($_POST['phone']) || !isset($_POST['email']) || !isset($_POST['address']) || !isset($_POST['gender']) || !isset($_POST['state']) || !isset($_POST['id'])) {
    $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>All fields are required</strong></div>";
    exit($return);
} else {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    try {
        $query = $connection->prepare("update users set name = ?, email = ?, password = ?, phone = ?, gender = ?, state = ?, address = ? where id = ?");
        $query->bind_param('sssssssi', $fullname, $email, $password, $phone, $gender, $state, $address, $id);
        if ($query->execute()) {
            $return = "200";
            exit($return);
        } else {
            $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Please try again later</strong></div>";
            exit($return);
        }
    } catch (Exception $exception) {
        $return = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Error. Check database</strong></div>";
        exit($return);
    }
}
