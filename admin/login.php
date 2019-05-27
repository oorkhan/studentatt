<?php
//login page
    include('database_connection.php');
    session_start();

    if(isset($_SESSION["admin_id"]))
    {
        header('location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Login</title>

  <!-- Custom fonts for this template-->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" method="post" id="admin_login_form">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="admin_user_name" name="admin_user_name" placeholder="Admin Username">
                      <span id="error_admin_user_name" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="admin_password" name="admin_password" placeholder="Password">
                      <span id="error_admin_password" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="admin_login" id="admin_login" class="btn btn-primary btn-user btn-block" value="Login">
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/js/sb-admin-2.min.js"></script>

</body>

</html>
<script>
$(document).ready(function(){
    $("#admin_login_form").on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"check_admin_login.php",
            method:"POST",
            data:(this).serialize(),
            dataType:"json",
            beforeSend:function()
            {
                $("#admin_login").val('Validate...');
                $("#admin_login").attr('disabled', 'disabled');
            },
            success:function(data)
            {
                if(data.success)
                {
                    location.href = "<?php echo $base_url; ?>admin"
                }
                if(data.error)
                {
                    $('#admin_login').val('Login');
                    $("#admin_login").attr('disabled', false);
                    if(data.error_admin_user_name != '')
                    {
                        $('#error_admin_user_name').text(data.error_admin_user_name);
                    }
                    else{
                        $('#error_admin_user_name').text('');
                    }
                    if(data.admin_password != '')
                    {
                        $('#error_admin_password').text(data.error_admin_password);
                    }
                    else{
                        $('#error_admin_password').text('');
                    }
                }
            }        
        });
    });
});
</script>
