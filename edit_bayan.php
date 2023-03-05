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
    if($errore_msg == null){
        if (mysqli_query($connect, $query)) {
            unlink("./declarations/" . $old_file);
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
                        window.location = "./bayan_admin.php";
                    },1000);
                </script>
            <?php
        }
    
    } else {
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
                        window.location = "./bayan_admin.php";
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
            unlink("./declarations/" . $file_name);
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
                    window.location = "./bayan_admin.php";
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
                    window.location = "./bayan_admin.php";
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
    <title>Edit bayan </title>
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
                    <li><a class="has-arrow" href="./table-datatable-basic.php"><i
                                class="icon icon-layout-25"></i><span class="nav-text">التفاويض</span></a>
                    </li>
                    <li><a class="has-arrow mm-active" href="./bayan_admin.php">
                        <i class="fa-solid fa-box-archive"></i><span class="nav-text">البيانات </span></a>
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
        $sql_ed = 'SELECT * FROM bayan WHERE ID = ' . $id;
        $result_ed = mysqli_query($connect, $sql_ed);
        if(isset($result_ed)){
            while($row_ed = mysqli_fetch_assoc($result_ed)){
?>
<div class="row" dir="rtl"> 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; align-items: center; justify-content: center;">
                                <h3 class="card-title">تعديل بيان</h3>
                            </div>
                            <div class="card-body" style="color:#000;">
                                <div class="form-validation">
                                    <form id="editForm" class="form-valide" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">رقم البيان
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input value="<?php echo $row_ed['BAYAN_NUM'] ?>" type="text" class="form-control" id="" name="bayan_num">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">رقم المعاملة 
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input value="<?php echo $row_ed['TRANSACTION_NUM'] ?>" type="text" class="form-control" id="" name="tra_num">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">نوع البيان
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control form-select" name="bayan_type" value="<?php echo $row_ed['BAYAN_TYPE'] ?>">
                                                          <option selected><?php echo $row_ed['BAYAN_TYPE'] ?></option>
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
                                                    <label class="col-lg-4 col-form-label" for=""> 
                                                        <span class="text-danger">الملف القديم هو: </span>
                                                    </label>
                                                    <div class="col-lg-6" style="text-align: center;">
                                                    <label class="col-form-label" for=""> 
                                                        <span class="text-danger">
                                                            <?php
                                                                if($row_ed['BAYAN_FILE'] == ''){
                                                                    echo 'لا يوجد ملف';
                                                                } else {
                                                                    echo $row_ed['BAYAN_FILE'];
                                                                }
                                                            ?>
                                                        </span>
                                                        
                                                        <input type="hidden" value="<?php echo $row_ed['BAYAN_FILE'] ?>" name="old_bayan_file">
                                                    </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">اختر بيان جديد
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="file" class="form-control" id="" name="bayan_file">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="">التاريخ
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input value="<?php echo date("Y-m-d", strtotime($row_ed['BAYAN_DATE'])); ?>" type="date" class="form-control" id="" name="date">
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
        echo '<script>window.location = "./bayan_admin.php";</script>';
      }
      $edit_auth_btn = $_POST['edit_auth_btn'];
      if(isset($edit_auth_btn)){
        $id = $_POST['id'];
        $bayan_num = $_POST['bayan_num'];
        $transaction_number = $_POST['tra_num'];
        $bayan_type = $_POST['bayan_type'];
        $old_bayan_file = $_POST['old_bayan_file'];
        $bayan_date = date("d-m-Y", strtotime($_POST['date']));
        
        
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
    
     if(empty($file_name)){
        updateRow("bayan", ["BAYAN_NUM" => $bayan_num, "TRANSACTION_NUM" => $transaction_number, "BAYAN_TYPE" => $bayan_type, "BAYAN_FILE" => $old_bayan_file, "BAYAN_DATE" => $bayan_date], '', '', $id, '', $errore_msg);
    } else {
        updateRow("bayan", ["BAYAN_NUM" => $bayan_num, "TRANSACTION_NUM" => $transaction_number, "BAYAN_TYPE" => $bayan_type, "BAYAN_FILE" => $newFileName, "BAYAN_DATE" => $bayan_date], $the_file, $target_dir, $id, $old_bayan_file, $errore_msg);
    }
}

         
 

      //}
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