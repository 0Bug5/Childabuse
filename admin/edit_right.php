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
                            <h4 class="card-title">Edit Details</h4>
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
                                $query = $connection->prepare("select * from rights where id = ?");
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
                                    <form action="edit-check.php" class="form" method="post">
                                        <div class="container-fluid">

                                            <div class="col-lg-12" id="response"></div>
                                            <div class="row justify-content-start align-items-start g-2">

                                            <input type="hidden" name="id" value="<?= $id ?>">
                                                <div class="form-group col-lg-12">
                                                    <label>Title</label>
                                                    <input type="title" name="title" class="form-control form-control-lg border-primary" placeholder="Title" value="<?= $data['category'] ?>" required>
                                                </div>

                                                <div class="col-lg-12 mb-3">
                                                    <label for="category" class="form-label">Category</label>
                                                    <select class="form-select form-select-lg form-control form-control-lg border-primary" name="category" id="category">
                                                        <option value="Civil">Civil</option>
                                                        <option value="Political">Political</option>
                                                        <option value="Social">Social</option>
                                                        <option value="Cultural">Cultural</option>
                                                        <option value="Environmental">Environmental</option>
                                                        <option value="Indigenous">Indigenous</option>
                                                        <option value="Women">Women</option>
                                                        <option value="Children">Children</option>
                                                        <option value="Education">Education</option>
                                                        <option value="Health">Health</option>
                                                        <option value="Speech">Speech</option>
                                                        <option value="Privacy">Privacy</option>
                                                        <option value="Labor">Labor</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="right" class="form-label">Right</label>
                                                        <textarea class="form-control form-control-lg border-primary" name="right" id="right" rows="3" required placeholder="Write here"><?= $data['body'] ?></textarea>
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
                    url: "edit-check.php",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#submit').attr("disabled", "true")
                        $('#submit').text("");
                        $('#submit').html("<div class=\"d-flex justify-content-start align-items-start \"><div class=\"spinner-border text-primary spinner-border-sm \" role=\"status \"></div> <span class=\"mx-4\">Please wait</span></div>");
                    },
                    success: function(response) {
                        if (response == "200") {
                            Swal.fire({
                                html: "Right information was edited",
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