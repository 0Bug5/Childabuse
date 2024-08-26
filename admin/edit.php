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
                                $query = $connection->prepare("select * from users where id = ?");
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
                                    <form action="edit-user.php" class="form" method="post">
                                        <div class="container-fluid">
                                            <div class="col-lg-12" id="response"></div>
                                            <div class="row justify-content-start align-items-start g-2">
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Full Name</label>
                                                        <input type="text" name="fullname" id="name" class="form-control form-control-md border-primary" required placeholder="Full Name" aria-label="Full Name" value="<?= $data['name'] ?>">
                                                        <div class="small text-danger" id="name-error"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control form-control-md border-primary" required placeholder="Email" aria-label="Email" value="<?= $data['email'] ?>">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="number" name="phone" id="phone" class="form-control form-control-md border-primary" required placeholder="phone" aria-label="Phone" value="<?= $data['phone'] ?>">
                                                        <div class="small text-danger" id="phone-error"></div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="gender" class="form-label">Gender</label>
                                                        <select class="form-control border-primary form-select-sm" name="gender" id="gender">
                                                            <option value="male">MALE</option>
                                                            <option value="female">FEMALE</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <input type="text" name="state" id="state" class="form-control form-control-md border-primary" required placeholder="State" aria-label="Phone" value="<?= $data['state'] ?>">
                                                        <div class="small text-danger" id="state-error"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" name="password" id="password" class="form-control form-control-md border-primary" required placeholder="Password" value="<?= $data['password'] ?>">
                                                        <div class="small text-danger" id="password-error"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address </label>
                                                        <textarea class="form-control form-control-md border-primary" name="address" id="address" required rows="3"><?= $data['address'] ?></textarea>
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
            var phoneRegex = /^0[789]0[0123456789]\d{7}$/;

            function validateName() {
                var nameInput = $('#name');
                var name = nameInput.val().trim();
                if (!name.match(/^[a-zA-Z\s]*$/)) {
                    nameInput.addClass('error-border');
                    $('#name-error').text('Please enter a valid name').show();
                    return false; // Invalid input
                } else {
                    nameInput.removeClass('error-border');
                    $('#name-error').hide();
                    return true; // Valid input
                }
            }

            function validatePhone() {
                var phoneInput = $('#phone');
                var phone = phoneInput.val().trim();
                if (!phone.match(phoneRegex)) {
                    phoneInput.addClass('error-border');
                    $('#phone-error').text('Please enter a valid phone number').show();
                    return false; // Invalid input
                } else {
                    phoneInput.removeClass('error-border');
                    $('#phone-error').hide();
                    return true; // Valid input
                }
            }

            $('#phone').on('keyup', function() {
                if (validatePhone()) {
                    enableSubmitButton();
                }
            });

            $('#name').on('keyup', function() {
                if (validateName()) {
                    enableSubmitButton(); // Enable submit button if input is valid
                }
            });

            function enableSubmitButton() {
                $('#submit').removeAttr('disabled');
            }

            $('form').submit(function(e) {
                e.preventDefault();
                var isNameValid = validateName();
                var isPhoneValid = validatePhone();

                if (!isNameValid || !isPhoneValid) {
                    $('#submit').attr('disabled', 'true');
                    return false;
                } else {
                    $.ajax({
                        type: "post",
                        url: "edit-user.php",
                        data: $(this).serialize(),
                        beforeSend: function() {
                            $('#submit').attr("disabled", "true")
                            $('#submit').text("");
                            $('#submit').html("<div class=\"d-flex justify-content-start align-items-start \"><div class=\"spinner-border text-primary spinner-border-sm \" role=\"status \"></div> <span class=\"mx-4\">Please wait</span></div>");
                        },
                        success: function(response) {
                            if (response == "200") {
                                Swal.fire({
                                    html: "Updted",
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
                }
            });
        });
    </script>
    </body>

    </html>