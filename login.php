f<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Jump Starter Co.,Ltd</title>
  <link rel="shortcut icon" type="image/x-icon" href="vendor/images/LOGO-Jumpstarter-180.png">  
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/fontawesome-all.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header text-center">LOGIN</div>
      <div class="card-body">
        <form action="check_login.php" method="POST" autocomplete="off">
          <div class="col-md-12 text-center">
            <img src="vendor/images/LOGO-Jumpstarter-180.png" alt="jump starter logo" border="0" align="text-center" vspace="10" hspace="10">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address or Username</label>
            <input class="form-control" name="txtUsername" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="enter username or email" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" name="txtPassword" id="exampleInputPassword1" type="password" placeholder="password"
                onmousedown="this.type='text'"
                onmouseup="this.type='password'"
                onmousemove="this.type='password'" required>
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block" value="Login" name="login">
          </form>
          <div class="text-center">
            <!-- <a class="d-block small mt-3" href="register.html">Register an Account</a> -->
            <br>
            <!-- <a class="d-block small" href="#">Forgot Password?</a> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  </body>

  </html>
