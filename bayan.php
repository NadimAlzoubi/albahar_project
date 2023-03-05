<!DOCTYPE html>
<html lang="en">
    <?php
    error_reporting(0);
 session_start();
	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: index.php');
		exit;
	}

    include('./conn.php'); 
?>
<?php
    // insert function
    function insertRow($table, $columns, $values, $the_file, $target_dir, $errore_msg) {
        include('./conn.php'); 
        $columnString = implode(",", $columns);
        $valueString = "'" . implode("','", $values) . "'";
        $query = "INSERT INTO $table ($columnString) VALUES ($valueString)";
        if($errore_msg == null){
            if (mysqli_query($connect, $query)) {
                move_uploaded_file($the_file, $target_dir);
                ?>
                    <script>
                        var pop_alert = document.getElementById("pop_alert");
                        pop_alert.style.display = "flex";
                        pop_alert.innerHTML = '<div class="custom-modal" id="hideAlert"><div class="succes succes-animation icon-top"><i class="fa fa-check"></i></div><div class="succes border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">تمت الإضافة بنجاح!</p><button id="alert_close_btn" class="btn btn-success" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                        var close_al = document.getElementById("alert_close_btn");
                        close_al.onclick = () => {
                            pop_alert.style.display = "none";
                        }
                       setTimeout (function(){window.location = window.location}, 1000);
                    </script>
                <?php
            }
            
        } else {
                ?>
                    <script>
                        var pop_alert = document.getElementById("pop_alert");
                        pop_alert.style.display = "flex";
                        pop_alert.innerHTML = '<div class="custom-modal" id="hideAlert"><div class="danger danger-animation icon-top"><i class="fa fa-times"></i></div><div class="danger border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">حدث خطأ ما!<br /><span class="type"><?php echo $errore_msg ?></span></p><button id="alert_close_btn" class="btn btn-danger" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                        var close_al = document.getElementById("alert_close_btn");
                        close_al.onclick = () => {
                            pop_alert.style.display = "none";
                        }
                        setTimeout (function(){window.location = window.location}, 2000);
                    </script>
                <?php
            }
        }
// Example usage
// insertRow("home", ["name", "age", "gender"], ["John", "20", "male"], '', '');
?>
<!-- *************************************************************************** -->
<!-- *************************************************************************** -->
<!-- ****      ********   *************      ************                   **** -->
<!-- ****   *   *******   ************   *   **************************   ****** -->
<!-- ****   **   ******   ***********   ***   ***********************   ******** -->
<!-- ****   ***   *****   **********   *****   ********************   ********** -->
<!-- ****   ****   ****   *********   *******   *****************   ************ -->
<!-- ****   *****   ***   ********               **************   ************** -->
<!-- ****   ******   **   *******   ***********   ***********   **************** -->
<!-- ****   *******   *   ******   *************   ********   ****************** -->
<!-- ****   ********      *****   ***************   *****                   **** -->
<!-- *************************************************************************** -->
<!-- *************************************************************************** -->
<?php
    // update function
