<?php 
ob_start();
session_start();

       
   
 
require_once '../inc/db.php';
 
if (isset($_POST['submit'])) {
  $username=mysqli_real_escape_string($conn,strtolower($_POST['username']));
  $password=mysqli_real_escape_string($conn, $_POST['password']);
  $check_username_query="SELECT * FROM `users` WHERE username='$username' and password='$password'";
     $check_username_run = mysqli_query($conn, $check_username_query);
     if (mysqli_num_rows($check_username_run) > 0) {
      $row=mysqli_fetch_array($check_username_run);
      $db_username=$row['username'];
      $db_password=$row['password'];
      $db_role=$row['role'];
      $db_author_image=$row['image'];

      if ($username==$db_username && $password==$db_password) {
        header('location:index.php');
        $_SESSION['username']=$db_username;
         $_SESSION['role']=$db_role;
         $_SESSION['author_image']=$db_author_image;

        # code...
      }else{
        $error="wrong Username and Password";
       # code...
      }
     }else{
      $error="wrong Username and Password";
     }
  # code...
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/photo1.jpg">

    <title>LOGIN page for sudhakar</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animated.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin animated shake" action="" method="post">
        <h2 class="form-signin-heading">sudhakar login</h2>
        <label for="inputEmail" class="sr-only">Username:</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
          <?php if (isset($error)) {
            echo "$error";
            # code...
          } ?>
          </label>
        </div>
        <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="Sign In">
      </form>

    </div> <!-- /container -->
  </body>
</html>
