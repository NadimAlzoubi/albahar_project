<?php
error_reporting(0);
	// Initialize session
	session_start();

	if (!isset($_SESSION['loggedin_admin']) && $_SESSION['loggedin_admin'] !== false) {
		header('location: login.php');
		exit;
	}
		function check_session_timeout() {
  if (isset($_SESSION['last_active'])) {
    if (time() - $_SESSION['last_active'] > 900) {
      session_destroy();
      header("Location: login.php");
      exit();
    }
  }
}
check_session_timeout();

$_SESSION['last_active'] = time();

?>
<?php
    include('./conn.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<?php
    // insert function
    function insertRow($table, $columns, $values, $the_file, $target_dir, $errore_msg) {
        include('./conn.php'); 
        $columnString = implode(",", $columns);
        $valueString = "'" . implode("','", $values) . "'";
        $query = "INSERT INTO $table ($columnString) VALUES ($valueString)";
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
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        var pop_alert = document.getElementById("pop_alert");
                        pop_alert.style.display = "flex";
                        pop_alert.innerHTML = '<div class="custom-modal" id="hideAlert"><div class="danger danger-animation icon-top"><i class="fa fa-times"></i></div><div class="danger border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">حدث خطأ ما!<br /><span class="type"><?php echo $errore_msg ?></span></p><button id="alert_close_btn" class="btn btn-danger" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                        var close_al = document.getElementById("alert_close_btn");
                        close_al.onclick = () => {
                            pop_alert.style.display = "none";
                        }
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
        unlink("./authorization/" . $old_file);
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
            unlink("./authorization/" . $file_name);
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
    <title>Authorization Admin </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/bahar.jpg">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c71e41ff4a.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
            <a href="dash_admin.php" class="brand-logo">
            <img class="logo-abbr" src="./images/bahar.jpg" alt="" style="border-radius: 50%;">
                <span id="logo-name" style="margin-left: 1rem">البحار للملاحة الدولية</span>
            </a>

            <div id="side-navbar-1" class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
        <script>
    var nav1 = document.getElementById("side-navbar-1")
    var logo1 = document.getElementById("logo-name")
    nav1.onclick = () => {
        logo1.classList.toggle("hide-logo-1");
    }
</script>
<style>
    .hide-logo-1 {
        display: none;
}
</style>

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form action="./table-datatable-basic.php" method="POST">
                                        <input dir="rtl" class="form-control" name="search_to_show" type="search" placeholder="ابحث هنا عن تفويض ..." aria-label="Search">
                                    </form>
                                </div>
                            </div>
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
                                <a href="./logout.php" class="dropdown-item">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                        <span class="ml-2">تسجيل الخروج </span>
                                    </a>
                                    <a href="./settings.php" class="dropdown-item">
                                        <!-- <i class="icon-edit-72"></i> -->
                                        <i class="fa-solid fa-gear"></i>
                                        <span class="ml-2">الإعدادات </span>
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
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">القائمة الرئيسية</li>
                    <li><a class="has-arrow" href="./dash_admin.php">
                        <i class="fa-solid fa-house"></i><span class="nav-text">الصفحة الرئيسية </span></a>
                        <!-- <ul aria-expanded="false">
                            <li><a href="./dash_admin.html">الصفحة الرئيسية</a></li>
                            <li><a href="./dash_admin2.html">Dashboard 2</a></li>
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
                    <li><a class="has-arrow mm-active" href="./table-datatable-basic.php">
                        <i class="fa-solid fa-table"></i><span class="nav-text">التفاويض </span></a>
                        <!-- <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                            <li><a href="table-datatable-basic.html">Datatable</a></li>
                        </ul> -->
                    </li>
                    <li><a class="has-arrow" href="./bayan_admin.php">
                        <i class="fa-solid fa-box-archive"></i><span class="nav-text">البيانات </span></a>
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







        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <!-- <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <span class="ml-1">Datatable</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                        </ol>
                    </div>
                </div> -->
                <!-- row -->



<div class="row" dir="rtl">
<?php
    $search_to_show = $_POST['search_to_show'];
    if(isset($search_to_show)){
 ?>
<div class="col-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; align-items: center; justify-content: space-around;">
                                <h4 class="card-title">نتيجة البحث عن: "<?php echo $search_to_show; ?>" <i class="fa-solid fa-magnifying-glass"></i></h4>
                                <h4 class="card-title"><a class="text-danger" href="./table-datatable-basic.php">انقر هنا لإغلاق البحث <i class="fa-solid fa-xmark"></i></a></h4>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table id="example2" class="display" style="min-width: 845px; color: #000;">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th style="max-width: fit-content;">م</th> 
                                                <th>الاسم بالعربية</th>
                                                <th>الاسم بالأنكليزية</th>
                                                <th>رقم التسجيل</th>
                                                <th>رمز العميل</th>
                                                <th>التفويض</th>
                                                <th>صندوق البريد</th>
                                                <th>التاريخ</th>
                                                <th>اسم_م_ت</th>
                                                <th>اجراءات</th>
                                            </tr>
                                        </thead>
                                        <style>
                                            .dataTables_scrollHeadInner, .dataTables_scrollHead, .dataTables_scrollHead table, .dataTables_scrollFoot, .dataTables_scrollFootInner, .dataTables_scrollFootInner table{
                                                width: 100% !important;
                                            }
                                        </style>
                                        <tbody id="tableBody">
                                        <?php

                                           $sql_s = "SELECT * FROM auth_bahar WHERE 
                                           ID LIKE '%$search_to_show%' OR 
                                           AR_NAME LIKE '%$search_to_show%' OR 
                                           EN_NAME LIKE '%$search_to_show%' OR
                                           REG_NUM LIKE '%$search_to_show%' OR
                                           CLIENT_CODE LIKE '%$search_to_show%' OR
                                           MAIL_BOX LIKE '%$search_to_show%' OR
                                           DATE_ LIKE '%$search_to_show%' OR
                                           PERSON_NAME LIKE '%$search_to_show%'
                                           ";
                                        
                                        $result = mysqli_query($connect, $sql_s);
                                           if(isset($result)){
                                               $count = 1;
                                               while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                            <tr style="text-align: center;">
                                                <?php
                                                    echo '<td>' . $count++ . '</td>';
                                                    if($row['AR_NAME'] != null){echo '<td>' . $row['AR_NAME'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['EN_NAME'] != null){echo '<td>' . $row['EN_NAME'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['REG_NUM'] != null){echo '<td>' . $row['REG_NUM'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['CLIENT_CODE'] != null){echo '<td>' . $row['CLIENT_CODE'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['AUTH_FILE'] != null){echo '<td><a href="./authorization/' . $row['AUTH_FILE'] . '" style="color: brown; font-size: 1.5em;" title="Download" download><i class="fa-solid fa-download"></i> </a><a href="./authorization/' . $row['AUTH_FILE'] . '" style="color: brown; font-size: 1.5em;" target="_blank" title="View"> <i class="fa-solid fa-eye"></i></a></td>';} else {echo '<td>-</td>';}  
                                                    if($row['MAIL_BOX'] != null){echo '<td>' . $row['MAIL_BOX'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['DATE_'] != null){echo '<td>' . $row['DATE_'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['PERSON_NAME'] != null){echo '<td>' . $row['PERSON_NAME'] . '</td>';} else {echo '<td>-</td>';}  
                                                ?>
                                                <td>
                                                <div style="display: flex; align-items:center; justify-content:space-between; gap:1.5rem">
                                                    <form action="./edit_auth.php" enctype="multipart/form-data" method="POST">
                                                        <button value="<?php echo $row['ID']; ?>" type="submit" id="editButton" name="edit_btn" style="border: 1px solid #FFAA16; border-radius: 3px; font-size: larger; background-color: #fff; padding: 0 5px;" title="Edit"><i class="fa fa-pencil text-warning"></i></button>
                                                        <!-- <button type="submit" name="dele_btn" style="border: 1px solid red; border-radius: 3px; font-size: larger; background-color: #fff; padding: 0 5px;" title="Delete"><i class="fa fa-trash-o text-danger"></i></button> -->
                                                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                                        <input type="hidden" name="file_name" value="<?php echo $row['AUTH_FILE']; ?>">
                                                    </form>
                                                    <button class="delete" data-oldfile="<?php echo $row['AUTH_FILE']; ?>" data-id="<?php echo $row['ID']; ?>" id="del_<?php echo $row['ID']; ?>" data-name="dele_btn" style="border: 1px solid red; border-radius: 3px; font-size: larger; background-color: #fff; padding: 0 5px;" title="Delete"><i class="fa fa-trash-o text-danger"></i></button>
                                                </div>
                                                </td>
                                            </tr>
                                            <?php
                                           }
                                           }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="text-align: center;">
                                                <th style="max-width: fit-content;">م</th> 
                                                <th>الاسم_بالعربية</th>
                                                <th>الاسم_بالأنكليزية</th>
                                                <th>رقم_التسجيل</th>
                                                <th>رمز_العميل</th>
                                                <th>التفويض</th>
                                                <th>صندوق_البريد</th>
                                                <th>التاريخ</th>
                                                <th>اسم_م_ت</th>
                                                <th>اجراءات</th>
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





                
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; align-items: center; justify-content: center;">
                                <h3 class="card-title">إضافة تفويض</h3>
                            </div>
                            <div class="card-body" style="color:#000;">
                                <div class="form-validation">
                                    <form class="form-valide" action="./table-datatable-basic.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">اسم الشركة بالعربية
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="" name="ar_name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">اسم الشركة بالإنكليزية 
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="" name="en_name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">رقم التسجيل
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="" name="reg_num">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">رمز العميل 
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="" name="client_code">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">التفويض 
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="file" class="form-control" id="" name="auth_file">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">صندوق البريد
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="" name="mail_box">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">التاريخ
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="date" class="form-control" id="" name="date">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">اسم مسؤول التفويض
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="" name="person_name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                        <button type="submit" class="btn btn-primary" name="send_auth">إضافة</button>
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


<!-- /////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////  الاضافة  ///////////////// /////// -->
<!-- /////////////////////////////////////////////////////////////////// -->
<?php
      $send_auth = $_POST['send_auth'];
      if(isset($send_auth)){
        $ar_name = str_replace("'", "\'", $_POST['ar_name']);
        $en_name = str_replace("'", "\'", $_POST['en_name']);
        $reg_num = str_replace("'", "\'", $_POST['reg_num']);
        $client_code = str_replace("'", "\'", $_POST['client_code']);
        $mail_box = str_replace("'", "\'", $_POST['mail_box']);
        $date = $_POST['date'];
        $person_name = str_replace("'", "\'", $_POST['person_name']);
        $file_name = $_FILES['auth_file']['name'];
        if(!empty($file_name)){
            if(strlen(pathinfo($_FILES['auth_file']['name'], PATHINFO_EXTENSION)) == 3){
                $new_text = substr($file_name, 0, -4);
                $newName = $new_text . '_' . time();       
            } else {
                $new_text = substr($file_name, 0, -5);
                $newName = $new_text . '_' . time();       
            }
        // get file extension
        $extension = pathinfo($_FILES['auth_file']['name'], PATHINFO_EXTENSION);
        // create new file name with extension
        $newFileName = $newName . '.' . $extension;
        $the_file = $_FILES['auth_file']['tmp_name'];
        $target_dir = "./authorization/" . $newFileName;
        }
    


        if(strpos($newFileName, "'") >= 0){
            $errore_msg = "Image name contains quotes";
        }
        insertRow("auth_bahar", ["AR_NAME", "EN_NAME", "REG_NUM", "CLIENT_CODE", "AUTH_FILE", "MAIL_BOX", "DATE_", "PERSON_NAME"], [$ar_name, $en_name, $reg_num, $client_code, $newFileName, $mail_box, $date, $person_name], $the_file, $target_dir, $errore_msg);
      }
?>





<script>
    $(document).ready(function () {
        $('.delete').click(function(){
            var element = this;
            var deleteid = $(this).data('id');
            var oldfile = $(this).data('oldfile');
            var btn_clicked = $(this).data('name');
            var check = window.confirm("هل أنت متأكد من الحذف؟")
            if(check){
                $.ajax({
                    url: 'conf_delete_auth.php',
                    type: 'POST',
                    data: {id: deleteid, file_name: oldfile, dele_btn: btn_clicked},
                    dataType : 'html',
                    success: function(res){
                        if(res == '1'){
                            // window.alert('تم الحذف بنجاح!');
                            window.location = "./table-datatable-basic.php";
                        } else if(res == '0') {
                            window.alert('حدث خطأ ما!');
                        }
                    }
                });
            }
        });
    });
</script>






<!-- //////////////جدول البيبانتات ////////  -->

                <div class="row" dir="rtl">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; align-items: center; justify-content: center;">
                                <h4 class="card-title">آخر 50 تفويض تمت إضافته</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px; color: #000;">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th style="max-width: fit-content;">م</th> 
                                                <th>الاسم بالعربية</th>
                                                <th>الاسم بالأنكليزية</th>
                                                <th>رقم التسجيل</th>
                                                <th>رمز العميل</th>
                                                <th>التفويض</th>
                                                <th>صندوق البريد</th>
                                                <th>التاريخ</th>
                                                <th>اسم_م_ت</th>
                                                <th>اجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                        <?php
                                           $sql_s = 'SELECT * FROM auth_bahar ORDER BY ID DESC LIMIT 50';
                                           $result = mysqli_query($connect, $sql_s);
                                           if(isset($result)){
                                               $count = 1;
                                               while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                            <tr style="text-align: center;">
                                                <?php
                                                    echo '<td>' . $count++ . '</td>';
                                                    if($row['AR_NAME'] != null){echo '<td>' . $row['AR_NAME'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['EN_NAME'] != null){echo '<td>' . $row['EN_NAME'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['REG_NUM'] != null){echo '<td>' . $row['REG_NUM'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['CLIENT_CODE'] != null){echo '<td>' . $row['CLIENT_CODE'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['AUTH_FILE'] != null){echo '<td><a href="./authorization/' . $row['AUTH_FILE'] . '" style="color: brown; font-size: 1.5em;" title="Download" download><i class="fa-solid fa-download"></i> </a><a href="./authorization/' . $row['AUTH_FILE'] . '" style="color: brown; font-size: 1.5em;" target="_blank" title="View"> <i class="fa-solid fa-eye"></i></a></td>';} else {echo '<td>-</td>';}  
                                                    if($row['MAIL_BOX'] != null){echo '<td>' . $row['MAIL_BOX'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['DATE_'] != null){echo '<td>' . $row['DATE_'] . '</td>';} else {echo '<td>-</td>';}  
                                                    if($row['PERSON_NAME'] != null){echo '<td>' . $row['PERSON_NAME'] . '</td>';} else {echo '<td>-</td>';}  
                                                ?>
                                                <td>
                                                <div style="display: flex; align-items:center; justify-content:space-between; gap:1.5rem">
                                                    <form action="./edit_auth.php" enctype="multipart/form-data" method="POST">
                                                        <button value="<?php echo $row['ID']; ?>" type="submit" id="editButton" name="edit_btn" style="border: 1px solid #FFAA16; border-radius: 3px; font-size: larger; background-color: #fff; padding: 0 5px;" title="Edit"><i class="fa fa-pencil text-warning"></i></button>
                                                        <!-- <button type="submit" name="dele_btn" style="border: 1px solid red; border-radius: 3px; font-size: larger; background-color: #fff; padding: 0 5px;" title="Delete"><i class="fa fa-trash-o text-danger"></i></button> -->
                                                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                                        <input type="hidden" name="file_name" value="<?php echo $row['AUTH_FILE']; ?>">
                                                    </form>
                                                    <button class="delete" data-oldfile="<?php echo $row['AUTH_FILE']; ?>" data-id="<?php echo $row['ID']; ?>" id="del_<?php echo $row['ID']; ?>" data-name="dele_btn" style="border: 1px solid red; border-radius: 3px; font-size: larger; background-color: #fff; padding: 0 5px;" title="Delete"><i class="fa fa-trash-o text-danger"></i></button>
                                                </div>
                                                </td>
                                            </tr>
                                            <?php
                                           }
                                           }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="text-align: center;">
                                                <th style="max-width: fit-content;">م</th> 
                                                <th>الاسم_بالعربية</th>
                                                <th>الاسم_بالأنكليزية</th>
                                                <th>رقم_التسجيل</th>
                                                <th>رمز_العميل</th>
                                                <th>التفويض</th>
                                                <th>صندوق_البريد</th>
                                                <th>التاريخ</th>
                                                <th>اسم_م_ت</th>
                                                <th>اجراءات</th>
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