<?php
require "include/_navbar.php";
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row justify-content-center align-items-center g-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Notification</h4>
                            <hr>

                            <form action="send-notification.php" class="form" method="post">
                                <div class="container-fluid">

                                    <p>Set Notification</p>

                                    <div class="col-lg-12" id="response"></div>
                                    <div class="row justify-content-start align-items-start g-2">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" id="name" class="form-control form-control-md border-primary" required placeholder="Notification Title">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="body" class="form-label">Body </label>
                                                <textarea class="form-control form-control-md border-primary" name="body" required rows="3"></textarea>
                                            </div>
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
                    url: "send-notification.php",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#submit').attr("disabled", "true")
                        $('#submit').text("");
                        $('#submit').html("<div class=\"d-flex justify-content-start align-items-start \"><div class=\"spinner-border text-primary spinner-border-sm \" role=\"status \"></div> <span class=\"mx-4\">Please wait</span></div>");
                    },
                    success: function(response) {
                        if (response == "200") {
                            Swal.fire({
                                html: "Notification was sent",
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