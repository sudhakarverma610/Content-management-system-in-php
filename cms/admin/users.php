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
 <?php
 if (isset($_GET['del'])) {
      $del_id=$_GET['del'];
       $del_check_query=" SELECT * FROM users where id='$del_id' ";
      $del_check_run = mysqli_query($conn,$del_check_query);
      if (mysqli_num_rows($del_check_run) >0) {
         $del_query="DELETE FROM `users` WHERE `users`.`id`='$del_id'";

          if ((isset($_SESSION['username'])) && $_SESSION['role']=='admin') {
          if (mysqli_query($conn,$del_query)) {
           $msg="User Has been Deleted";
        # code...
      }else{
         $error="User Has not  been Deleted";
      }
        # code...
      }
        # code...
      }else{
        header('location:index.php');
      }


      # code...
          }// end of delete query
      if (isset($_POST['checkboxes'])) {
        foreach ($_POST['checkboxes'] as $user_id) {
           $bulk_option=$_POST['bulk-options'];
           if ($bulk_option=='delete') {
            $bulk_del_query="DELETE FROM ``users` WHERE `users`.`id`='$user_id'";
            mysqli_query($conn,$bulk_del_query);
             # code...
           }elseif ($bulk_option=='author') {

             $bulk_author_query="UPDATE `users` SET `role` = 'author' WHERE `users`.`id` ='$user_id' ";
             mysqli_query($conn,$bulk_author_query);
             # code...
           }elseif ($bulk_option=='admin') {
             $bulk_admin_query="UPDATE `users` SET `role` = 'admin' WHERE `users`.`id` ='$user_id' ";
             mysqli_query($conn,$bulk_admin_query);
             # code...
           }

          # code...
        }
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
             <h1 class="animated fadeInUp"><i class="fa fa-users"></i> Users<small> View All users</small></h1><hr>
             <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                <li class="active"><i class="fa fa-users"> </i> Users </li>
                
             </ol> 


             <?php 
             $query="select * from users order by id desc ";
             $run=mysqli_query($conn,$query);
              if (mysqli_num_rows($run) > 0)  {
               
               # code...


             ?>
              <form action="" method="post">
              <div class="row">
                <div class="col-sm-8">
                 
                    <div class="row">
                      <div class="col-xs-4">
                        <div class="form-group">
                          <select name="bulk-options" id="" class="form-control">
                            <option value="delete">Delete</option>
                            <option value="author">change to author</option>
                            <option value="admin">change to admin</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-8">
                        <input type="submit" name="" class="btn btn-primary" value="Apply">
                        <a href="add-user.php" class="btn btn-primary">Add New</a>
                      </div>
                    </div>
                 
                </div>
              </div>
              <?php
              if (isset($error)) {
                echo "<span class='pull-right' style='color:red'>$error</span>";
                # code...
              }elseif (isset($msg)) {

                echo "<span class='pull-right' style='color:green'>$msg</span>";
                # code...
              }
              ?>
              <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th><input type="checkbox" id="selectallboxes" ></th>
                  <th>Sr #</th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>User Name</th>

                  <th>Email</th>
                  <th>Image</th>
                  <th>Password</th>
                  <th>Role</th>

                  
                  <th>Edit</th>
                  <th>del</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  while ($row=mysqli_fetch_array($run)) {
                    $id=$row['id'];
                    $first_name=ucfirst($row['first_name']);
                    $last_name=ucfirst($row['last_name']);
                    $email=$row['email'];
                    $username=$row['username'];
                    $role=$row['role'];
                    $image=$row['image'];
                    $date=getdate($row['date']);
                    $day = $date['mday'];
                    $month =substr($date['month'], 0,3);
                    $year =$date['year'];
                    # code...
               
                  ?>

                  <tr>
                    <td><input type="checkbox" name="checkboxes[]" value="<?php  echo($id); ?>" class="checkboxes"></td>
                  <td><?php echo$id; ?></td>
                  <td><?php echo$day; ?> <?php echo$month; ?> <?php echo$year; ?></td>
                  <td><?php echo"$first_name $last_name"; ?></td>
                  <td><?php echo$username; ?></td>
                  <td><?php echo$email; ?></td>
                  <td><img src="img/<?php echo$image; ?>" width="30px"></td>
                  <td>*******</td>
                  <td><?php echo ucfirst($role); ?></td>
                  <td><a href="edit-user.php?edit=<?php echo$id; ?>"><i class="fa fa-pencil"></i></a></td>
                  <td><a href="users.php?del=<?php echo$id; ?>"><i class="fa fa-times"></i></a></td>
                  </tr>
                  <?php }
                  ?>
                     </form>
                    
                </tbody>
              </table>
              <?php
              }else{
              echo "<center><h2>NO Users Available Now</h2></center";
             }
               ?>
             


          </div>
       </div>
    </div>
    <?php require_once 'inc/footer.php'; ?>