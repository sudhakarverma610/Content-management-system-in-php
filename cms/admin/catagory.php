   <?php
 require_once('inc/top.php'); 
  if (!isset($_SESSION['username'])) {
        header('location:login.php');
        # code...
      }elseif (isset($_SESSION['username']) && $_SESSION['role']=='author') {
        header('location:index.php');
        # code...
      }
      if (isset($_GET['edit'])) {
        $edit_id=$_GET['edit'];
      }
      if (isset($_GET['del'])) {
        $del_id=$_GET['del'];
      if (isset($_SESSION['username']) && $_SESSION['role']=='admin' ){
           $del_query="DELETE FROM catagory where id ='$del_id'";
        if (mysqli_query($conn,$del_query)) {
          $del_msg="Catagory Has Been DELETED";
         
          # code...
        }else{
           $del_error="Catagory Has Not Been DELETED";
        }
        # code...
      }
        # code...
      }

      if (isset($_POST['submit'])) {
        $cat_name=mysqli_real_escape_string($conn,strtolower($_POST['cat-name']));
      
      if (empty($cat_name)) {
        $error="Must Fill this field";
          # code...
        }else{
            $check_query="SELECT * FROM catagory where catagory='$cat_name'";
        $check_run=mysqli_query($conn,$check_query);
        if (mysqli_num_rows($check_run) > 0) {
          $error="Catagory Already Exist";
          # code...
        }else{
          $insert_query="INSERT INTO catagory (catagory)
          VALUES ('$cat_name')"; 
          if (mysqli_query($conn,$insert_query)) {
            $msg="Catagory Has Been Added";
            # code...
          }else{

            $error="Catagory Has Not Been Added";
          }

        }
      
        }  # code...
      }

      //end of submit add query
       if (isset($_SESSION['username']) && $_SESSION['role']=='admin' ){
      if (isset($_POST['update'])) {
        $cat_name=mysqli_real_escape_string($conn,strtolower($_POST['cat-name']));
      
      if (empty($cat_name)) {
        $up_error="Must Fill this field";
          # code...
        }else{
            $check_query="SELECT * FROM catagory where catagory='$cat_name'";
        $check_run=mysqli_query($conn,$check_query);
        if (mysqli_num_rows($check_run) > 0) {
          $up_error="Catagory Already Exist";
          # code...
        }else{
          $update_query="UPDATE `catagory` SET `catagory` = '$cat_name' WHERE `catagory`.`id` =$edit_id LIMIT 1 "; 
          if (mysqli_query($conn,$update_query)) {
            $up_msg="Catagory Has Been UPDATED";
            # code...
          }else{

            $up_error="Catagory Has Not Been  UPDATED";
          }

        }
      
        }  # code...
      }//end of update query
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
             <h1 class="animated fadeInRight"><i class="fa fa-folder-open"></i>Catagories <small> Different Catagories</small></h1><hr>
             <ol class="breadcrumb">
                <li><a href="index.html"><i class="fa fa-tachometer"></i> Dashboard</a> </li>
                 <li class="active"><i class="fa fa-folder-open"></i>catagories </li>
                
             </ol> 
             <div class="row">
               <div class="col-md-6">
                 <form action="" method="post">
                  <div class="form-group">
                     <label for="Catagory">Add New Catagory Name</label>
                     <?php 
                     if (isset($msg)) {
                      echo "
                     <span class='pull-right' style='color: green'>$msg</span>";
                       # code...
                     }elseif (isset($error)) {
                      echo "
                     <span class='pull-right' style='color: red'>$error</span>";
                       # code...
                     }
                     ?>
                     <input type="text" name="cat-name" placeholder="catagory name" class="form-control">
                  </div>
                  <input type="submit" name="submit" value="Add Catagory" class="btn btn-primary">
                   
                 </form>
                  <?php
                  if (isset($_GET['edit'])) {
                    $edit_check_query="SELECT * FROM catagory where id='$edit_id'";
                    $edit_check_run=mysqli_query($conn,$edit_check_query);
                    if (mysqli_num_rows(  $edit_check_run) > 0) {
                      $edit_row=mysqli_fetch_array($edit_check_run);
                      $up_catagory=$edit_row['catagory'];
                    
                  ?>

                  <hr>
                 <form action="" method="post">
                  <div class="form-group">
                     <label for="Catagory">Update Catagory Name</label>
                     <?php 
                     if (isset($up_msg)) {
                      echo "
                     <span class='pull-right' style='color: green'>$up_msg</span>";
                       # code...
                     }elseif (isset($up_error)) {
                      echo "
                     <span class='pull-right' style='color: red'>$up_error</span>";
                       # code...
                     }
                     ?>
                     <input type="text" name="cat-name" placeholder="catagory name" class="form-control" value="<?php echo($up_catagory);?>">
                  </div>
                  <input type="submit" name="update" value="Update Catagory" class="btn btn-primary">
                   
                 </form>
                 <?php 
                    # code...
                    }

                    # code...
                  }
                 ?>
               </div>

               <div class="col-md-6"><br>
                <?php 
                $get_query="SELECT *FROM catagory ORDER BY id DESC";
                  $get_run=mysqli_query($conn,$get_query);
                  if (mysqli_num_rows($get_run) > 0) {
                      if (isset($del_msg)) {
                      echo "
                     <span class='pull-right' style='color: green'>$del_msg</span>";

                       # code...
                     }elseif (isset($del_error)) {
                      echo "
                     <span class='pull-right' style='color: red'>$del_error</span>";
                       # code...
                     }

                ?>
                 <table class="table table-hover table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>sr #</th>
                       <th>Catagory Name</th>
 

                       <th>Edit</th>
                       <th>Del</th>
                     </tr>
                   </thead>
                   <tbody>
                    <?php
                    $count=1;
                    while ($get_row=mysqli_fetch_array($get_run)) {
                      $catagory_id=$get_row['id'];
                      $catagory_name=$get_row['catagory'];
                    
                    ?>
                     <tr>
                       <td><?php echo $count; ?></td>
                       <td><?php echo ucfirst($catagory_name); ?></td>
                       
                       <td><a href="catagory.php?edit=<?php echo $catagory_id; ?>"><i class="fa fa-pencil"></i> </a></td>

                       <td><a href="catagory.php?del=<?php echo $catagory_id; ?>"><i class="fa fa-times"></i> </a></td>
                     </tr>
                     <?php 
                     $count=$count+1;
                   }
                     ?>
                     
                   </tbody>
                 </table>
                 <?php
                  # code...
                  }
                  else{
                    echo "<center>NO Categories Found</center>";
                  }
                 ?>
               </div>
             </div>
              
             


          </div>
       </div>
    </div>
    <?php require_once 'inc/footer.php'; ?>