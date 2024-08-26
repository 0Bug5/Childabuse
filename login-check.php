<?php
session_start();
require "database/connection.php";
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    $response = "<div class=\"alert alert-danger\" role=\"alert\"><strong>All fields are required</strong></div>";
    exit($response);
} else {
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        $query = $connection->prepare('select * from users where email = ? and password = ?');
        $query->bind_param('ss', $email, $password);
        $query->execute();
        $query_result = $query->get_result();
        if ($query_result->num_rows > 0) {
            $data = $query_result->fetch_assoc();
            $_SESSION['id'] = $data['id'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['phone'] = $data['phone'];
            $_SESSION['role'] = $data['role'];

            exit("200");
        } else {
            $response = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Invalid details</strong></div>";
            exit($response);
        }
    } catch (Exception $e) {
        $response = "<div class=\"alert alert-danger\" role=\"alert\"><strong>try again</strong></div>";
        exit($response);
    }
}
