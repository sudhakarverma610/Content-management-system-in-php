      <?php 
      require_once('inc/top.php');
      ?>
  
  
 </head> 
 <body>        <?php 
      require_once('inc/header.php');
      ?>
        <div class="jumbotron">
          <div class="container">
              <div id="details" class="animated fadeInLeft">
                <h1>contact<span>&nbsp;us</span></h1>
                <p>we are aviable 24x7.So Feel Free contact us <br><p style="color: red;"><b>mob no:</b>+917052386591</p></p>
              </div><!--end of datails-->
          </div><!--end of container-->
           <img src="img/image.jpg">
        </div><!--end of jumbodron-->

        <section>
          <div class="container">
            <div class="row">
              <div class="col-md-8">
 
                <div class="row">
                  <div class="col-md-12</div> 

                  <div class="col-md-12 contact-form">
                      <?php 
                      if(isset($_POST['submit'])){
                        $name=mysqli_real_escape_string($conn,$_POST['name']);
                        $email=mysqli_real_escape_string($conn,$_POST['email']);
                        $website=mysqli_real_escape_string($conn,$_POST['website']);
                        $comment=mysqli_real_escape_string($conn,$_POST['comment']);
                        $to="sudhakarverm610@gmail.com";
                        $header="From: $name <$email>";
                        $subject="Message From: $name";
                        $message="Name :$name\n\nEmail :$email\n\n<b>Website :$website \n \nMessage :$comment \n \n";

                        if (empty($name) or empty($email) or empty($comment)) {
                        $error="All (*) Fields are required";
                        }else{
                          if (@mail($to, $subject, $message,$header)) {
                            $msg="Message Has Been send";
                            # code...
                          }else{
                             $error="Message Has Not  Been send";
                          }

                     

                        
                        }

                          
                      }
                      ?>
                    <h2>CONTACT FORM</h2><HR>
                    <form action="" method="post">
                      <div class="form-group">
                        <label for="full name">Full name*:</label>
                        <?php 
                        if (isset($msg)) {
                       echo " <span class='pull-right' style='color: green;'>$msg</span>";
                        }elseif (isset($error)) {
                         echo "<span class='pull-right' style='color: red;'>$error</span>";
                        }
                        ?>
                        <input type=text" id="full-name" name="name" class="form-control"
                        placeholder="Full name">
                        
                      </div>
                        <div class="form-group">
                        <label for="email">Email*:</label>
                        <input type=text" id="email" name="email" class="form-control"
                        placeholder="email address">
                        
                      </div>
                        <div class="form-group">
                        <label for="website">website</label>
                        <input type=text" id="website" name="website" class="form-control"
                        placeholder="website">
                        
                      </div>
                        <div class="form-group">
                        <label for="message">message</label>
                        <textarea id="message" cols="30" rows="10" class="form-control" placeholder="your message should be here" name="comment"></textarea>
                       
                        
                      </div>
                      <input type="submit" name="submit" value="submit" class="btn btn-primary">
                    </form>
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