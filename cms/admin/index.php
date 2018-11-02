
  <?php 
      require_once('inc/top.php');
      if (!isset($_SESSION['username'])) {
        header('location:login.php');
        # code...
      }
      $comments_tag_query="SELECT * FROM comments where status='pending'";
      $catagory_tag_query="SELECT * FROM catagory";
      $users_tag_query="SELECT * FROM users ";
      $posts_tag_query="SELECT * FROM posts ";

      $com_tag_run=mysqli_query($conn,$comments_tag_query);
      $cat_tag_run=mysqli_query($conn,$comments_tag_query);
      $user_tag_run=mysqli_query($conn,$users_tag_query);
      $post_tag_run=mysqli_query($conn,$posts_tag_query);

      $com_rows =mysqli_num_rows($com_tag_run);
      $cat_rows= mysqli_num_rows($cat_tag_run);
      $user_rows= mysqli_num_rows($user_tag_run);
      $post_rows= mysqli_num_rows($post_tag_run);

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
             <h1 class="animated fadeInRight"><i class="fa fa-tachometer"></i>Dashboard<small>Statistics overview</small></h1><hr>
             <ol class="breadcrumb">
                <li class="active"><i class="fa fa-tachometer"></i>Dashboard </li>
                
             </ol>
             <div class="row tag-boxes ">
                <div class="col-md-6 col-lg-3">
                   <div class="panel panel-primary">
                      <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                             </div>
                            <div class="col-xs-9">
                               <div class="text-right huge"><?php echo "  $com_rows";  ?></div>
                               <div class="text-right">NEW Comments</div>
                            </div>
                      </div>
                     </div>
                        <a href="comments.php">
                           <div class="panel-footer">
                              <span class="pull-left">View all comments</span>

                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                           </div>
                        </a>
                   </div>
                </div>

                <div class="col-md-6 col-lg-3">
                   <div class="panel panel-red">
                      <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                            <i class="fa fa-file-text fa-5x"></i>
                             </div>
                            <div class="col-xs-9">
                               <div class="text-right huge"><?php echo "  $post_rows";  ?></div>
                               <div class="text-right">All post</div>
                            </div>
                      </div>
                     </div>
                        <a href="posts.php">
                           <div class="panel-footer">
                              <span class="pull-left">View all post</span>

                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                           </div>
                        </a>
                   </div>
                </div>

                <div class="col-md-6 col-lg-3">
                   <div class="panel panel-yellow">
                      <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                             </div>
                            <div class="col-xs-9">
                               <div class="text-right huge"><?php echo "  $user_rows";  ?></div>
                               <div class="text-right">All users</div>
                            </div>
                      </div>
                     </div>
                        <a href="users.php">
                           <div class="panel-footer">
                              <span class="pull-left">View all users</span>

                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                           </div>
                        </a>
                   </div>
                </div>

                <div class="col-md-6 col-lg-3">
                   <div class="panel panel-green">
                      <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                            <i class="fa fa-folder-open fa-5x"></i>
                             </div>
                            <div class="col-xs-9">
                               <div class="text-right huge"><?php echo "  $cat_rows";  ?></div>
                               <div class="text-right">All catagory</div>
                            </div>
                      </div>
                     </div>
                        <a href="catagory.php">
                           <div class="panel-footer">
                              <span class="pull-left">View all catagory</span>

                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                           </div>
                        </a>
                   </div>
                </div>
             </div>
             <hr>
             <?php
             $get_users_query="SELECT * FROM users ORDER BY id DESC LIMIT 5";
             $get_users_run=mysqli_query($conn,$get_users_query);
             if (mysqli_num_rows($get_users_run) > 0) {
              ?>
             <h3>New Users</h3>
             <table class="table table-hover table-strippd">
               <thead>
                  <tr>
                     <th>Sr</th>
                     <th>Date</th>
                     <th>Name</th>
                     <th>Username</th>
                     <th>Role</th> 
                  </tr>
               </thead>
               <tbody>
                <?php 
                while ($rows=mysqli_fetch_array($get_users_run)) {
                  $id=$rows['id'];
                  $date=getdate($rows['date']);
                  $day=$date['mday'];
                  $month=substr($date['month'], 0,3);
                  $year=$date['year'];
                  $first_name=ucfirst($rows['first_name']);
                  $last_name=ucfirst($rows['last_name']);
                  
                  $username=ucfirst($rows['username']);
                  $role=ucfirst($rows['role']);
                
                ?>
                   <tr>
                     <td><?php echo "$id"; ?></td>
                     <td><?php echo "$day $month $year"; ?></td>
                     <td><?php echo "$first_name  $last_name"; ?></td>
                     <td><?php echo "$username"; ?></td>
                     <td><?php echo "$role"; ?></td> 
                  </tr><?php } ?>
               </tbody>
                
             </table>
             <?php } ?>
             <a href="users.php" class="btn btn-primary">View All Users</a><hr>
             <?php
             $get_posts_query="SELECT * FROM posts ORDER BY id DESC LIMIT 5";
             $get_posts_run=mysqli_query($conn,$get_posts_query);
             if (mysqli_num_rows($get_posts_run) > 0) {
              ?>
             <h3>New Post</h3>
             <table class="table">
                <thead>
                   <th>sr</th>
                   <th>Date</th>
                   <th>Post Title</th>

                   <th>Category</th>
                   <th>views</th>
                   
                </thead>
                <tbody>
                  <?php 
                while ($rows=mysqli_fetch_array($get_posts_run)) {
                  $id=$rows['id'];
                  $pdate=getdate($rows['date']);
                  $pday=$pdate['mday'];
                  $pmonth=substr($pdate['month'], 0,3);
                  $pyear=$pdate['year'];
                  $post_title=ucfirst($rows['title']);
                  $catagory=ucfirst($rows['catagory']);
                  
                  $views=$rows['views'];
                
                
                ?>
                   <tr>
                     <td><?php echo "$id"; ?></td>
                     <td><?php echo "$pday $pmonth $pyear"; ?></td>
                     <td><?php echo "$post_title"; ?></td>
                     <td><?php echo "$catagory"; ?></td>
                     <td><i class="fa fa-eye"></i> <?php echo "$views"; ?></td> 
                  </tr>
                  <?php } ?>
                    
                </tbody>
             </table><?php } ?>
             <a href="posts.php"  class="btn btn-primary">View All POST</a>


          </div>
       </div>
    </div>
<?php require_once 'inc/footer.php'; ?>