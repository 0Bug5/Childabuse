<?php
require "include/session.php";
require "../database/connection.php";
$myid = $_SESSION['id'];
$notification = $connection->prepare("select * from notifications order by id desc");
$notification->execute();
$notification_result = $notification->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CHILD ABUSE REPORT MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="../assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="../index/assets/img/img1.png" />

    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/template.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/sweetalert/script.js"></script>
</head>

<body>
    <div class="ro" id="proBanner">
        <div class="container-scroller">
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex justify-content-center">
                    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                        <a class="navbar-brand brand-logo text-white" href="index.php"><i class="typcn typcn-user text-white"></i>ADMIN</a>
                        <a class="navbar-brand brand-logo-mini" href="index.html"><i class="fa fa-building" aria-hidden="true"></i></a>
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                            <span class="typcn typcn-th-menu"></span>
                        </button>
                    </div>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <ul class="navbar-nav mr-lg-2">
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                                <i class="typcn typcn-user text-primary"></i>
                                <span class="nav-profile-name"><span style="font-size:25px; color:red; font-weight:bold;">Welcome</span> <?php echo $_SESSION['email'] ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="setting.php">
                                    <i class="typcn typcn-cog-outline text-primary"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="typcn typcn-eject text-primary"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-date dropdown">
                            <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
                                <h6 class="date mb-0">Today : <?php echo date("d D, M") ?></h6>
                                <i class="typcn typcn-calendar"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown mr-0">
                            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                                <i class="typcn typcn-bell mx-0"></i>
                                <span class="count"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                                <?php
                                if ($notification_result->num_rows > 0) {
                                    while ($n = $notification_result->fetch_assoc()) {
                                ?>
                                        <a class="dropdown-item preview-item">
                                            <div class="preview-thumbnail">
                                                <div class="preview-icon bg-success">
                                                    <i class="typcn typcn-info mx-0"></i>
                                                </div>
                                            </div>
                                            <div class="preview-item-content">
                                                <h6 class="preview-subject font-weight-normal">
                                                    <?php echo $n['title'] ?>
                                                </h6>
                                                <p class="font-weight-light small-text mb-0 text-muted">
                                                    <?php echo $n['body'] ?>
                                                </p>
                                            </div>
                                        </a>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <a class="dropdown-item preview-item py-3">
                                        <div class="preview-thumbnail">
                                            <i class="mdi mdi-alert m-auto text-primary"></i>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject fw-normal text-dark mb-1"><?= "No notification" ?></h6>
                                            <p class="fw-light small-text mb-0"><?= "notification will appear here" ?> </p>
                                        </div>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="typcn typcn-th-menu"></span>
                    </button>
                </div>
            </nav>
            <div class="container-fluid page-body-wrapper">
                <div class="theme-setting-wrapper">
                    <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
                    <div id="theme-settings" class="settings-panel">
                        <i class="settings-close typcn typcn-times"></i>
                        <p class="settings-heading">SIDEBAR SKINS</p>
                        <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                            <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                        </div>
                        <div class="sidebar-bg-options" id="sidebar-dark-theme">
                            <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                        </div>
                        <p class="settings-heading mt-2">HEADER SKINS</p>
                        <div class="color-tiles mx-0 px-4">
                            <div class="tiles success"></div>
                            <div class="tiles warning"></div>
                            <div class="tiles danger"></div>
                            <div class="tiles info"></div>
                            <div class="tiles dark"></div>
                            <div class="tiles default"></div>
                        </div>
                    </div>
                </div>
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <i class="typcn typcn-device-desktop menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-user" aria-expanded="false" aria-controls="ui-user">
                                <i class="typcn typcn-user menu-icon"></i>
                                <span class="menu-title">Users</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-user">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="users.php">Registered User</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-task" aria-expanded="false" aria-controls="ui-task">
                                <i class="typcn typcn-arrow-up menu-icon"></i>
                                <span class="menu-title">Child Abuse</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-task">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="upload.php">Upload Abuse</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-right" aria-expanded="false" aria-controls="ui-right">
                                <i class="typcn typcn-plus menu-icon"></i>
                                <span class="menu-title">Cases</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-right">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="right.php">Abuse Cases</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-complaint" aria-expanded="false" aria-controls="ui-complaint">
                                <i class="typcn typcn-arrow-down menu-icon"></i>
                                <span class="menu-title">Complaint</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-complaint">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" href="complaint.php">All Complaint</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="notification.php">
                                <i class="typcn typcn-message menu-icon"></i>
                                <span class="menu-title">Notice</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="setting.php">
                                <i class="typcn typcn-cog menu-icon"></i>
                                <span class="menu-title">Password</span>
                            </a>
                        </li>
                    </ul>
                </nav>