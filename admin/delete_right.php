<?php
require "include/session.php";
require '../database/connection.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
?>
    <script>
        alert("Please check");
        history.back();
    </script>
    <?php
} else {
    try {
        $user_id = $connection->real_escape_string($_GET['id']);
        $delete = $connection->prepare("delete from rights where id = ?");
        $delete->bind_param('i', $user_id);
        $delete->execute();
    ?>
        <script>
            alert("Deleted!");
            history.back();
        </script>
    <?php

    } catch (Exception $e) {
    ?>
        <script>
            alert("Please try again later");
            history.back();
        </script>
<?php
    }
}
