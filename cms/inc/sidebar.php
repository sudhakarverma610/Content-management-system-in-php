
                <div class="widgets">
                   <form action="index.php" method="post">
                  <div class="input-group">
                   
                      <input type="text" name="search-title"  class="form-control" placeholder="search for...">
                      <span class="input-group-btn">
                        <input type="submit" name="search" value="Go" class="btn btn-default">
                      </span>
                  </div> <!--input group close-->
                </form>
                </div><!--widgets colose-->
                   <div class="widgets">
                   <div class="popular">
                       <h4>Popular post</h4> 
                       <?php
                         $p_query="SELECT * FROM posts WHERE status='publish' ORDER BY views DESC limit 5";
                       $p_run=mysqli_query($conn,$p_query);
                        if ((mysqli_num_rows($p_run)) >0) {
                          while ($p_row=mysqli_fetch_array($p_run)) {
                            $p_id=$p_row['id'];
                            //$p_date=$p_row['date'];
                            $p_date=getdate($p_row['date']);
                            $p_day=$p_date['mday'];
                            $p_month=$p_date['month'];
                            $p_year=$p_date['year'];
                            $p_title=$p_row['title'];
                            $p_image=$p_row['image'];                              
                        
                       ?>
                     <hr>
                     <div class="row">
                       <div class="col-xs-4">
                         <a href="post.php?post_id=<?php echo $p_id; ?>"><img src="img/<?php echo $p_image; ?>" alt="image1">
                       </div>
                       <div class="col-xs-8" class="details" style="margin-left: -20px;">
                       <a href="post.php?post_id=<?php echo $p_id; ?>">  <h6><?php echo $p_title; ?></h6></a>
                         <p><i class="fa fa-clock-o"><?php echo "$p_day $p_month $p_year"; ?></i> </p>
                       </div></div>
                       <?php 
                     }
                     }else{
                      echo "<h3>NO posts Available</h3>";
                     } 
                       ?>
                       
                       
                   </div>
                 </div><!--widgets colose-->
                 <div class="widgets">
                   <div class="popular">
                       <h4>resent post</h4> 
                       <?php
                         $p_query="SELECT * FROM posts WHERE status='publish' ORDER BY id DESC limit 5";
                       $p_run=mysqli_query($conn,$p_query);
                        if ((mysqli_num_rows($p_run)) >0) {
                          while ($p_row=mysqli_fetch_array($p_run)) {
                            $p_id=$p_row['id'];
                            //$p_date=$p_row['date'];
                            $p_date=getdate($p_row['date']);
                            $p_day=$p_date['mday'];
                            $p_month=$p_date['month'];
                            $p_year=$p_date['year'];
                            $p_title=$p_row['title'];
                            $p_image=$p_row['image'];                              
                        
                       ?>
                     <hr>
                     <div class="row">
                       <div class="col-xs-4">
                         <a href="post.php?post_id=<?php echo $p_id; ?>"><img src="img/<?php echo $p_image; ?>" alt="image1">
                       </div>
                       <div class="col-xs-8" class="details" style="margin-left: -20px;">
                       <a href="post.php?post_id=<?php echo $p_id; ?>">  <h6><?php echo $p_title; ?></h6></a>
                         <p><i class="fa fa-clock-o"><?php echo "$p_day $p_month $p_year"; ?></i> </p>
                       </div></div>
                       <?php 
                     }
                     }else{
                      echo "<h3>NO posts Available</h3>";
                     } 
                       ?>
                       
                       
                   </div>
                 </div><!--widgets colose-->
                  <div class="widgets">
                   <div class="popular">
                       <h4>Catagory</h4> 
                       <hr>
                   <div class="row">
                     <div class="col-xs-6">
                       <ul>
                        <?php
                         $c_query="SELECT * FROM catagory ";
                       $c_run=mysqli_query($conn,$c_query);
                        if ((mysqli_num_rows($c_run)) >0) {
                          $count=2;
                          while ($c_row=mysqli_fetch_array($c_run)) {
                            $c_id=$c_row['id'];
                            $c_catagory=$c_row['catagory'];
                            $count=$count+1;
                            if (($count%2)==1) {
                              echo "<li><a href='index.php?cat=".$c_id."'>".(ucfirst($c_catagory))."</a></li>";
                              # code...
                            }
                          }
                        }else{
                          echo "<p>No catagory Available</p>";
                        }

                        ?>
                       </ul>
                     </div>

                     <div class="col-xs-6">
                       
                       <ul>
                             <?php
                         $c_query="SELECT * FROM catagory ";
                       $c_run=mysqli_query($conn,$c_query);
                        if ((mysqli_num_rows($c_run)) >0) {
                          $count=2;
                          while ($c_row=mysqli_fetch_array($c_run)) {
                            $c_id=$c_row['id'];
                            $c_catagory=$c_row['catagory'];
                            $count=$count+1;
                            if (($count%2)==0) {
                              echo "<li><a href='index.php?cat=".$c_id."'>".(ucfirst($c_catagory))."</a></li>";
                              # code...
                            }
                          }
                        }else{
                          echo "<p>No catagory Available</p>";
                        }

                        ?>
                       </ul>
                     </div>
                   </div>
                 

                   </div>
                 </div><!--widgets colose-->
                  <div class="widgets">
                   <div class="catagory">
                       <h4>Social Icons</h4> 
                       <hr>
                       <div class="row">
                         <div class="col-xs-4">
                           <a href="http://www.facebook.com"><img src="img/facebook.png"></a>
                         </div>
                         <div class="col-xs-4">
                           <a href="http://www.twitter.com"><img src="img/twitter.png"></a>
                         </div>
                         <div class="col-xs-4">
                           <a href="http://www.googleplus.com"><img src="img/googleplus.png"></a>
                         </div>
                       </div>
                         <div class="row">
                         <div class="col-xs-4">
                           <a href="http://www.linkedin.com"><img src="img/linkedin.png"></a>
                         </div>
                         <div class="col-xs-4">
                           <a href="http://www.skype.com"><img src="img/skype.png"></a>
                         </div>
                         <div class="col-xs-4">
                           <a href="http://www.youtube.com"><img src="img/youtube.png"></a>
                         </div>
                       </div>
                    

                   </div>
                 </div><!--widgets colose-->
                 
                 