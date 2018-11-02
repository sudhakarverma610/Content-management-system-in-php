
  <?php 
      require_once('inc/top.php');
      if (!isset($_SESSION['username'])) {
        header('location:login.php');
        # code...
      }
      $session_username=$_SESSION['username'];
      $session_author_image=mysqli_real_escape_string($conn,$_SESSION['author_image']);
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
             <h1 class="animated fadeInRight"><i class="fa fa-plus-square"></i>Add post<small>&nbsp;Add New Post</small></h1><hr>
             <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-tachometer"></i>Dashboard </a></li>
                <li class="active" ><i class="fa fa-plus-square"></i>Add Post </li>
                
             </ol>
             <?php 
             if (isset($_POST['submit'])) {
               $date=time();
               $title=mysqli_real_escape_string($conn,$_POST['title']);
               $post_data=mysqli_real_escape_string($conn,$_POST['post-data']);
               $catagory=$_POST['catagory'];
               $tags=mysqli_real_escape_string($conn,$_POST['tags']);
               $status=$_POST['status'];
               $image=$_FILES['image']['name'];
               $tmp_name=$_FILES['image']['tmp_name'];
               if (empty($title) or empty($post_data) or empty($tags) or empty($image)) {
                $error="All (*) fields are required";
                 # code...
               }else{
                $insert_query="INSERT INTO posts (date,title,author,author_image,image,catagory,tags,post_data,views,status) VALUES ('$date','$title','$session_username','$session_author_image','$image','$catagory','$tags','$post_data','0','$status')";
                if (mysqli_query($conn,$insert_query)) {
                  $msg="post has been added";
                  $path="img/$image";
                  $title="";
                  $tags="";
                  $catagory="";
                  $post_data="";
                  $status="";
                 if (move_uploaded_file($tmp_name, $path)) {
                   copy($path, "../$path");
                                      # code...
                 }
                  # code...
                }else{
                  $error="post has not been added";
                }
               }
               # code...
             }
             ?>
             <div class="row">
               <div class="col-xs-12">
                 <form action="" method="post" enctype="multipart/form-data">
                   <div class="form-group">
                     <label for="title">Title:*</label>
                     <?php
                     if (isset($msg)) {
                      echo "<span class='pull-right' style='color:green'>$msg</span>";
                        # code...
                      }else if (isset($error)) {
                      echo "<span class='pull-right' style='color:red'>$error</span>"; }?>
                     <input type="text" name="title" placeholder="Type post Title Here" value="<?php if(isset($title)){ echo($title);} ?>" class="form-control">
                   </div>
                   <div class="form-group">
                     <a href="media.php" class="btn btn-primary">Add Media</a>
                   </div>
                   <div class="form-group">
                      <textarea name="post-data" id="textarea" rows="10" class="form-control"><?php if(isset($post_data)){ echo($post_data);} ?></textarea>
                   </div>
                   <div class="row">
                     <div class="col-sm-6">
                       <div class="form-group">
                     <label for="file">Post Image:*</label>
                     <input type="file" name="image">
                   </div>
                     </div>
                     <div class="col-sm-6">
                       <div class="form-group">
                     <label for="catagory">Catagories:*</label>
                      <select class="form-control" name="catagory">
                        <?php $cat_query="SELECT * FROM catagory ORDER BY id DESC" ;
                        $cat_run=mysqli_query($conn, $cat_query);
                        if (mysqli_num_rows($cat_run) > 0) {
                          while ( $cat_row=mysqli_fetch_array($cat_run)) {
                            $cat_name=$cat_row['catagory'];
                            # code...
                           ?>
                       <option value="<?php echo$cat_name; ?>"
                           <?php if (isset($catagory) and $catagory==$cat_name) {echo "selected";
                        } ?> ><?php echo ucfirst($cat_name); ?></option>
                        <?php }
                         }else { ?>
                         <option> NO Catagories Avaible </option>
                         <?php
                         }?>
                      </select>
                   </div>
                     </div>
                   </div>

                    <div class="row">
                     <div class="col-sm-6">
                       <div class="form-group">
                     <label for="tags">Tags:*</label>
                     <input type="text" name="tags" placeholder="Your Tags Here" class="form-control" value="<?php if(isset($tags)){ echo($tags);} ?>">
                   </div>
                     </div>
                     <div class="col-sm-6">
                       <div class="form-group">
                     <label for="catagory">Status:*</label>
                      <select class="form-control" name="status" id="status">
                        <option value="publish" <?php if (isset($status) and $status=='publish') {echo "selected";
                        } ?> >publish</option>
                        <option value="draft" <?php if (isset($status) and $status=='draft') {echo "selected";
                        } ?> >draft </option>
                      </select>
                   </div>
                     </div>
                   </div>
                   <input type="submit" name="submit" value="Add Post" class="btn btn-primary">
                 </form>
               </div>
             </div>


          </div>
       </div>
    </div>
<?php require_once 'inc/footer.php'; ?>