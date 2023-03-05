<?php
error_reporting(0);
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

    include('./conn.php'); 
?>
<!DOCTYPE html>
<html lang="en">
    <script src="https://kit.fontawesome.com/c71e41ff4a.js" crossorigin="anonymous"></script>
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
                pop_alert.innerHTML = '<div class="custom-modal"><div class="succes succes-animation icon-top"><i class="fa-solid fa-check"></i></div><div class="succes border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">تم التعديل بنجاح!</p><button id="alert_close_btn" class="btn btn-success" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                var close_al = document.getElementById("alert_close_btn");
                close_al.onclick = () => {
                    pop_alert.style.display = "none";
                }
                setTimeout(()=>{
                    window.location = "./table-datatable-basic.php";
                },1000);
            </script>
        <?php

    }else{
        ?>
            <script>
                var pop_alert = document.getElementById("pop_alert");
                pop_alert.style.display = "flex";
                pop_alert.innerHTML = '<div class="custom-modal"><div class="danger danger-animation icon-top"><i class="fa-solid fa-xmark"></i></div><div class="danger border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">حدث خطأ ما!<br /><span class="type"><?php echo $errore_msg ?></span></p><button id="alert_close_btn" class="btn btn-danger" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                var close_al = document.getElementById("alert_close_btn");
                close_al.onclick = () => {
                    pop_alert.style.display = "none";
                }
                setTimeout(()=>{
                    window.location = "./table-datatable-basic.php";
                },1000);
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
                    pop_alert.innerHTML = '<div class="custom-modal"><div class="succes succes-animation icon-top"><i class="fa-solid fa-check"></i></div><div class="succes border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">تم الحذف بنجاح!</p><button id="alert_close_btn" class="btn btn-success" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                    var close_al = document.getElementById("alert_close_btn");
                    close_al.onclick = () => {
                        pop_alert.style.display = "none";
                    }
                    setTimeout(()=>{
                    window.location = "./table-datatable-basic.php";
                },1000);
               </script>
            <?php
        }else{
            ?>
                <script>
                    var pop_alert = document.getElementById("pop_alert");
                    pop_alert.style.display = "flex";
                    pop_alert.innerHTML = '<div class="custom-modal"><div class="danger danger-animation icon-top"><i class="fa-solid fa-xmark"></i></div><div class="danger border-bottom"></div><div class="content"><p class="type">Alert</p><p class="message-type">حدث خطأ ما!</p><button id="alert_close_btn" class="btn btn-danger" style="margin-bottom: 1rem;">إغلاق</button></div></div>';
                    var close_al = document.getElementById("alert_close_btn");
                    close_al.onclick = () => {
                        pop_alert.style.display = "none";
                    }
                    setTimeout(()=>{
                    window.location = "./table-datatable-basic.php";
                },1000);
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
    <title>Edit auth </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/bahar.jpg">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
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
                <img class="logo-abbr" src="./images/bahar.jpg" alt="bahar-logo" style="width: 45px; border-radius:50%">
                    <span id="logo-name" style="margin-left: 1rem">البحار للملاحة الدولية</span>
                    </a>
            <div class="nav-control">
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
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./app-profile.php" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="./email-inbox.php" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a href="./page-login.php" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
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
                    <li><a class="has-arrow" href="./dash_admin.php"><i
                                class="icon icon-single-04"></i><span class="nav-text">لوحة التحكم</span></a>
                    </li>
                    <li><a class="has-arrow mm-active" href="./table-datatable-basic.php"><i
                                class="icon icon-layout-25"></i><span class="nav-text">التفاويض</span></a>
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
<!-- ////////////////////فورم التعديل ////////////// -->
<!-- ////////////////////فورم التعديل ////////////// -->
<!-- ////////////////////فورم التعديل ////////////// -->
<!-- ////////////////////فورم التعديل ////////////// -->
<?php
    $edit_btn = $_POST['edit_btn'];
    if(isset($edit_btn)){
        $id = $_POST['id'];
        $sql_ed = 'SELECT * FROM auth_bahar WHERE ID = ' . $id;
        $result_ed = mysqli_query($connect, $sql_ed);
        if(isset($result_ed)){
            while($row_ed = mysqli_fetch_assoc($result_ed)){
?>
<div class="row" dir="rtl"> 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; align-items: center; justify-content: center;">
                                <h3 class="card-title">تعديل بيانات التفويض</h3>
                            </div>
                            <div class="card-body" style="color:#000;">
                                <div class="form-validation">
                                    <form id="editForm" class="form-valide" action="./edit_auth.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">اسم الشركة بالعربية
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input value="<?php echo $row_ed['AR_NAME'] ?>" type="text" class="form-control" id="" name="ar_name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">اسم الشركة بالإنكليزية 
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input value="<?php echo $row_ed['EN_NAME'] ?>" type="text" class="form-control" id="" name="en_name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">رقم التسجيل
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input value="<?php echo $row_ed['REG_NUM'] ?>" type="text" class="form-control" id="" name="reg_num">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">رمز العميل 
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input value="<?php echo $row_ed['CLIENT_CODE'] ?>" type="text" class="form-control" id="" name="client_code">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for=""> 
                                                        <span class="text-danger">الملف القديم هو: </span>
                                                    </label>
                                                    <div class="col-lg-6" style="text-align: center;">
                                                    <label class="col-form-label" for=""> 
                                                        <span class="text-danger">
                                                            <?php
                                                                if($row_ed['AUTH_FILE'] == ''){
                                                                    echo 'لا يوجد ملف';
                                                                } else {
                                                                    echo $row_ed['AUTH_FILE'] . '<span class="text-danger"> || اختر للحذف <input type="checkbox" name="checkbox_to_del"></span>';
                                                                }
                                                            ?>
                                                        </span>
                                                        
                                                        <input type="hidden" value="<?php echo $row_ed['AUTH_FILE'] ?>" name="old_auth_file">
                                                    </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">اختر تفويضاً جديداً 
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
                                                        <input value="<?php echo $row_ed['MAIL_BOX'] ?>" type="text" class="form-control" id="" name="mail_box">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">التاريخ
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input value="<?php echo $row_ed['DATE_'] ?>" type="date" class="form-control" id="" name="date">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">اسم مسؤول التفويض
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input value="<?php echo $row_ed['PERSON_NAME'] ?>" type="text" class="form-control" id="" name="person_name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <input type="hidden" name="id" value="<?php echo $row_ed['ID'] ?>">
                                                        <button type="submit" class="btn btn-primary" name="edit_auth_btn">تحديث</button>
                                                        <button type="submit" class="btn btn-primary" name="cancel">إلغاء</button>
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

<?php
            }
        }
    }
?>

    <!-- ///////////edit////////// -->
    <?php
    
      $cancel = $_POST['cancel'];
      if(isset($cancel)){
        // header('location: table-datatable-basic.php');
        echo '<script>window.location = "./table-datatable-basic.php";</script>';
      }
      $edit_auth_btn = $_POST['edit_auth_btn'];
      if(isset($edit_auth_btn)){
        $id = $_POST['id'];
        $ar_name = str_replace("'", "\'", $_POST['ar_name']);
        $en_name = str_replace("'", "\'", $_POST['en_name']);
        $reg_num = str_replace("'", "\'", $_POST['reg_num']);
        $client_code = str_replace("'", "\'", $_POST['client_code']);
        $mail_box = str_replace("'", "\'", $_POST['mail_box']);
        $date = $_POST['date'];
        $person_name = str_replace("'", "\'", $_POST['person_name']);
        $old_auth_file = $_POST['old_auth_file'];
        $the_file = $_FILES['auth_file']['tmp_name'];
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
        $target_dir = "./authorization/" . $newFileName;
        }

    
// /////////////////////////
$checkbox_to_del = $_POST['checkbox_to_del'];
$new_file_check = $_FILES['auth_file']['name'];
if(empty($new_file_check)){
    if($checkbox_to_del == true){
        unlink("./authorization/" . $old_auth_file);
        $old_auth_file = '';
    }
}
// ////////////////////////


        if(strpos($newFileName, "'") >= 0){
            $errore_msg = "اسم الملف يحتوي على اشارة تنصيص";
        }

        if($newFileName == null){
            updateRow("auth_bahar", ["AR_NAME" => $ar_name, "EN_NAME" => $en_name, "REG_NUM" => $reg_num, "CLIENT_CODE" => $client_code, "AUTH_FILE" => $old_auth_file, "MAIL_BOX" => $mail_box, "DATE_" => $date, "PERSON_NAME" => $person_name], '', '', $id, '', '');
        } else {
            updateRow("auth_bahar", ["AR_NAME" => $ar_name, "EN_NAME" => $en_name, "REG_NUM" => $reg_num, "CLIENT_CODE" => $client_code, "AUTH_FILE" => $newFileName, "MAIL_BOX" => $mail_box, "DATE_" => $date, "PERSON_NAME" => $person_name], $the_file, $target_dir, $id, $old_auth_file, $errore_msg);
        }    

      }
?>
    <!-- /////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////  حذف  //////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////// -->
<?php
    $dele_btn = $_POST['dele_btn'];
    if(isset($dele_btn)){
        $file_name = $_POST['file_name'];
        $id = $_POST['id'];
        deleteRow("auth_bahar", $id, $file_name);
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