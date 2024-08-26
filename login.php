<?php
if (session_start()) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="index/assets/img/img5.png" />
    <style>
    body {
            background-image: url("index/assets/img/black3.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body><br><br><br><br><br><br>
    <div class="container-fluid mt-4">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card shadow-none">
                    <div class="card-body">
                        <form action="login-check.php" method="post">
                            <h4 class="card-title">Login</h4>
                            <hr>
                            <div id="response"></div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control form-control-lg border-danger" placeholder="Username" aria-label="Username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control form-control-lg border-danger" placeholder="Password" aria-label="Password">
                            </div>
                            <a href="register.php">Register here</a>
                            <div class="d-grid gap-2 mt-3">
                                <button type="submit" id="submit" class="btn btn-danger">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "login-check.php",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#submit').text("");
                        $('#submit').html("<div class=\"d-flex justify-content-start align-items-start \"><div class=\"spinner-border text-primary spinner-border-sm \" role=\"status \"></div> <span class=\"mx-4\">Please wait</span></div>");
                    },
                    success: function(response) {
                        if (response == 200) {
                            window.location.href = "middleware/gate.php"
                        } else {
                            $('#response').html(response);
                            $('#submit').text("Submit");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>