 <?php
 require_once('inc/top.php'); 
  if (!isset($_SESSION['username'])) {
        header('location:login.php');
        # code...
      } 
      $session_username=$_SESSION['username'];
      $session_role=$_SESSION['role'];
 ?>
 <?php
 if (isset($_GET['del'])) {
      $del_id=$_GET['del'];
      if ($_SESSION['role']=='admin') {
         $del_check_query=" SELECT * FROM posts where id='$del_id' ";
      $del_check_run = mysqli_query($conn,$del_check_query);
        # code...
      }else if ($_SESSION['role']=='author') {
         $del_check_query=" SELECT * FROM posts where id='$del_id' and author='$session_username' ";
      $del_check_run = mysqli_query($conn,$del_check_query);

      }
      if (mysqli_num_rows($del_check_run) >0) {
         $del_query="DELETE FROM `posts` WHERE `posts`.`id`='$del_id'";
      if (mysqli_query($conn,$del_query)) {
           $msg="Post Has been Deleted";
        # code...
      }else{
         $error="Post Has not  been Deleted";
      }
       }else{
        header('location:index.php');
       }  
      }
        
      if (isset($_POST['checkboxes'])) {
        foreach ($_POST['checkboxes'] as $user_id) {
           $bulk_option=$_POST['bulk-options'];
           if ($bulk_option=='delete') {
            $bulk_del_query="DELETE FROM `posts` WHERE `posts`.`id`='$user_id'";
            mysqli_query($conn,$bulk_del_query);
             # code...
           }elseif ($bulk_option=='publish') {

             $bulk_author_query="UPDATE `posts` SET `status` = 'publish' WHERE `posts`.`id` ='$user_id' ";
             mysqli_query($conn,$bulk_author_query);
             # code...
           }elseif ($bulk_option=='draft') {
             $bulk_admin_query="UPDATE `posts` SET `status` = 'draft' WHERE `posts`.`id` ='$user_id' ";
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
             <h1 class="animated fadeInUp"><i class="fa fa-file"></i> Posts<small> View All Posts</small></h1><hr>
             <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                <li class="active"><i class="fa fa-file"> </i> Posts </li>
                
             </ol> 


             <?php 
             if ( $session_role=='admin') {
              $query="SELECT * from posts order by id desc ";
             $run=mysqli_query($conn,$query);
               # code...
             }else if( $session_role=='author') {
                  $query="SELECT * from posts WHERE author='$session_username' order by id desc ";
             $run=mysqli_query($conn,$query);
             }
              if (mysqli_num_rows($run) > 0)  {
             ?>
              <form action="" method="post">
              <div class="row">
                <div class="col-sm-8">
                 
                    <div class="row">
                      <div class="col-xs-4">
                        <div class="form-group">
                          <select name="bulk-options" id="" class="form-control">
                            <option value="delete">Delete</option>
                            <option value="publish">Publish</option>
                            <option value="draft">Draft</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-8">
                        <input type="submit" name="" class="btn btn-primary" value="Apply">
                        <a href="add-post.php" class="btn btn-primary">Add New</a>
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
                  <th>Title</th>
                  <th>Author</th>
                  <th>Image</th>

                  <th>Categories</th>
                  <th>Views</th>
                  <th>Status</th>
                   

                  
                  <th>Edit</th>
                  <th>del</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  while ($row=mysqli_fetch_array($run)) {
                    $id=$row['id'];
                    $date=getdate($row['date']);
                    $day = $date['mday'];
                    $month =substr($date['month'], 0,3);
                    $year =$date['year'];
                    $title=$row['title'];
                    
                    $author=$row['author'];
                    
                    $image=$row['image'];
                    $catagory=$row['catagory'];
                    $views=$row['views'];
                    $status=$row['status'];
                    # code...
               
                  ?>

                  <tr>
                    <td><input type="checkbox" name="checkboxes[]" value="<?php  echo($id); ?>" class="checkboxes"></td>
                  <td><?php echo$id; ?></td>
                  <td><?php echo$day; ?> <?php echo$month; ?> <?php echo$year; ?></td>
                  <td><?php echo"$title"; ?></td>
                  <td><?php echo$author; ?></td>
                  
                  <td><img src="img/<?php echo $image; ?>" width="30px"></td>
                <td><?php echo $catagory; ?></td>
                <td><?php echo$views; ?></td>
                  <td><span style="color:<?php if ($status=='publish') {
                    echo "green";
                    # code...
                  } elseif ($status=='draft') {
                    echo "red";
                    # code...
                  }?> ;"><?php echo ucfirst($status); ?></span</td>
                  <td><a href="edit-post.php?edit=<?php echo$id; ?>"><i class="fa fa-pencil"></i></a></td>
                  <td><a href="posts.php?del=<?php echo$id; ?>"><i class="fa fa-times"></i></a></td>
                  </tr>
                  <?php }
                  ?>
                     </form>
                    
                </tbody>
              </table>
              <?php
              }else{
              echo "<center><h2>NO  Posts Available   $session_role  Now</h2></center";
             }
               ?>
             


          </div>
       </div>
    </div>
    <?php require_once 'inc/footer.php'; ?>