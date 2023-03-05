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
    function insertRow($table, $columns, $values, $errore_msg) {
        include('./conn.php'); 
        $columnString = implode(",", $columns);
        $valueString = "'" . implode("','", $values) . "'";
        $query = "INSERT INTO $table ($columnString) VALUES ($valueString)";
            if ($errore_msg == '' && mysqli_query($connect, $query)) {
                ?>
                    <script>
                        var pop_alert = document.getElementById("pop_alert");
                        pop_alert.style.display = "flex";
                        pop_alert.innerHTML = '<div class="custom-modal" id="hideAlert"><div class="succes succes-animation icon-top"><i class="fa fa-check"></i></div><div class="succes border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">تمت الإضافة بنجاح!</p><button id="alert_close_btn" class="btn btn-success" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                        var close_al = document.getElementById("alert_close_btn");
                        close_al.onclick = () => {
                            window.location.href = window.location.href;
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
                            window.location.href = window.location.href;
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
    // delete function
    function deleteRow($table, $row_id) {
        include('./conn.php');
        $query = "DELETE FROM " . $table . " WHERE ID = " . $row_id;
        if (mysqli_query($connect, $query)) {
            ?>
                <script>
                    var pop_alert = document.getElementById("pop_alert");
                    pop_alert.style.display = "flex";
                    pop_alert.innerHTML = '<div class="custom-modal"><div class="succes succes-animation icon-top"><i class="fa fa-check"></i></div><div class="succes border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">تم الحذف بنجاح!</p><button id="alert_close_btn" class="btn btn-success" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                    var close_al = document.getElementById("alert_close_btn");
                    close_al.onclick = () => {
                        window.location.href = window.location.href;
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
                        window.location.href = window.location.href;
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
    <title>Settings </title>
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
                        </div>

                        <ul class="navbar-nav header-right">
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
                    </li>
                    <li><a class="has-arrow mm-active" href="./table-datatable-basic.php">
                        <i class="fa-solid fa-table"></i><span class="nav-text">التفاويض </span></a>
                    </li>
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
                <div class="row" dir="rtl">                
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; align-items: center; justify-content: center;">
                                <h3 class="card-title">إعدادات دخول المسؤول</h3>
                            </div>
                            <div class="card-body" style="color:#000;">
                                <div class="form-validation">
                                    <form class="form-valide" action="./settings.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">اسم المستخدم
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input autocomplete="off" type="text" class="form-control" id="" name="username">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">كلمة المرور  
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input autocomplete="off" type="text" class="form-control" id="" name="password">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">تأكيد كلمة المرور
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input autocomplete="off" type="text" class="form-control" id="" name="check_password">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="submit" class="btn btn-primary" name="add_user">إضافة اسم مستخدم جديد</button>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-xl-6">
<script>
    
</script>
                                                <div class="form-group row">
                                                <div class="table-responsive">
                    <table class="table table-bordered" style="color: #000;">
                        <thead>
                            <tr style="text-align: center;">
                                <th>#</th>
                                <th>اسم المستخدم</th>
                                <th>كلمة المرور</th>
                                <th>اجراء</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        <?php
                            $count = 1;
                           $sql_s = 'SELECT * FROM admin_login';
                           $result = mysqli_query($connect, $sql_s);
                           if(isset($result)){
                               while($row = mysqli_fetch_assoc($result)){
                            ?>
                        
                            <tr style="text-align: center;">
                                <?php
                                    echo '<td>' . $count++ . '</td>'; 
                                    echo '<td>' . $row['USERNAME_'] . '</td>'; 
                                    echo '<td>' . $row['PASSWORD_'] . '</td>';
                                ?>
                                <td>
                                    <form action="./settings.php" method="POST">
                                        <button type="submit" id="my-btn1" name="dele_btn" style="border-radius: 3px; font-size: larger; background-color: #00000011; padding: 0 5px;" title="Delete"><i class="fa fa-trash-o"></i></button>
                                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                    </form>
                                </td>
                            </tr>
                            <?php
                            if(mysqli_num_rows($result) <= 1){
                                echo '<script>
                                document.getElementById("my-btn1").setAttribute("disabled", "");
                                    </script>';
                                }
                            
                           }
                           }
                            ?>
                        </tbody>
                    </table>
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





<!--/////////////////////// -->
                <div class="row" dir="rtl">                
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; align-items: center; justify-content: center;">
                                <h3 class="card-title">إعدادات دخول الموظف</h3>
                            </div>
                            <div class="card-body" style="color:#000;">
                                <div class="form-validation">
                                    <form class="form-valide" action="./settings.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">اسم المستخدم
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input autocomplete="off" type="text" class="form-control" id="" name="username_emp">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">كلمة المرور  
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input autocomplete="off" type="text" class="form-control" id="" name="password_emp">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">تأكيد كلمة المرور
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input autocomplete="off" type="text" class="form-control" id="" name="check_password_emp">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="submit" class="btn btn-primary" name="add_user_emp">إضافة اسم مستخدم جديد</button>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-xl-6">
<script>
    
</script>
                                                <div class="form-group row">
                                                <div class="table-responsive">
                    <table class="table table-bordered" style="color: #000;">
                        <thead>
                            <tr style="text-align: center;">
                                <th>#</th>
                                <th>اسم المستخدم</th>
                                <th>كلمة المرور</th>
                                <th>اجراء</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        <?php
                            $count = 1;
                           $sql_s = 'SELECT * FROM user_login';
                           $result = mysqli_query($connect, $sql_s);
                           if(isset($result)){
                               while($row = mysqli_fetch_assoc($result)){
                            ?>
                        
                            <tr style="text-align: center;">
                                <?php
                                    echo '<td>' . $count++ . '</td>'; 
                                    echo '<td>' . $row['USERNAME_'] . '</td>'; 
                                    echo '<td>' . $row['PASSWORD_'] . '</td>';
                                ?>
                                <td>
                                    <form action="./settings.php" method="POST">
                                        <button type="submit" id="my-btn2" name="dele_btn_emp" style="border-radius: 3px; font-size: larger; background-color: #00000011; padding: 0 5px;" title="Delete"><i class="fa fa-trash-o"></i></button>
                                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                    </form>
                                </td>
                            </tr>
                            <?php
                            if(mysqli_num_rows($result) <= 1){
                                echo '<script>
                                document.getElementById("my-btn2").setAttribute("disabled", "");
                                    </script>';
                                }
                            
                           }
                           }
                            ?>
                        </tbody>
                    </table>
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
      $add_user = $_POST['add_user'];
      if(isset($add_user)){
        $username = str_replace("'", "\'", $_POST['username']);
        $password = str_replace("'", "\'", $_POST['password']);
        $check_password = str_replace("'", "\'", $_POST['check_password']);
        if ($password != $check_password) {
            $errore_msg = 'كلمة المرور في الحقلين غير متطابقة!';
        }
            
        insertRow("admin_login", ["USERNAME_", "PASSWORD_"], [$username, $password], $errore_msg);
      }
?>



    <!-- /////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////  حذف  //////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////// -->
<?php
    $dele_btn_emp = $_POST['dele_btn_emp'];
    if(isset($dele_btn_emp)){
        $id = $_POST['id'];
        deleteRow("user_login", $id);
    }
?>















<!-- /////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////  الاضافة  ///////////////// /////// -->
<!-- /////////////////////////////////////////////////////////////////// -->
<?php
      $add_user_emp = $_POST['add_user_emp'];
      if(isset($add_user_emp)){
        $username_emp = str_replace("'", "\'", $_POST['username_emp']);
        $password_emp = str_replace("'", "\'", $_POST['password_emp']);
        $check_password_emp = str_replace("'", "\'", $_POST['check_password_emp']);
        if ($password_emp != $check_password_emp) {
            $errore_msg = 'كلمة المرور في الحقلين غير متطابقة!';
        }
            
        insertRow("user_login", ["USERNAME_", "PASSWORD_"], [$username_emp, $password_emp], $errore_msg);
      }
?>



    <!-- /////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////  حذف  //////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////// -->
<?php
    $dele_btn = $_POST['dele_btn'];
    if(isset($dele_btn)){
        $id = $_POST['id'];
        deleteRow("admin_login", $id);
    }
?>




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