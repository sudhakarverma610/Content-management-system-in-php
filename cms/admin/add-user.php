 <?php
 require_once('inc/top.php'); 
  if (!isset($_SESSION['username'])) {
        header('location:login.php');
        # code...
      }elseif (isset($_SESSION['username']) && $_SESSION['role']=='author') {
        header('location:index.php');
        # code...
      }
 ?>
   </head> 
   <body>  

      <div id="wrapper">
       <?php 
      require_once('inc/header.php');
 ?>
    <div class="container-fluid body-section">
       <div class="row">
          <div class="col-md-3">
              
       <?php 
      require_once('inc/sidebar.php');
        ?>
          </div>

          <div class="col-md-9">
             <h1 class="animated fadeInRight" ><i class="fa fa-user-plus"></i> &nbsp;Add user<small> Add New user</small></h1><hr>
             <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                <li class="active"><i class="fa fa-user-plus"> </i> Add New user </li>
                
             </ol> 
             <?php 
             if (isset($_POST['submit'])) {
                
              $first_name=mysqli_real_escape_string($conn,$_POST['first-name']);  
              $last_name=mysqli_real_escape_string($conn,$_POST['last-name']);
              $username=mysqli_real_escape_string($conn,strtolower($_POST['user-name']));
              $username_trim = preg_replace('/\s+/','',$username);
              $email=mysqli_real_escape_string($conn,strtolower($_POST['email']));
              $password=mysqli_real_escape_string($conn,$_POST['password']);
             $date=time();
              $role= $_POST['role'];
              $image=$_FILES['image']['name'];
              $image_tmp=$_FILES['image']['tmp_name'];
              $check_query="SELECT * from users where username='$username' or email='$email' ";
              $check_run=mysqli_query($conn,$check_query);
             $salt_query="SELECT * FROM users ORDER BY id DESC LIMIT 1";
             $salt_run=mysqli_query($conn,$salt_query);
               $salt_row=mysqli_fetch_array($salt_run);
               $salt=$salt_row['salt'];
             //$password =crypt($password,$salt);
              if (empty($first_name) or empty($last_name) or empty($username) or empty($email) or empty($password) or empty($image)) {
                $error="All (*) feildes are required";
                # code...
              }else if ($username!=$username_trim){

                $error="Don't Use space in username";
              }else if (mysqli_num_rows($check_run) > 0)  {
                $error="Username or Email Already Exists";
                # code...
              }else{
                 $insert_query="INSERT INTO `users` (`id`, `date`, `first_name`, `last_name`, `username`, `email`, `image`, `password`, `role`) VALUES (NULL, '$date', '$first_name', '$last_name', '$username', '$email', '$image', '$password', '$role') ";
                  if ( mysqli_query($conn,$insert_query)) {
                    $msg="User Has Been Added";
                     move_uploaded_file($image_tmp, "img/$image");
                   $image_check="SELECT * FROM users ORDER BY id DESC LIMIT 1";


                   $image_run=mysqli_query($conn,$image_check);
                    $image_row=mysqli_fetch_array($image_run);
                     $check_image=$image_row['image'];
                     $first_name="";
                     $last_name="";
                     $username="";
                     $email="";
                    # code...
                  }else{
                      $error="User Has Not Been Added";
                  }


              }
                        # code...
             }
             ?>
             <div class="row">
               <div class="col-md-8">
                 
             <form action="" method="post" enctype="multipart/form-data">
               <div class="form-group">
                 <label for="first-name">First Name:*</label>
                 <?php 
                 if (isset($error)) {
                  echo "<span class='pull-right' style='color:red' >$error</span>";
                   # code...
                 }elseif (isset($msg)) {
                  echo "<span class='pull-right' style='color:green' >$msg</span>";
                   # code...
                 }
                 ?>
                 <input type="text" id="first-name" name="first-name" class="form-control" placeholder="First Name" value="<?php if(isset($first_name)){ echo($first_name);}?>">
               </div>
               <div class="form-group">
                 <label for="last-name">Last Name:*</label>
                 <input type="text" id="last-name" name="last-name" class="form-control" placeholder="last Name" value="<?php if(isset($last_name)){  echo($last_name);}?>">
               </div>
               <div class="form-group">
                 <label for="user-name">User Name:*</label>
                 <input type="text"  id="user-name" name="user-name" class="form-control" placeholder="user Name" value="<?php if(isset($username)){  echo($username);}?>">
               </div>
               <div class="form-group">
                 <label for="email">Email:*</label>
                 <input type="text" id="email" name="email" class="form-control" placeholder="Email Address" value="<?php if(isset($email)){ echo($email);}?>">
               </div>
               <div class="form-group">
                 <label for="password">Password:*</label>
                 <input type="Password" id="password" name="password" class="form-control" placeholder="Password">
               </div>
               <div class="form-group">
                 <label for="role">Role:*</label>
                 <select name="role" id="role" class="form-control">
                   <option value="author">Author</option>
                   <option value="admin">Admin</option>
                 </select>
               </div>
               <div class="form-group">
                 <label name="image"> Profile-Picture:*</label>
                 <input type="file" name="image" id="image" >
               </div>
               <input type="submit" name="submit" class="btn btn-primary" value="Add User">
             </form>
               </div>
               <div class="col-md-4">
                 <?php 
                 if (isset($check_image)) {
                  echo "<img src='img/$check_image' widht='100%' style='max-width:300px;max-hieght:300px;'>";
                   # code...
                 }
                 ?>
               </div>
             </div>


             
               


          </div>
       </div>
    </div>
    <?php require_once 'inc/footer.php'; ?>