<?php 
  require_once('inc/top.php');
?>
</head> 
 <body>  
 	 <?php 
      require_once('inc/header.php');
      $number_of_posts=2;
      if (isset($_GET['page']) ){
        $page_id=$_GET['page'];  
      }else{
        $page_id=1;
      }
      if (isset($_GET['cat'])) {
         $cat_id=$_GET['cat'];
         $cat_query="SELECT *FROM catagory WHERE id = $cat_id";
         $cat_run=mysqli_query($conn,$cat_query);
         $cat_row=mysqli_fetch_array($cat_run);
         $cat_name=$cat_row['catagory'];  # code...
      }
      if (isset($_POST['search'])) {
        $search=$_POST['search-title'];
        $all_posts_query="SELECT *FROM posts WHERE status='publish'";
         
        $all_posts_query .= " and tags LIKE '%$search% '";
        
        $all_posts_run=mysqli_query($conn,$all_posts_query);
        $all_posts=mysqli_num_rows($all_posts_run);
        $total_pages=ceil($all_posts /$number_of_posts);
        $posts_start_from=(($page_id)-1)*($number_of_posts); 
        }else{
          $all_posts_query="SELECT *FROM posts WHERE status='publish'";
          if (isset($cat_name)) {
        $all_posts_query .=" and catagory='$cat_name'";
        # code...
        }//end of cat name if 
        $all_posts_run=mysqli_query($conn,$all_posts_query);
        $all_posts=mysqli_num_rows($all_posts_run);
        $total_pages=ceil($all_posts /$number_of_posts);
        $posts_start_from=(($page_id)-1)*($number_of_posts); 
        }//end of else
        ?>
        <div class="jumbotron">
          <div class="container">
              <div id="details" class="animated fadeInLeft">
                <h1>sudhakar 1797<span>blog</span></h1>
                <p>this is online tutorial view all thing</p>
              </div><!--end of datails-->
          </div><!--end of container-->
           <img src="img/image.jpg">
        </div><!--end of jumbodron-->

        <section>
          <div class="container">
            <div class="row">
              <div class="col-md-8">
                <?php 
                    $slider_query="SELECT * FROM posts WHERE status='publish' ORDER BY id DESC LIMIT 5";
                     $slider_run=mysqli_query($conn,$slider_query);
                     if ((mysqli_num_rows($slider_run)) >0) {
                       # code...
                     $count=mysqli_num_rows($slider_run);
                ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
       <!-- Indicators -->
                  <ol class="carousel-indicators">
                      <?php
                      for ($i=0; $i <$count ; $i++) { 
                        if ($i==0) {
                         
                           echo " <li data-target='#carousel-example-generic' data-slide-to='".$i."' class='active'></li>"; 
                          # code...
                        }else{
                           echo " <li data-target='#carousel-example-generic' data-slide-to='".$i."'></li>"; 
                        }
                        # code...
                      }

                       ?>
                       
                  </ol>

  <!-- Wrapper for slides -->
         <div class="carousel-inner" role="listbox">
          <?php 
          $check=0;
          while ( $slider_row= mysqli_fetch_array($slider_run)) {
            $slider_id=$slider_row['id'];
            $slider_image=$slider_row['image'];
            $slider_title=$slider_row['title'];
            
            
            # code...
            $check=$check+1;
            if ($check==1) {
              echo "<div class='item active'>";
              # code...
            }else{
                  echo "<div class='item'>";
            }
           
          ?>
    
      <a href="post.php?post_id=<?php echo $slider_id; ?>"><img src="img/<?php echo $slider_image; ?>" style="max-width:800px; max-height: 600px;min-width: 800px;min-height: 600px;"></a>
      <div class="carousel-caption">
       <h2> <?php echo $slider_title; ?></h2>
      </div>
    </div>
    <?php
    }
    ?>
  </div>

  <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
      </a>
       <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
            
            <?php 
            }     
            if (isset($_POST['search'])) {
                $search=$_POST['search-title'];
               // echo $search;
              
                 $query="SELECT * FROM posts WHERE status='publish' ";
                      
                      $query .= " and tags LIKE '%$search%'";
                     
                    
                     $query .= " ORDER BY id DESC LIMIT $posts_start_from,$number_of_posts";
                     
                   


                   }else{
                     $query="SELECT * FROM posts WHERE status='publish' ";
                     if (isset($cat_name)) {
                      $query .= " and catagory ='$cat_name'";
                     # code...
                     }
                     $query .= " ORDER BY id DESC LIMIT $posts_start_from,$number_of_posts";
                   } //<!--end of else-->    
                        $run=mysqli_query($conn,$query);
                
             if (mysqli_num_rows($run) > 0) 
             {
              while ($row = mysqli_fetch_array($run)) {
                $id=$row['id'];
                $date=getdate($row['date']);
                $day=$date['mday'];
                $month=$date['month'];
                $year=$date['year'];
                $title=$row['title'];
                $author=$row['author'];
                $author_image=$row['author_image'];
                $catagory=$row['catagory'];
                $tags=$row['tags'];
                $post_data=$row['post_data'];
                $views=$row['views'];
                $status=$row['status'];
                $image=$row['image'];
                # code...
             
            ?>
            <div class="post">
              <div class="row">
                <div class="col-md-2 post-date">
                  <div class="day"><?php echo $day;?></div>
                  <div class="mounth"><?php echo $month;?></div>
                  <div class="year"><?php echo $year;?></div>
                </div>

                <div class="col-md-8 post-title">
                  <a href="post.php?post_id=<?php echo $id;?>">
                    <h2><?php echo $title;?> </h2>
                  </a>
                  <p>written by:<span><?php echo ucfirst($author);?></span></p>
                </div>

                <div class="col-md-2 profile-picture">
                  
                  <img src="admin/img/<?php echo  $author_image; ?>" class="img-circle" style="position: absolute;max-width: 70%;" >
                  
                </div>
              </div>
              <a href="post.php?post_id=<?php echo $id;?>"><img src="img/<?php echo $image; ?>" alt="post-image"  style="max-width:700px; max-height: 500px;min-width: 700px;min-height: 500px;padding-left:50px; "></a>
              <div class="desc">
               <?php echo substr($post_data, 0,100).".....";?>
              </div>
              <a href="post.php?post_id=<?php echo $id;?>" class="btn btn-primary">read more...</a>
             <div class="bottom">
                  <span><i class="fa fa-folder"></i><a href="#"><?php echo ucfirst($catagory);?></a></span>
                  <span><i class="fa fa-comment"></i><a href="#">comment</a></span>
                </div>
            
            </div>
            <?php 
             }
              # code...
            }
            else{
              echo "<center><h2>NO post available</h2></center>";
            }
            ?>
            <nav id="pagination">
              <ul class="pagination"> 
                <?php 
                for ($i=1; $i<=$total_pages ; $i++) { 
                  echo "<li class='".($page_id==$i ? 'active':'')."'><a href='index.php?page=".$i."&".(isset($cat_name)?"cat=$cat_id":"")."'>$i</a></li>";
                                  # code...
                 } 
                 ?>
                  
                </ul>
            </nav>


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
 <script src="jquery/jquery.js"></script> 
 <!-- Include all compiled plugins (below), or include individual files as 
needed --> 
 <script src="js/bootstrap.min.js"></script> 
 <script src="offcanvas.js"></script>
 </body
 </html>