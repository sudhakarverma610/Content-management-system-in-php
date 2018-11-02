<?php 
require_once('inc/top.php');
?>
  
 </head> 
 <body>  
  <?php 
require_once('inc/header.php');
?>
  <?php 
  if (isset($_GET['post_id'])) {
     $post_id=$_GET['post_id'];
     $views_query="UPDATE `posts` SET `views` = views+1 WHERE `posts`.`id` =$post_id ";
     mysqli_query($conn,$views_query);
      $query="select *from posts where status='publish' and id=$post_id";
      $run=mysqli_query($conn, $query);
      if (mysqli_num_rows($run) > 0) {
      $row=mysqli_fetch_array($run);
      $id=$row['id'];
      $date=getdate($row['date']);
      $day=$date['mday'];
      $month=$date['month'];
      $year=$date['year'];
      $title=$row['title'];
      $image=$row['image'];
      $author_image=$row['author_image'];
      $author=$row['author'];
      $catagory=$row['catagory'];
      $post_data=$row['post_data'];
  # code...
}else{
  header('location:index.php');
}
    # code...
  }
  ?>
        <div class="jumbotron">
          <div class="container">
              <div id="details" class="animated fadeInLeft">
                <h1>custom<span>&nbsp;post</span></h1>
                <p>here you can put your own tag line to make it more attractive </p>
              </div><!--end of datails-->
          </div><!--end of container-->
           <img src="img/image.jpg">
        </div><!--end of jumbodron-->

        <section>
          <div class="container">
            <div class="row">
              <div class="col-md-8">

              <div class="post">
                <div class="row">
                 <div class="col-md-2 post-date">
                     <div class="day"><?php echo $day; ?></div>
                       <div class="mounth"><?php echo $month; ?></div>
                     <div class="year"><?php echo $year; ?></div>
                 </div>

                 <div class="col-md-8 post-title">
                   <a href="post.php?post_id=<?php echo $id; ?>">
                      <h2><?php echo $title; ?></h2>
                     </a>
                    <p>written by:<span><?php echo ucfirst($author); ?></span></p>
                 </div>

                  <div class="col-md-2 profile-picture">
                    <img src="img/<?php echo $author_image; ?>" class="img-circle" width="100%">
                  
                 </div>
              </div>
              <a href="img/<?php echo $image; ?>"><img src="img/<?php echo $image; ?>" alt="post-image"></a>
              <div class="desc">
               <?php echo $post_data; ?>
              </div>
              
             <div class="bottom">
                  <span><i class="fa fa-folder"></i><a href="#"><?php echo ucfirst($catagory); ?></a></span>
                  <span><i class="fa fa-comment"></i><a href="#">comment</a></span>
                </div>
            
            </div>

            <div class="releted-posts">
               <h3>Releted post</h3><hr>
              <div class="row">
                <?php 
                $r_query="select * from posts where status='publish' and title like '%$title%' limit 3";
                $r_run=mysqli_query($conn,$r_query);
                while ($r_row=mysqli_fetch_array($r_run)) {
                  $r_id=$r_row['id']; 
                  $r_title=$r_row['title'];
                  $r_image=$r_row['image'];
                  # code...
                
                ?>

                <div class="col-sm-4">
                  <a href="post.php?post_id=<?php echo($r_id); ?>"><img src="img/<?php echo($r_image); ?>">
                    <h4><?php echo($r_title); ?></h4>
                    </a>
                </div>

                <?php
                 }
                ?> 
                 
              </div>

            </div>
            <div class="author">
              <div class="row">
                <div class="col-sm-3">
                  <img src="img/<?php echo($author_image); ?>" alt="image" class="img-circle" width="100%">
                 
                </div>

                <div class="col-sm-9">
                   <h4><?php echo ucfirst($author); ?></h4>
                   <?php 
                    $bio_query="SELECT * from users where username='$author'";
                   $bio_run=mysqli_query($conn,$bio_query);
                   if (mysqli_num_rows($bio_run) > 0) {
                     # code...
                    $bio_row=mysqli_fetch_array($bio_run);
                    $author_details=$bio_row['details'];
                   
                   ?> 
              <p><?php echo $author_details; ?> </p> 

               <?php } ?>
                </div>
            
           </div>
          </div>
          <?php 
          $c_query="SELECT *from comments where status='approve' and post_id=$post_id order by id desc";
          $c_run=mysqli_query($conn,$c_query);
          if (mysqli_num_rows($c_run) > 0) {
            ?>
             <div class="comment" >
                <h3 >comments</h3><hr>
                <?php 
                while ($c_row=mysqli_fetch_array($c_run)) {
                  $c_id=$c_row['id'];
                  $c_name=$c_row['name'];
                  $c_username=$c_row['username'];
                  $c_image=$c_row['image'];
                  $c_comment=$c_row['comment'];
                  # code...
                
                ?>
                <div class="row">
                <div class="col-sm-3">
                <img src="img/<?php echo($c_image);  ?>" style="width: 100%;" class="img-circle">
                </div>
                <div class="col-sm-9">
                <h4><?php echo ucfirst($c_name);  ?></h4>
                <p><?php echo($c_comment);  ?></p>
                </div>
                </div>
                  <?php 
                }
                  ?>
             </div>
          <?php
                        # code...
          }
          if (isset($_POST['submit'])) {
            $cs_name=$_POST['name'];
            $cs_email=$_POST['email'];
            $cs_website=$_POST['website'];
            $cs_comment=$_POST['comment'];
            $cs_date=time();
            if (empty($cs_name) or empty($cs_email) or empty($cs_comment)){
              $error_msg="All (*) feilds are required";
              # code...
            }else{
              $cs_query="INSERT INTO  `comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `website`, `image`, `comment`, `status`) VALUES (NULL, '$cs_date', '$cs_name', 'user', '$post_id', '$cs_email', '$cs_website', 'IMG20171014122109.jpg', '$cs_comment', 'pendding')";
              if (mysqli_query($conn,$cs_query)) {
                $msg="comment Submited and waiting for approval";
                $cs_name="";
                $cs_email="";
                $cs_website="";
                $cs_comment="";

                # code...
              }else{
                $error_msg="comment has not be Submited";
              }
            }
            # code...
          }
           ?>
         
          <div class="comment-box">
            <div class="row">
              <div class="col-xs-12">
                <form action="" method="post">
                  <div class="form-group">
                    <label for="full-name">Full name:*</label>
                    <input type="text" id="full-name" value="<?php if(isset($cs_name)){ echo($cs_name);} ?>" name="name" class="form-control" placeholder="full name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email address:*</label>
                    <input type="text" id="email" value="<?php if(isset($cs_email)){ echo($cs_email);} ?>" name="email" class="form-control" placeholder="full email address">
                  </div>
                  <div class="form-group">
                    <label for="website">website:</label>
                    <input type="text" value="<?php if(isset($cs_website)){ echo($cs_website);} ?>" id="website" name="website" class="form-control" placeholder="website url">
                  </div>
                  <div class="form-group">
                        <label for="comments">commments</label>
                        <textarea id="commments" cols="30" rows="10" class="form-control" placeholder="your commments should be here" style="resize: none;" name="comment"><?php if(isset($cs_comment)){ echo($cs_comment);} ?></textarea>
                      </div>
                      <input type="submit" name="submit" value="submit commments" class="btn btn-primary">
                      <?php 
                      if (isset($error_msg)) {
                        
                          echo "<span style='color:red;' class='pull-right'>$error_msg</span>";                        # code...
                      }elseif (isset($msg)) {
                        echo "<span style='color:green;' class='pull-right'>$msg</span>";    
                        # code...
                      }
                      ?>
                </form>
              </div>


             
            </div>
          </div>



              </div><!--end of class col-md-8-->

              <div class="col-md-4">
                  <?php 
                    require_once('inc/sidebar.php');
                    ?>
  
              </div>
            </div>
          </div>
        </section>
          <?php 
                    require_once('inc/footer.php');
                    ?>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
 <script src="https://code.jquery.com/jquery.js"></script> 
 <!-- Include all compiled plugins (below), or include individual files as 
needed --> 
 <script src="js/bootstrap.min.js"></script> 
 <script src="offcanvas.js"></script>
 </body
 </html>