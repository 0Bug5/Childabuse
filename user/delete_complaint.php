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
        $id = $connection->real_escape_string($_GET['id']);
        $delete = $connection->prepare("delete from complaints where id = ? and user_id = ?");
        $delete->bind_param('ii', $id, $myid);
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