function updateRow($table, $data, $the_file, $target_dir, $id, $old_file, $errore_msg) {
    include('./conn.php'); 
    $query = "UPDATE $table SET ";
    foreach ($data as $key => $value) {
        $query .= "$key = '$value',";
    }
    // Remove trailing comma
    $query = rtrim($query, ",");
    $query .= " WHERE ID = $id";
    if (mysqli_query($connect, $query)) {
        unlink("./declarations/" . $old_file);
        move_uploaded_file($the_file, $target_dir);
        ?>
            <script>
                var pop_alert = document.getElementById("pop_alert");
                pop_alert.style.display = "flex";
                pop_alert.innerHTML = '<div class="custom-modal"><div class="succes succes-animation icon-top"><i class="fa fa-check"></i></div><div class="succes border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">تم التعديل بنجاح!</p><button id="alert_close_btn" class="btn btn-success" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                var close_al = document.getElementById("alert_close_btn");
                close_al.onclick = () => {
                    pop_alert.style.display = "none";
                }
            </script>
        <?php
    }else{
        ?>
            <script>
                var pop_alert = document.getElementById("pop_alert");
                pop_alert.style.display = "flex";
                pop_alert.innerHTML = '<div class="custom-modal"><div class="danger danger-animation icon-top"><i class="fa fa-times"></i></div><div class="danger border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">حدث خطأ ما!<br /><span class="type"><?php echo $errore_msg ?></span></p><button id="alert_close_btn" class="btn btn-danger" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                var close_al = document.getElementById("alert_close_btn");
                close_al.onclick = () => {
                    pop_alert.style.display = "none";
                }
            </script>
        <?php
    }
}
// Example usage
// updateRow("users", ["name" => "John", "age" => 30, "location" => "New York"], '', '', $id);
?>
<!-- *************************************************************************** -->
<!-- *************************************************************************** -->
<!-- ****      ********   *************      ************                   **** -->
<!-- ****   *   *******   ************   *   **************************   ****** -->
<!-- ****   **   ******   ***********   ***   ***********************   ******** -->
<!-- ****   ***   *****   **********   *****   ********************   ********** -->
<!-- ****   ****   ****   *********   *******   *****************   ************ -->
<!-- ****   *****   ***   ********               **************   ************** -->
<!-- ****   ******   **   *******   ***********   ***********   **************** -->
<!-- ****   *******   *   ******   *************   ********   ****************** -->
<!-- ****   ********      *****   ***************   *****                   **** -->
<!-- *************************************************************************** -->
<!-- *************************************************************************** -->
<?php
    // delete function
    function deleteRow($table, $row_id, $file_name) {
        include('./conn.php');
        $query = "DELETE FROM " . $table . " WHERE ID = " . $row_id;
        if (mysqli_query($connect, $query)) {
            unlink("./declarations/" . $file_name);
            ?>
                <script>
                    var pop_alert = document.getElementById("pop_alert");
                    pop_alert.style.display = "flex";
                    pop_alert.innerHTML = '<div class="custom-modal"><div class="succes succes-animation icon-top"><i class="fa fa-check"></i></div><div class="succes border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">تم الحذف بنجاح!</p><button id="alert_close_btn" class="btn btn-success" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                    var close_al = document.getElementById("alert_close_btn");
                    close_al.onclick = () => {
                        pop_alert.style.display = "none";
                    }
                </script>
            <?php
        }else{
            ?>
                <script>
                    var pop_alert = document.getElementById("pop_alert");
                    pop_alert.style.display = "flex";
                    pop_alert.innerHTML = '<div class="custom-modal"><div class="danger danger-animation icon-top"><i class="fa fa-times"></i></div><div class="danger border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">حدث خطأ ما!</p><button id="alert_close_btn" class="btn btn-danger" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                    var close_al = document.getElementById("alert_close_btn");
                    close_al.onclick = () => {
                        pop_alert.style.display = "none";
                    }
                </script>
            <?php
        }
    }
