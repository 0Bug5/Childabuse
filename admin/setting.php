<?php
require "include/_navbar.php";
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row justify-content-center align-items-center g-2">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Change Password</h4>
                            <hr>

                            <form action="change.php" class="form" method="post">
                                <div class="container-fluid">

                                    <div class="col-lg-12" id="response"></div>
                                    <div class="row justify-content-start align-items-start g-2">

                                        <div class="form-group col-lg-12">
                                            <label>Current Password</label>
                                            <input type="password" name="password1" class="form-control form-control-lg border-primary" placeholder="Current Password" required>
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>New Password</label>
                                            <input type="password" name="password2" class="form-control form-control-lg border-primary" placeholder="New Password" required>
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>New Password</label>
                                            <input type="password" name="password3" class="form-control form-control-lg border-primary" placeholder="Retype Password" required>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="d-grid ">
                                                <button type="submit" id="submit" class="btn btn-primary">
                                                    Submit
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        $(document).ready(function() {

            $('form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "change.php",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#submit').attr("disabled", "true")
                        $('#submit').text("");
                        $('#submit').html("<div class=\"d-flex justify-content-start align-items-start \"><div class=\"spinner-border text-primary spinner-border-sm \" role=\"status \"></div> <span class=\"mx-4\">Please wait</span></div>");
                    },
                    success: function(response) {
                        if (response == "200") {
                            Swal.fire({
                                html: "Password was changed",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "OK"
                            });
                        } else {
                            $('#response').html(response);
                        }
                        $('#submit').removeAttr("disabled");
                        $('#submit').text("Submit");
                    }
                });
            });
        });
    </script>
    </body>

    </html>