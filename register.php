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
    <title>Register</title>
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="index/assets/img/img5.png" />

    <script src="assets/jquery.js"></script>
    <script src="assets/sweetalert/script.js"></script>
    <style>
        body {
            background-image: url("index/assets/img/logo7.avif");
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body><br><br><br><br>
    <div class="container-fulid">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-5 bg-white shadow-sm p-3 m-3 rounded-sm grid-margin stretch-card">
                <form action="register-check.php" class="form" method="post">
                    <h4 class="card-title">Register</h4>
                    <hr>
                    <div class="container-fluid">
                        <div class="col-lg-12" id="response"></div>
                        <div class="row justify-content-start align-items-start g-2">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="fullname" id="name" class="form-control form-control-md border-danger" required placeholder="Full Name" aria-label="Full Name">
                                    <div class="small text-danger" id="name-error"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control form-control-md border-danger" required placeholder="Email" aria-label="Email">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="phone" id="phone" class="form-control form-control-md border-danger" required placeholder="phone" aria-label="Phone">
                                    <div class="small text-danger" id="phone-error"></div>
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-control border-danger form-select-sm" name="gender" id="gender">
                                        <option value="male">MALE</option>
                                        <option value="female">FEMALE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" name="state" id="state" class="form-control form-control-md border-danger" required placeholder="State" aria-label="Phone">
                                    <div class="small text-danger" id="state-error"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-md border-danger" required placeholder="Password">
                                    <div class="small text-danger" id="password-error"></div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address </label>
                                    <textarea class="form-control form-control-md border-danger" name="address" id="address" required rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <a href="index.html">Login</a>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-grid ">
                                    <button type="submit" id="submit" class="btn btn-danger">
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
                        url: "register-check.php",
                        data: $(this).serialize(),
                        beforeSend: function() {
                            $('#submit').attr("disabled", "true")
                            $('#submit').text("");
                            $('#submit').html("<div class=\"d-flex justify-content-start align-items-start \"><div class=\"spinner-border text-primary spinner-border-sm \" role=\"status \"></div> <span class=\"mx-4\">Please wait</span></div>");
                        },
                        success: function(response) {
                            if (response == "200") {
                                Swal.fire({
                                    html: "Registered with default password",
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