<?php
require "include/_navbar.php";


?>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12">
                <h5 class="h5 text-small">Your Right</h5>
                <div class="card">
                    <div class="table-responsive pt-3">
                        <table class="table table-striped project-orders-table">
                            <thead>
                                <tr>
                                    <th class="ml-5">Category</th>
                                    <th>Title</th>
                                    <th>Right</th>
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
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024. All rights reserved.</span>
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