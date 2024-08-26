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
                            <h4 class="card-title">Send Responde</h4>
                            <hr>
                            <?php
                            if (!isset($_GET['id']) || empty($_GET['id'])) {
                            ?>
                                <div class="alert alert-danger p-3" role="alert">
                                    <strong>Invalid selection</strong>
                                </div>
                                <?php
                            } else {
                                $id = $_GET['id'];
                                $query = $connection->prepare("select * from complaints where id = ?");
                                $query->bind_param('i', $id);
                                $query->execute();

                                $result = $query->get_result();
                                if ($result->num_rows < 1) {
                                    ?>
                                <div class="alert alert-danger p-3" role="alert">
                                    <strong>Not found</strong>
                                </div>
                                <?php
                                } else {
                                    $data = $result->fetch_array();
                                ?>
                                    <form action="respose-check.php" class="form" method="post">
                                        <div class="container-fluid">

                                            <div class="col-lg-12" id="response"></div>
                                            <div class="row justify-content-start align-items-start g-2">

                                            <input type="hidden" name="id" value="<?= $id ?>">
                                                

                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="response" class="form-label">Response Text</label>
                                                        <textarea class="form-control form-control-lg border-primary" name="response" id="response" rows="3" required placeholder="Write here"></textarea>
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
                            <?php

                                }
                            }
                            ?>
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
                    url: "respose-check.php",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#submit').attr("disabled", "true")
                        $('#submit').text("");
                        $('#submit').html("<div class=\"d-flex justify-content-start align-items-start \"><div class=\"spinner-border text-primary spinner-border-sm \" role=\"status \"></div> <span class=\"mx-4\">Please wait</span></div>");
                    },
                    success: function(response) {
                        if (response == "200") {
                            Swal.fire({
                                html: "Right information was resposeed",
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