// Example usage
//deleteRow("users", 3); // deletes the row with id 3 from the "users" table
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add bayan </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/bahar.jpg">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c71e41ff4a.js" crossorigin="anonymous"></script>
    <style>
    img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {display: none;}
        *{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
                    .succes {
                background-color: #4BB543;
              }
              .succes-animation {
                box-shadow: 0px 0px 30px 20px rgba(75, 181, 67, .4);
              }
              .danger {
                background-color: #CA0B00;
              }
              .danger-animation {
                box-shadow: 0px 0px 30px 20px rgba(202, 11, 0, .4);
              }
              .custom-modal {
                z-index: 99999999;
                position: absolute;
                width: 350px;
                min-height: 250px;
                background-color: #fff;
                border-radius: 30px;
                margin: 40px 10px;
                animation: succes-div 0.4s ease-out;
              }
              .custom-modal .content { 
                position: absolute;
                width: 100%;
                text-align: center;
                bottom: 0;
              }
              .custom-modal .content .type {
                font-size: 18px;
                color: #999;
              }
              .custom-modal .content .message-type {
                font-size: 24px;
                color: #000;
              }
              .custom-modal .border-bottom {
                position: absolute;
                width: 300px;
                height: 20px;
                border-radius: 0 0 30px 30px;
                bottom: -20px;
                margin: 0 25px;
              }
              .custom-modal .icon-top {
                position: absolute;
                width: 100px;
                height: 100px;
                border-radius: 50%;
                top: -30px;
                margin: 0 125px;
                font-size: 30px;
                color: #fff;
                line-height: 100px;
                text-align: center;
              }
              .page-wrapper-alt {
                position: fixed;
                height: 100vh;
                background-color: #111;
                display: none;
                align-items: center;
                justify-content: center;
                padding: 80px 0;
                width: 100%;
                z-index: 99999;
                opacity: 0.8;
              }
              @keyframes succes-div { 
                0% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
              }
    </style>

</head>
<div class="page-wrapper-alt" id="pop_alert">
</div>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.php" class="brand-logo">
                <img class="logo-abbr" src="./images/bahar.jpg" alt="" style="border-radius: 50%; margin-right: 1rem">
                <span>البحار للملاحة الدولية</span>
            </a>

            <div class="nav-control" style="display: none;">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <!-- <div class="search_bar dropdown"> -->
                                <!-- <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span> -->
                                <!-- <div class="dropdown-menu p-0 m-0"> -->
                                <a href="./emp_table.php" class="btn btn-primary"><i class="fa-solid fa-right-to-bracket"></i> &nbsp; عودة إلى التفاويض</a>
                                <a href="./edit_req.php" style="margin-left: 1rem" class="btn btn-primary text-white"><i class="fa-regular fa-pen-to-square"></i> طلب تعديل</a>
                     
                                <!-- </div> -->
                            <!-- </div> -->
                        </div>

                        <ul class="navbar-nav header-right">
                            <!-- <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li> -->
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./login.php" class="dropdown-item">
                                        <i class="fa-solid fa-right-to-bracket"></i>
                                        <span class="ml-2">تسجيل دخول المسؤول </span>
                                    </a>
                                    <a href="./logout_emp.php" class="dropdown-item">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        <span class="ml-2">تسجيل خروج الموظف </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->




        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav" style="display: none;">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">القائمة الرئيسية</li>
                    <li><a class="has-arrow" href="./index.html"><i
                                class="icon icon-single-04"></i><span class="nav-text">لوحة التحكم</span></a>
                        <!-- <ul aria-expanded="false">
                            <li><a href="./index.html">الصفحة الرئيسية</a></li>
                            <li><a href="./index2.html">Dashboard 2</a></li>
                        </ul> -->
                    </li>
                    <!-- <li class="nav-label">Apps</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Apps</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./app-profile.html">Profile</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                                <ul aria-expanded="false">
                                    <li><a href="./email-compose.html">Compose</a></li>
                                    <li><a href="./email-inbox.html">Inbox</a></li>
                                    <li><a href="./email-read.html">Read</a></li>
                                </ul>
                            </li>
                            <li><a href="./app-calender.html">Calendar</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-chart-bar-33"></i><span class="nav-text">Charts</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./chart-flot.html">Flot</a></li>
                            <li><a href="./chart-morris.html">Morris</a></li>
                            <li><a href="./chart-chartjs.html">Chartjs</a></li>
                            <li><a href="./chart-chartist.html">Chartist</a></li>
                            <li><a href="./chart-sparkline.html">Sparkline</a></li>
                            <li><a href="./chart-peity.html">Peity</a></li>
                        </ul>
                    </li> -->
                <!-- <li class="nav-label">Components</li>
                     <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-world-2"></i><span class="nav-text">Bootstrap</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./ui-accordion.html">Accordion</a></li>
                            <li><a href="./ui-alert.html">Alert</a></li>
                            <li><a href="./ui-badge.html">Badge</a></li>
                            <li><a href="./ui-button.html">Button</a></li>
                            <li><a href="./ui-modal.html">Modal</a></li>
                            <li><a href="./ui-button-group.html">Button Group</a></li>
                            <li><a href="./ui-list-group.html">List Group</a></li>
                            <li><a href="./ui-media-object.html">Media Object</a></li>
                            <li><a href="./ui-card.html">Cards</a></li>
                            <li><a href="./ui-carousel.html">Carousel</a></li>
                            <li><a href="./ui-dropdown.html">Dropdown</a></li>
                            <li><a href="./ui-popover.html">Popover</a></li>
                            <li><a href="./ui-progressbar.html">Progressbar</a></li>
                            <li><a href="./ui-tab.html">Tab</a></li>
                            <li><a href="./ui-typography.html">Typography</a></li>
                            <li><a href="./ui-pagination.html">Pagination</a></li>
                            <li><a href="./ui-grid.html">Grid</a></li>

                        </ul>
                    </li>

                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-plug"></i><span class="nav-text">Plugins</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./uc-select2.html">Select 2</a></li>
                            <li><a href="./uc-nestable.html">Nestedable</a></li>
                            <li><a href="./uc-noui-slider.html">Noui Slider</a></li>
                            <li><a href="./uc-sweetalert.html">Sweet Alert</a></li>
                            <li><a href="./uc-toastr.html">Toastr</a></li>
                            <li><a href="./map-jqvmap.html">Jqv Map</a></li>
                        </ul>
                    </li>
                    <li><a href="widget-basic.html" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                                class="nav-text">Widget</span></a></li>
                    <li class="nav-label">Forms</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-form"></i><span class="nav-text">Forms</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./form-element.html">Form Elements</a></li>
                            <li><a href="./form-wizard.html">Wizard</a></li>
                            <li><a href="./form-editor-summernote.html">Summernote</a></li>
                            <li><a href="form-pickers.html">Pickers</a></li>
                            <li><a href="form-validation-jquery.html">Jquery Validate</a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="nav-label">جدول التفاويض</li> -->
                    <li><a class="has-arrow mm-active" href="./table-datatable-basic.html"><i
                                class="icon icon-layout-25"></i><span class="nav-text">التفاويض</span></a>
                        <!-- <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                            <li><a href="table-datatable-basic.html">Datatable</a></li>
                        </ul> -->
                    </li>

                    <!-- <li class="nav-label">Extra</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-copy-06"></i><span class="nav-text">Pages</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./page-register.html">Register</a></li>
                            <li><a href="./page-login.html">Login</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                                <ul aria-expanded="false">
                                    <li><a href="./page-error-400.html">Error 400</a></li>
                                    <li><a href="./page-error-403.html">Error 403</a></li>
                                    <li><a href="./page-error-404.html">Error 404</a></li>
                                    <li><a href="./page-error-500.html">Error 500</a></li>
                                    <li><a href="./page-error-503.html">Error 503</a></li>
                                </ul>
                            </li>
                            <li><a href="./page-lock-screen.html">Lock Screen</a></li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->




<style>
input[type="search"] {
    margin-right: 0.6rem;
    width: 300px;
}
.form-control{
    border: 1px solid #8d8be747 !important;
}
</style>



        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" style="margin-left: 0">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-12 p-md-0">
                        <div class="welcome-text d-flex" dir="rtl">
                            <form method="POST" class="card-title text-danger text-center shadow rounded d-flex justify-content-around align-items-center" style="padding: 1rem; margin: 0 auto;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="search" class="form-control" name="bayan_search" id="bayan_search" placeholder="ابحث هنا عن بيان ..." />
                            </form>
                        </div>
                    </div>
                </div>
            <!-- row -->
            
            
            
            
            
            
            <div class="row container-fluid shadow rounded" dir="rtl" style="margin-bottom: 2rem">
            <?php
                $search_to_show = $_POST['bayan_search'];
                if(isset($search_to_show)){
             ?>
            <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; align-items: center; justify-content: space-around;">
                                <h4 class="card-title">نتيجة البحث عن: "<?php echo $search_to_show; ?>" <i class="fa-solid fa-magnifying-glass"></i></h4>
                                <h4 class="card-title"><a class="text-danger" href="./bayan.php">انقر هنا لإغلاق البحث <i class="fa-solid fa-xmark"></i></a></h4>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table id="example2" class="display" style="min-width: 845px; color: #000;">
                                        <thead>
                                             <tr style="text-align: center;">
                                                <th style="max-width: fit-content;">م</th> 
                                                <th>رقم البيان</th>
                                                <th>رقم المعاملة</th>
                                                <th>نوع البيان</th>
                                                <th>البيان</th>
                                                <th>التاريخ</th>
                                            </tr>
                                        </thead>
                                        <style>
                                            .dataTables_scrollHeadInner, .dataTables_scrollHead, .dataTables_scrollHead table, .dataTables_scrollFoot, .dataTables_scrollFootInner, .dataTables_scrollFootInner table{
                                                width: 100% !important;
                                            }
                                        </style>
                                        <tbody id="tableBody">
                                        <?php

                                           $sql_s = "SELECT * FROM bayan WHERE 
                                           ID LIKE '%$search_to_show%' OR 
                                           BAYAN_NUM LIKE '%$search_to_show%' OR 
                                           TRANSACTION_NUM LIKE '%$search_to_show%' OR
                                           BAYAN_TYPE LIKE '%$search_to_show%' OR
                                           BAYAN_DATE LIKE '%$search_to_show%'
                                           ";
                                        
                                        $result = mysqli_query($connect, $sql_s);
                                           if(isset($result)){
                                               $count = 1;
                                               while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                            <tr style="text-align: center;">
                                                <?php
                                                    echo '<td>' . $count++ . '</td>';
                                                    if($row['BAYAN_NUM'] != null){echo '<td>' . $row['BAYAN_NUM'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['TRANSACTION_NUM'] != null){echo '<td>' . $row['TRANSACTION_NUM'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['BAYAN_TYPE'] != null){echo '<td>' . $row['BAYAN_TYPE'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['BAYAN_FILE'] != null){echo '<td><a href="./declarations/' . $row['BAYAN_FILE'] . '" class="btn shadow rounded text-dark" style="margin-left: 0.3rem;" download><i class="fa-solid fa-download"></i> </a><a href="./declarations/' . $row['BAYAN_FILE'] . '" class="btn shadow rounded text-dark" style="margin-right: 0.3rem;" target="_blank"> <i class="fa-solid fa-eye"></i></a></td>';} else {echo '<td>-</td>';}  
                                                    if($row['BAYAN_DATE'] != null){echo '<td>' . $row['BAYAN_DATE'] . '</td>';} else {echo '<td>-</td>';}  
                                                ?>
                                            </tr>
                                            <?php
                                                }
                                           }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="text-align: center;">
                                                <th style="max-width: fit-content;">م</th> 
                                                <th>رقم البيان</th>
                                                <th>رقم المعاملة</th>
                                                <th>نوع البيان</th>
                                                <th>البيان</th>
                                                <th>التاريخ</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


        <?php   
    }
?>
</div>

            
            
            
            
            
            
            
            
            
            

<!-- //////////////جدول البيبانتات ////////  -->

<div class="row" dir="rtl">
    <div class="col-12">
        <div class="card shadow rounded">
            <div class="card-header">
                <h4 class="card-title">إضافة بيان</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-dark">رقم البيان</label>
                            <div class="col-md-4 col-sm-10">
                                <input type="number" class="form-control" name="bayan_number" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-dark">رقم المعاملة</label>
                            <div class="col-md-4 col-sm-10">
                                <input type="number" id="tra_num" class="form-control" name="transaction_number" required placeholder="8 خانات الحد الأدنى">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-dark">نوع البيان</label>
                            <div class="col-md-4 col-sm-10">
                                <select class="form-control form-select" name="bayan_type" required>
                                  <option value="">--اختر--</option>
                                  <option value="E">تصدير - E</option>
                                  <option value="I">استيراد - I</option>
                                  <option value="N">ادخال مؤقت - N</option>
                                  <option value="O">ترانزيت خروج - O</option>
                                  <option value="R">اعادة تصدير - R</option>
                                  <option value="T">ترانزيت دخول - T</option>
                                  <option value="Makasa-Re">اعادة تصدير المقاصة</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-dark">اختر البيان</label>
                            <div class="col-md-4 col-sm-10">
                                <input type="file" class="form-control" name="bayan_file" required id="file-input">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-dark">اختيار تاريخ مخصص</label>
                            <div class="col-md-4 col-sm-10" style="display: flex; align-items: center;">
                                <input type="checkbox" id="check_for_date" onClick="date_click()">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-dark"></label>
                            <div class="col-md-4 col-sm-10">
                                <input type="date" class="form-control" name="manual_date" id="bayan_date" disabled style="color: #ccc">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-1 col-md-3">
                                <input type="submit" id="send_bayan_btn" class="btn btn-primary" value="حفظ" name="save_bayan" disabled>
                            </div>
                        </div>
                    
                        <!-- <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>






        <script>

            //////////////choose custom date /////////
            
            var check_for_date = document.getElementById("check_for_date");
            var bayan_date = document.getElementById("bayan_date");
            function date_click(){
                if(bayan_date.disabled == true){
                    bayan_date.disabled = false;
                    bayan_date.style.color = "#111";
                } else {
                    bayan_date.disabled = true;
                    bayan_date.style.color = "#ccc";
                }
            }
            
            var send_bayan_btn = document.getElementById("send_bayan_btn");
            var tra_num = document.getElementById("tra_num");
            tra_num.oninput = () => {
                if (tra_num.value.length >= 8){
                    send_bayan_btn.disabled = false;
                } else {
                    send_bayan_btn.disabled = true;
                }
            }
            
            
            ////////////////////// drag and drop //////////////
            
            var fileInput = document.getElementById('file-input');

            fileInput.addEventListener('change', function(e) {
              // Handle selected files here
            });
            
            document.addEventListener('dragover', function(e) {
              e.preventDefault();
              e.dataTransfer.dropEffect = 'copy';
            });
            
            document.addEventListener('drop', function(e) {
              e.preventDefault();
              fileInput.files = e.dataTransfer.files;
              // Handle dropped files here
            });

            
        </script>





        <div class="card shadow rounded">
            <div class="card-header" style="display: flex; align-items: center; justify-content: space-around;">
                <h4 class="card-title">آخر 200 بيان تمت إضافته</h4>
                <h6 class="card-title">
                    <?php
                        $sql = "SELECT ID from bayan";
                        if ($result = mysqli_query($connect, $sql)) {
                        $rowcount = mysqli_num_rows( $result );
                        echo 'عدد البيانات الكلي "' .  $rowcount . '"';
                        }
                    ?>
                </h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px; color: #000;">
                        <thead>
                            <tr style="text-align: center;">
                                <th style="max-width: fit-content;">م</th> 
                                <th>رقم البيان</th>
                                <th>رقم المعاملة</th>
                                <th>نوع البيان</th>
                                <th>البيان</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        <?php
                           $sql_s = 'SELECT * FROM bayan ORDER BY TRANSACTION_NUM DESC LIMIT 200';
                           $result = mysqli_query($connect, $sql_s);
                           if(isset($result)){
                               $count = 1;
                               while($row = mysqli_fetch_assoc($result)){
                        ?>
                            <tr style="text-align: center;">
                                <?php
                                    echo '<td>' . $count++ . '</td>';
                                    if($row['BAYAN_NUM'] != null){echo '<td>' . $row['BAYAN_NUM'] . '</td>';} else {echo '<td>-</td>';}  
                                    if($row['TRANSACTION_NUM'] != null){echo '<td>' . $row['TRANSACTION_NUM'] . '</td>';} else {echo '<td>-</td>';}  
                                    if($row['BAYAN_TYPE'] != null){echo '<td style="font-size: x-large; font-weight: bold;">' . $row['BAYAN_TYPE'] . '</td>';} else {echo '<td>-</td>';}  
                                    if($row['BAYAN_FILE'] != null){echo '<td><a href="./declarations/' . $row['BAYAN_FILE'] . '" class="btn shadow rounded text-dark" style="margin-left: 0.3rem;" download><i class="fa-solid fa-download"></i> </a><a href="./declarations/' . $row['BAYAN_FILE'] . '" class="btn shadow rounded text-dark" style="margin-right: 0.3rem;" target="_blank"> <i class="fa-solid fa-eye"></i></a></td>';} else {echo '<td>-</td>';}  
                                    if($row['BAYAN_DATE'] != null){echo '<td>' . $row['BAYAN_DATE'] . '</td>';} else {echo '<td>-</td>';}  
                                ?>
                            </tr>
                            <?php
                           }
                           }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr style="text-align: center;">
                                <th style="max-width: fit-content;">م</th> 
                                <th>رقم البيان</th>
                                <th>رقم المعاملة</th>
                                <th>نوع البيان</th>
                                <th>البيان</th>
                                <th>التاريخ</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    





</div>






            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
<!-- /////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////  الاضافة  ///////////////// /////// -->
<!-- /////////////////////////////////////////////////////////////////// -->
<?php
      $save_bayan = $_POST['save_bayan'];
      if(isset($save_bayan)){
        $bayan_number = $_POST['bayan_number'];
        $transaction_number = $_POST['transaction_number'];
        $bayan_type = $_POST['bayan_type'];
        
        $manual_date = $_POST['manual_date'];
        $date_new = date("d-m-Y");

        if(empty($manual_date)){
            $bayan_date = $date_new; 
        } else {
            $new_format = date("d-m-Y", strtotime($manual_date));
            $bayan_date = $new_format;
        }

        $file_name = $_FILES['bayan_file']['name'];
    
        $allowed_extensions = array('pdf');
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

        if(!empty($file_name)){
            if(strlen(pathinfo($_FILES['bayan_file']['name'], PATHINFO_EXTENSION)) == 3 && in_array($file_extension, $allowed_extensions)){
                $new_text = substr($file_name, 0, -4);
                $newName = time();    
                // get file extension
                $extension = pathinfo($_FILES['bayan_file']['name'], PATHINFO_EXTENSION);
                // create new file name with extension
                $newFileName = $newName . '.' . $extension;
                $the_file = $_FILES['bayan_file']['tmp_name'];
                $target_dir = "./declarations/" . $newFileName;
            } else {
                $errore_msg = "يرجى اختيار ملف PDF!";
            }
            
        }
    
       // if(strpos($newFileName, "'") >= 0){
        //    $errore_msg = "file name contains quotes";
    //    }
        insertRow("bayan", ["BAYAN_NUM", "TRANSACTION_NUM", "BAYAN_TYPE", "BAYAN_FILE", "BAYAN_DATE"], [$bayan_number, $transaction_number, $bayan_type, $newFileName, $bayan_date], $the_file, $target_dir, $errore_msg);
      }
?>


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#">Nadim Al-Zoubi</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    


    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

</body>

</html>