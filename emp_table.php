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

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Authorization </title>
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
    </style>

</head>

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
                                <a href="./bayan.php" class="btn btn-primary text-white"><i class="fa-solid fa-file-circle-plus"></i> تسجيل بيان جديد</a>
                                <a href="./edit_req.php" style="margin-left: 1rem" class="btn btn-primary text-white"><i class="fa-regular fa-pen-to-square"></i> طلب تعديل</a>
                                <!-- <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form> -->
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
</style>


        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" style="margin-left: 0">
            <div class="container-fluid">
                <!-- <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                        </div>
                    </div>
                </div> -->
                <!-- row -->

<!-- //////////////جدول البيبانتات ////////  -->

<div class="row" dir="rtl">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="display: flex; align-items: center; justify-content: center;">
                <h4 class="card-title">جدول التفاويض</h4>
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
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        <?php
                           $sql_s = 'SELECT * FROM auth_bahar';
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
                                    if($row['AUTH_FILE'] != null){echo '<td><a href="./authorization/' . $row['AUTH_FILE'] . '" style="color: brown; font-size: 1.5em;" title="Download" download><i class="fa-solid fa-download"></i> </a><a href="./authorization/' . $row['AUTH_FILE'] . '" style="color: brown; font-size: 1.5em;" title="View" target="_blank"> <i class="fa-solid fa-eye"></i></a></td>';} else {echo '<td>-</td>';}  
                                    if($row['MAIL_BOX'] != null){echo '<td>' . $row['MAIL_BOX'] . '</td>';} else {echo '<td>-</td>';}  
                                    if($row['DATE_'] != null){echo '<td>' . $row['DATE_'] . '</td>';} else {echo '<td>-</td>';}  
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
                                <th>الاسم_بالعربية</th>
                                <th>الاسم_بالأنكليزية</th>
                                <th>رقم_التسجيل</th>
                                <th>رمز_العميل</th>
                                <th>التفويض</th>
                                <th>صندوق_البريد</th>
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