
  <?php 
      require_once('inc/top.php');
      
      if (!isset($_SESSION['username'])) {
        header('location:login.php');
        # code...
      }
      $session_username=$_SESSION['username'];
      $query="SELECT *FROM users where username='$session_username'";
            $run=mysqli_query($conn,$query);
            $row=mysqli_fetch_array($run);
                    
      $image=$row['image'];
      $id=$row['id'];
      $date=getdate($row['date']);
      $day=$date['mday'];
      $month=substr($date['month'], 0,3);
      $year=$date['year'];
      $first_name=$row['first_name'];
      $last_name=$row['last_name'];
      $username=$row['username'];
      $email=$row['email'];
      $role=$row['role'];
      $details=$row['details'];
 ?>
   </head> 
   <body id="profile">  

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
             <h1><i class="fa fa-user"></i>PROFILE<small>&nbsp;Personal Details</small></h1><hr>
             <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a> </li>
                <li><i class="fa fa-user"></i>Profile</li>
                   
             </ol> 
             <div class="row">
               <div class="col-xs-12">
                 <center><img src="img/<?php echo $image; ?>" width="250px" class="img-circle img-thumbnail" id="profile-image"></center><br>
             <a href="edit-profile.php?edit=<?php echo $id; ?>" class="btn btn-primary pull-right">Edit Profile</a><br><br>
             <center><h3>Profile Details</h3></center><br>
             <table class="table table-bordered">
               
               <tr>
                 <td width="20%"><b>User ID:</b></td>
                 <td width="30%"><?php echo $id; ?></td>
                 <td width="20%"><b>Signup Date:</b></td>
                 <td width="30%"><?php echo "$day $month $year"; ?></td>
               </tr>

                <tr>
                 <td width="20%"><b>first name:</b></td>
                 <td width="30%"><?php echo $first_name; ?></td>
                 <td width="20%"><b>last name:</b></td>
                 <td width="30%"><?php echo $last_name; ?></td>
               </tr>

                <tr>
                 <td width="20%"><b>User name:</b></td>
                 <td width="30%"><?php echo $username; ?></td>
                 <td width="20%"><b>email:</b></td>
                 <td width="30%"><?php echo $email; ?></td>
               </tr>
               <tr>
                 <td width="20%"><b>Role:</b></td>
                 <td width="30%"><?php echo $role; ?></td>
                 <td width="20%"><b></b></td>
                 <td width="30%"></td>
               </tr>

             </table>
             <div class="row">
               <div class="col-lg-8 col-sm-12">
                 <b>Details</b>
                 <div><?php echo $details; ?></div><br>
               </div>
             </div>

               </div>
             </div>

          </div>
       </div>
    </div>
<?php require_once 'inc/footer.php'; ?>