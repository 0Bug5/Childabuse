<?php
require "include/_navbar.php";
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row justify-content-center align-items-center g-2 p-0">
            <div class="row p-0">
                <div class="col-lg-12 p-0">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Fight Against Child Abuse</h4>
                            <hr>
                            <form action="upload-check.php" class="form" method="post">
                                <div class="container-fluid">

                                    <div class="col-lg-12" id="response"></div>
                                    <div class="row justify-content-start align-items-start g-2">

                                        <div class="form-group col-lg-12">
                                            <label>Title</label>
                                            <input type="title" name="title" class="form-control form-control-lg border-primary" placeholder="Title" required>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="body" class="form-label">Description</label>
                                                <textarea class="form-control form-control-lg border-primary" name="body" id="body" rows="3" required placeholder="Write here"></textarea>
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
                    url: "upload-check.php",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#submit').attr("disabled", "true")
                        $('#submit').text("");
                        $('#submit').html("<div class=\"d-flex justify-content-start align-items-start \"><div class=\"spinner-border text-primary spinner-border-sm \" role=\"status \"></div> <span class=\"mx-4\">Please wait</span></div>");
                    },
                    success: function(response) {
                        if (response == "200") {
                            Swal.fire({
                                html: "Right information was uploaded",
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