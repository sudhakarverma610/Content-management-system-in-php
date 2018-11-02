 <?php
 require_once('inc/top.php'); 
  if (!isset($_SESSION['username'])) {
        header('location:login.php');
        # code...
      }
 ?>
 <?php
 $session_username=$_SESSION['username'];
 if(isset($_GET['edit'])) {
  $edit_id=$_GET['edit'];
  $edit_query="SELECT * FROM users where id =$edit_id ";
  $edit_query_run=mysqli_query($conn,$edit_query);
  if (mysqli_num_rows($edit_query_run) > 0) {
    $edit_row=mysqli_fetch_array($edit_query_run);
       $e_username= $edit_row['username'];
       if ($e_username== $session_username) {

       $e_first_name= $edit_row['first_name'];
       $e_last_name= $edit_row['last_name'];
       $e_image= $edit_row['image'];
       $e_details=$edit_row['details'];
       $e_password=$edit_row['password'];
         # code...
       }else{
        header('location:index.php');
       }
    # code...
  }else{
    header('location:index.php');

  }
  # code...
}else{
  header('location:index.php');

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
             <h1 class="animated bounceIn"><i class="fa fa-user"></i> &nbsp;Edit Profile<small> Edit Profile Details</small></h1><hr>
             <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                <li class="active"><i class="fa fa-user"> </i> Edit Profile details </li>
                
             </ol> 
             <?php 
             if (isset($_POST['submit'])) {
                
              $first_name=mysqli_real_escape_string($conn,$_POST['first-name']);  
              $last_name=mysqli_real_escape_string($conn,$_POST['last-name']);
               
              $password=mysqli_real_escape_string($conn,$_POST['password']);
              
              $image=$_FILES['image']['name'];
              $image_tmp=$_FILES['image']['tmp_name'];
              $details=mysqli_real_escape_string($conn,$_POST['details']);  
              if(empty($image)){

                $image=$e_image;
              }
              if (empty($password)) {
                $password=$e_password;
                # code...
              }
               
             $salt_query="SELECT * FROM users ORDER BY id DESC LIMIT 1";
             $salt_run=mysqli_query($conn,$salt_query);
               $salt_row=mysqli_fetch_array($salt_run);
               $salt=$salt_row['salt'];
             //$password =crypt($password,$salt);
              if (empty($first_name) or empty($last_name)   or empty($image)) {
                $error="All (*) feildes are required";
                # code...
               
              }else{
               $update_query="UPDATE  `users` SET  `first_name` =  ' $first_name',
              `last_name` =  ' $last_name',
              `image` =  '$image',
              `password` =  '$password',
              
              `details` =  '$details' WHERE  `users`.`id` =$edit_id LIMIT 1";
              if(mysqli_query($conn,$update_query)){
                $msg="user has been updeted";
                move_uploaded_file($image_tmp, "img/$image");
                $image_check="SELECT * FROM users ORDER BY id DESC LIMIT 1";


                   $image_run=mysqli_query($conn,$image_check);
                    $image_row=mysqli_fetch_array($image_run);
                     $check_image=$image_row['image'];
                     $first_name="";
                     $last_name="";
                     $details="";
                     header("refresh:1; url=profile.php");

              } else{
                 $error="user has been updeted";
              }        


              
             }}
             
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
                 <input type="text" id="first-name" name="first-name" class="form-control" placeholder="First Name" value="<?php echo($e_first_name)?>">
               </div>
               <div class="form-group">
                 <label for="last-name">Last Name:*</label>
                 <input type="text" id="last-name" name="last-name" class="form-control" placeholder="last Name" value="<?php echo($e_last_name)?>">
               </div>
                 
                
                
               <div class="form-group">
                 <label for="password">Password:*</label>
                 <input type="Password" id="password" name="password" class="form-control" placeholder="Password">
               </div>
             
               <div class="form-group">
                 <label for="image"> Profile-Picture:*</label>
                 <input type="file" name="image" id="image" >
               </div>
               <div class="form-group">
                 <label for="details"> details:*</label>
                 <textarea name="details" id="details" cols="30" rows="10" class="form-control"><?php echo $e_details; ?></textarea>
               </div>
               <input type="submit" name="submit" class="btn btn-primary" value="Update Profile">
             </form>
               </div>
               <div class="col-md-4">
                 <?php 
               
                  echo "<img src='img/$e_image' widht='100%' style='max-width:100%;max-hieght:300px;' class='img-circle'>";
                   # code...
             
                 ?>
               </div>
             </div>


             
               


          </div>
       </div>
    </div>
    <?php require_once 'inc/footer.php'; ?>