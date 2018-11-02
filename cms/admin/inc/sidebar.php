<?php 
$session_role1=$_SESSION['role'];
$get_comment="SELECT * FROM comments WHERE status='pending'";
$get_comment_run=mysqli_query($conn,$get_comment);
$num_of_rows=mysqli_num_rows($get_comment_run);
?>

<div class="list-group">
                <a href="index.php" class="list-group-item active">
                <i class="fa fa-tachometer"></i> Dashboard
                </a>
                <a href="posts.php" class="list-group-item">
                  <i class="fa fa-file-text"></i> All post
                   </a>
                   <a href="media.php" class="list-group-item">
                  <i class="fa fa-database"></i> Media
                  </a>
                  <?php 
                  if ($session_role1=='admin') {
                  ?>
                <a href="comments.php" class="list-group-item">
                   <span class="badge"><?php 
                   if($num_of_rows >0){
                    echo $num_of_rows; }?></span>
                   <i class="fa fa-comment"></i>
                comments</a>
                <a href="catagory.php" class="list-group-item">
                   
                   <i class="fa fa-folder-open"></i>
                catagory</a>
                 <a href="users.php" class="list-group-item">
                   
                   <i class="fa fa-users"></i>
                  users</a><?php }?>
             </div>