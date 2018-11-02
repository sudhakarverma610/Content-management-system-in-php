     <?php
     require_once('inc/top.php'); 
      if (!isset($_SESSION['username'])) {
            header('location:login.php');
            # code...
          }elseif (isset($_SESSION['username']) && $_SESSION['role']=='author') {
            header('location:index.php');
            # code...
          }
          $session_username=$_SESSION['username'];
     ?>
     <?php
    if (isset($_GET['del'])) {
      $del_id=$_GET['del'];
       $del_check_query=" SELECT * FROM comments where id='$del_id' ";
      $del_check_run = mysqli_query($conn,$del_check_query);
      if (mysqli_num_rows($del_check_run) >0) {
         $del_query="DELETE FROM `comments` WHERE `comments`.`id`='$del_id'";

          if ((isset($_SESSION['username'])) && $_SESSION['role']=='admin') {
          if (mysqli_query($conn,$del_query)) {
           $msg="Comment Has been Deleted";
        # code...
      }else{
         $error="Comment Has not  been Deleted";
      }
        # code...
      }
        # code...
      }else{
        header('location:index.php');
      }


      # code...
    }//end of deleted query

      if (isset($_GET['approve'])) {
        $approve_id=$_GET['approve'];
         $approve_check_query=" SELECT * FROM comments where id='$approve_id' ";
        $approve_check_run = mysqli_query($conn,$approve_check_query);
        if (mysqli_num_rows($approve_check_run) >0) {
           $approve_query="UPDATE `comments` SET `status` = 'approve' WHERE `comments`.`id` ='$approve_id'";

            if ((isset($_SESSION['username'])) && $_SESSION['role']=='admin') {
            if (mysqli_query($conn,$approve_query)) {
             $msg="Comment Has been Approved";
          # code...
        }else{
           $error="comment Has not been Approved";
        }
          # code...
        }
          # code...
        }else{
          header('location:index.php');
        }


        # code...
      }//end of approve query
      if (isset($_GET['unapprove'])) {
        $unapprove_id=$_GET['unapprove'];
         $unapprove_check_query=" SELECT * FROM comments where id='$unapprove_id' ";
        $unapprove_check_run = mysqli_query($conn,$unapprove_check_query);
        if (mysqli_num_rows($unapprove_check_run) >0) {
           $unapprove_query="UPDATE `comments` SET `status` = 'pending' WHERE `comments`.`id` ='$unapprove_id'";

            if ((isset($_SESSION['username'])) && $_SESSION['role']=='admin') {
            if (mysqli_query($conn,$unapprove_query)) {
             $msg="Comment Has been UnApproved";
          # code...
        }else{
           $error="comment Has not been UnApproved";
        }
          # code...
        }
          # code...
        }else{
          header('location:index.php');
        }


        # code...
      }//end of unapprove query

    if (isset($_POST['checkboxes'])) {
      foreach ($_POST['checkboxes'] as $user_id) {
         $bulk_option=$_POST['bulk-options'];
         if ($bulk_option=='delete') {
          $bulk_del_query="DELETE FROM `comments` WHERE `comments`.`id`='$user_id'";
          mysqli_query($conn,$bulk_del_query);
           # code...
         }elseif ($bulk_option=='approve') {

           $bulk_author_query="UPDATE `comments` SET `status` = 'approve' WHERE `comments`.`id` ='$user_id' ";
           mysqli_query($conn,$bulk_author_query);
           # code...
         }elseif ($bulk_option=='pending') {
           $bulk_admin_query="UPDATE `comments` SET `status` = 'pending' WHERE `comments`.`id` ='$user_id' ";
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
             <h1 class="animated fadeInRight"><i class="fa fa-comments"></i> Comments<small> View All Comments</small></h1><hr>
             <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                <li class="active"><i class="fa fa-comments"> </i> Comments </li>
                
             </ol> 
             <?php
             if (isset($_GET['reply'])) {
              $reply_id=$_GET['reply'];
              $reply_check="SELECT * FROM comments where post_id=$reply_id";
              $reply_check_run=mysqli_query($conn,$reply_check);
              if (mysqli_num_rows($reply_check_run) > 0) {
                # code...
                if (isset($_POST['reply'])) {
                  $comment_data=$_POST['comment'];
                  if (empty($comment_data)) {
                    $comment_error="Must Fill This Field";
                    # code...
                  }else{
                    $get_user_data="SELECT * FROM users WHERE username='$session_username'";
                    $get_user_run=mysqli_query($conn,$get_user_data);
                    $get_user_row = mysqli_fetch_array($get_user_run);
                    $date=time();
                    $first_name=$get_user_row['first_name'];
                    $last_name=$get_user_row['last_name'];
                    $full_name="$first_name $last_name";
                    $email=$get_user_row['email'];
                    $image=$get_user_row['image'];
                    $insert_comment_query="INSERT INTO  comments (date,name,username,post_id,email,image,comment,status) values ('$date','$full_name','$session_username','$reply_id','$email','$image','$comment_data','approve')";
                    if (mysqli_query($conn,$insert_comment_query)) {
                      $comment_msg="Comment has been submited";
                      header('location:comments.php');
                      # code...
                    }else{
                       $comment_error="Comment has not been submited";
                    }
                  }
                  # code...
                }
              
             ?>
             <div class="row">
               <div class="col-md-6 col-lg-6 col-sm-8 col-xs-12">
                 <form action="" method="post">
                  <div class="form-group">
                    <label for="comment">Comment:*</label>
                    <?php
                    if (isset($comment_error)) {
                      echo "
                      <span class='pull-right' style='color: red'>$comment_error</span>";
                      # code...
                    }

                    elseif (isset($comment_msg)) {
                      echo "
                      <span class='pull-right' style='color: green'>$comment_msg</span>";
                      # code...
                    }
                    ?>
                    <textarea name="comment" cols="30"
                    rows="10" id="comment" placeholder="Your Comment is here" class="form-control"></textarea>
                    <input type="submit" name="reply" class="btn btn-primary">
                  </div>                   
                 </form>
                 <hr>
               </div>
             </div>


             <?php 
             }
               # code...
             }
             $query="select * from comments order by id desc ";
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
                            <option value="approve">Approve</option>
                            <option value="pending">UnApprove</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-8">
                        <input type="submit" name="" class="btn btn-primary" value="Apply">
                         
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
                  
                  <th>User Name</th>
                  <th>Comments</th>
                  <th>Status</th>
                  <th>Approve</th>
                  <th>UnApprove</th>
                  <th>Reply</th>
                  <th>del</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  while ($row=mysqli_fetch_array($run)) {
                    $id=$row['id'];
                     
                    $username=$row['username'];
                     $status=$row['status'];
                      $comment=$row['comment'];
                      $post_id=$row['post_id'];
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
                   
                  <td><?php echo$username; ?></td>
                  <td><?php echo$comment; ?></td>
                  <td><span style="color:<?php if ($status =='approve') {
                    echo "green";
                    # code...
                  } elseif ($status =='pending') {
                    echo "red";
                    # code...
                  }?> ;"><?php echo ucfirst($status); ?></span></td>
                   
                  <td><a href="comments.php?approve=<?php echo$id; ?>">Approve</a></td>
                    <td><a href="comments.php?unapprove=<?php echo$id; ?>">UnApprove</a></td>
                   <td><a href="comments.php?reply=<?php echo$post_id; ?>"><i class="fa fa-reply"></i></a></td>
                  <td><a href="comments.php?del=<?php echo$id; ?>"><i class="fa fa-times"></i></a></td>
                 
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