<?php
error_reporting(0);
  // Initialize sessions
  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: emp_table.php");
    exit;
  }

  // Include config file
  require_once "./conn.php";

  // Define variables and initialize with empty values
  $username = $password = '';
  $username_err = $password_err = '';

  // Process submitted form data
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if username is empty
    if(empty(trim($_POST['username']))){
      $username_err = 'يرجى ادخال اسم المستخدم';
    } else{
      $username = trim($_POST['username']);
    }

    // Check if password is empty
    if(empty(trim($_POST['password']))){
      $password_err = 'يرجى ادخال كلمة المرور';
    } else{
      $password = trim($_POST['password']);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
      // Prepare a select statement
      $sql = 'SELECT ID, USERNAME_, PASSWORD_ FROM user_login WHERE USERNAME_ = ?';

      if ($stmt = $connect->prepare($sql)) {

        // Set parmater
        $param_username = $username;

        // Bind param to statement
        $stmt->bind_param('s', $param_username);

        // Attempt to execute
        if ($stmt->execute()) {

          // Store result
          $stmt->store_result();

          // Check if username exists. Verify user exists then verify
          if ($stmt->num_rows == 1) {
            // Bind result into variables
            $stmt->bind_result($id, $username, $hashed_password);

            if ($stmt->fetch()) {
              if ($password == $hashed_password) {

                header('location: emp_table.php');
                // Start a new session
                session_start();

                // Store data in sessions
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;

                // Redirect to user to page
              } else {
                // Display an error for passord mismatch
                $password_err = 'كلمة مرور غير صحيحة';
              }
            }
          } else {
            $username_err = "اسم المستخدم غير صحيح";
          }
        } else {
          echo "عذراً! حدث خطأ ما، يرجى المحاولة لاحقاً";
        }
        // Close statement
        $stmt->close();
      }

      // Close connection
      $connect->close();
    }
  }
?>
<!-- //////////////////// -->
<!DOCTYPE html>
<html lang="en" class="h-100">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Al-bahar International shipping L.L.C">
    <meta name="keywords" content="مؤسسة البحار للملاحة الدولية">
    <title>Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/bahar.jpg">
    <link href="./css/style.css" rel="stylesheet">
    <style>
    img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {display: none;}
        *{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

    </style>
    
 

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-4">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h2 class="text-center mb-4">تسجيل دخول الموظفين</h2>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                        <div class="form-group">
                                            <label><strong>Username</strong></label>
                                            <input required autocomplete="off" type="text" class="form-control" name="username" value="<?php echo $username ?>">
                                            <?php echo '<span style="color: red">' . $username_err . '</span>'; ?>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input required type="password" class="form-control" name="password" value="<?php echo $password ?>">
                                            <?php echo '<span style="color: red">' . $password_err . '</span>'; ?>
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block" name="login_btn">دخول</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Scripts
    ***********************************-->


    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

</body>

</html>