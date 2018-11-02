<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
       <div class="navbar-header">
           <button type="button" class="navbar-toggle collasped" data-toggle="collaspe" data-target="#bs-example-navbar-collaspe-1" aria-expanded="false">
             <span class="sc-only">toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span></button>
              <a class="navbar-brand" href="index.php">
               <div class="col-xs-4"><img src="img/favicon.jpg"
            alt="logo" width="35%" class="img-circle animated fadeInRight"></div>
                <div class="col-xs-8 animated fadeInLeft" >sudhakar</div>
          </a>
        </div> 
        <div class="collaspe navbar-collaspe" id="bs-example-navbar-collaspe-1">
            <ul class="nav navbar-nav navbar-right">
                   <li><a href="index.php"><i class="fa fa-home"></i> home</a></li>
         
                    
                                   <li class="dropdown">
                                  <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button"aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i>Categories<span class="caret"></span></a>
                                   
                                  <ul class="dropdown-menu">
                                    <?php 
                                    $query="SELECT * FROM catagory ORDER BY id desc";
                                    $run=mysqli_query($conn,$query);
                                    if ((mysqli_num_rows($run)) >0) {
                                          while ($row=mysqli_fetch_array($run)) {
                                            $catagory=ucfirst($row['catagory']);
                                            $id=$row['id'];
                                            echo " <li><a   href='index.php?cat=".$id."'>".$catagory."</a><li>";
                                            # code...
                                          }
                                      # code...
                                    }
                                    else {
                                      echo " <li><a   href='index.php'>No catagory</a><li>";
                                      # code...
                                    }
                                     ?>
                                       
                                         
                                          
                                  </ul></li>
                                    <li><a href="contactus.php"><i class="fa fa-phone-square" aria-hidden="true"></i>CONTACT US</a></li>
                                </ul>  
                               
                  
            
          </div>
  </div>
</nav>