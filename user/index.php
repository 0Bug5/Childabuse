<?php
require "include/_navbar.php";

$users = $connection->prepare("select * from users where role != ?");
$users->bind_param('s', $role);
$users->execute();
$users = $users->get_result();

$rights = $connection->prepare("select * from rights");
$rights->execute();
$rights = $rights->get_result();

$complaints = $connection->prepare("select * from complaints where user_id = ?");
$complaints->bind_param('i', $myid);
$complaints->execute();
$complaints = $complaints->get_result();
?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-xl-12 grid-margin stretch-card flex-column">
        <h5 class="mb-2 text-titlecase mb-4">Dashboard</h5>
        <div class="row">
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card bg-light ">
              <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <p class="mb-0 text-muted">Users</p>
                </div>
                <h4><?php echo $users->num_rows ?></h4>
                <canvas id="transactions-chart" class="mt-auto" height="65"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card bg-light ">
              <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <p class="mb-0 text-muted">My Complaints</p>
                </div>
                <h4><?php echo $complaints->num_rows ?></h4>
                <canvas id="transactions-chart" class="mt-auto" height="65"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card bg-light ">
              <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <p class="mb-0 text-muted">Abuse</p>
                </div>
                <h4><?php echo $rights->num_rows ?></h4>
                <canvas id="transactions-chart" class="mt-auto" height="65"></canvas>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h5 class="h5 text-small">Last Five Abuse Note</h5>
        <div class="card">
          <div class="table-responsive pt-3">
            <table class="table table-striped project-orders-table">
              <thead>
                <tr>
                  <th class="ml-5">Category</th>
                  <th>Title</th>
                  <th>Abuse</th>
                </tr>
              </thead>
              <tbody class="p-2">
                <?php
                $query = $connection->prepare("select * from rights order by id desc limit 5");
                $query->execute();
                $query_result = $query->get_result();
                if ($query_result->num_rows < 1) {
                ?>
                  <div class="alert alert-danger m-2" role="alert">
                    <strong>No Abuse </strong>
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
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date('Y');?>. All rights reserved.</span>
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