<?php
require "include/_navbar.php";


?>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12">
                <h5 class="h5 text-small">People Right</h5>
                <div class="card">
                    <div class="table-responsive pt-3">
                        <table class="table table-striped project-orders-table">
                            <thead>
                                <tr>
                                    <th class="ml-5">Category</th>
                                    <th>Title</th>
                                    <th>Abuse</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="p-2">
                                <?php
                                $query = $connection->prepare("select * from rights");
                                $query->execute();
                                $query_result = $query->get_result();
                                if ($query_result->num_rows < 1) {
                                ?>
                                    <div class="alert alert-danger m-2" role="alert">
                                        <strong>No rights </strong>
                                    </div>
                                    <?php
                                } else {
                                    while ($u = $query_result->fetch_array()) {
                                    ?>
                                        <tr>
                                            <td><?= ucwords($u['category']) ?></td>
                                            <td><?= ucwords($u['title']) ?></td>
                                            <td><?= $u['body'] ?></td>
                                            <td><?= $u['created_at'] ?></td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="edit_right.php?id=<?= $u['id'] ?>" role="button">edit</a>

                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-sm" href="delete_right.php?id=<?= $u['id'] ?>" role="button">delete</a>

                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <footer class="footer">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <? echo date('Y')?>. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">CHILD ABUSE REPORT MANAGEMENT SYSTEM</span>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>
</div>
</body>

</html>