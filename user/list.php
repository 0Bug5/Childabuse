<?php
require "include/_navbar.php";


?>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12">
                <h5 class="h5 text-small">People Complaint</h5>
                <div class="card">
                    <div class="table-responsive pt-3">
                        <table class="table table-striped project-orders-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Date</th>
                                    <th>View Respond</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="p-2">
                                <?php
                                $query = $connection->prepare("select * from complaints where user_id = ?");
                                $query->bind_param('i', $myid);
                                $query->execute();
                                $query_result = $query->get_result();
                                if ($query_result->num_rows < 1) {
                                ?>
                                    <div class="alert alert-danger m-2" role="alert">
                                        <strong>No complaint </strong>
                                    </div>
                                    <?php
                                } else {
                                    while ($u = $query_result->fetch_array()) {
                                    ?>
                                        <tr>
                                            <td><?= ucwords($u['title']) ?></td>
                                            <td><?= $u['body'] ?></td>
                                            <td><?= $u['created_at'] ?></td>
                                            <td><?php
                                            if($u['response'] == ""){
                                                echo "<span class=\"text-warning \">No response yet</span>";
                                            }else{
                                                echo $u['response'];
                                            }
                                            ?></td>
                                            <td>
                                                <a class="btn btn-danger btn-sm" href="delete_complaint.php?id=<?= $u['id'] ?>" role="button">delete</a>
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
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024. All right reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">INFORMATION SYSTEM FOR HUMAN RIHGT BASED ORGANISATION</span>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>
</div>
</body>

</html>