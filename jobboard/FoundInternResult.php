<?php
    session_start();
    //error_reporting(0);
    $sessid = $_SESSION["Semail"];
    $sessname = $_SESSION["Sname"] ;
    $jobtype= $_SESSION["jobType"];
    $jobloc= $_SESSION["jobLoc"];
    $jobsal= $_SESSION["salary"];
    $jobovert= $_SESSION["overtime"];
    $jobemail= $_SESSION["email"];
    $jobskills= $_SESSION["skills"];

    echo $sessid;
    echo $sessname;


    include 'compareInternfunc.php';
    //echo "<br>";
    $TotalDescription= strtolower(" $jobtype $jobloc $jobsal $jobovert $jobskills");
    //echo $TotalDescription;

    //echo functionCompare($TotalDescription);

    $alljobs= functionCompare($TotalDescription,$jobtype);

    //echo "echooooooooooooooooooooooooooooo";
    //echo $alljobs[0]->jobtype;
    //echo $alljobs[0]->cossim;
    //echo "<br>";

    if ($sessid=="" ) {

        session_unset();
        session_destroy();

        header("Location: index.html");

    }

    if (isset($_POST['LOutBut']))
    {
        session_unset();
        session_destroy();


        header("Location: index.html");
    }

    if (isset($_POST['details']))
    {
        session_start();

        $_SESSION["ActualSerial"] = $_POST['ActualSerial'];
        $_SESSION["cvEmail"] = $_POST['cvEmail'];

        header("location:CvDetail.php");

    }

    //---------------connection establish------------>
    $DB_host = "localhost";
    $DB_user = "root";
    $DB_pass = "";
    $DB_name = "jobboard";

    try {
        $con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo " Connected successfully ";


    } catch (PDOException $e) {
        //print "Error!: " . $e->getMessage() . "<br/>";

        die();
    }
    //---------------connection establish finish------------>

    $stmt=$con->query("SELECT * FROM `jobs`"); //running query

?>





<!doctype html>
<html lang="en">
  <head>
    <title>JOBBOARD By Sifat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <link rel="stylesheet" href="css/custom-bs.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/line-icons/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">    
  </head>
  <body id="top">

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
    

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    

    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="index.html">JOBBOARD</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.html" class="nav-link">Home</a></li>
              <li><a href="about.html">About</a></li>
              <li class="has-children">
                <a href="job-listings.html">Job Listings</a>
                <ul class="dropdown">
                  <li><a href="job-single.html">Job Single</a></li>
                  <li><a href="post-job.html">Post a Job</a></li>
                </ul>
              </li>
              <li class="has-children">
                <a href="services.html" class="active">Pages</a>
                <ul class="dropdown">
                  <li><a href="services.html" class="active">Services</a></li>
                  <li><a href="service-single.html">Service Single</a></li>
                  <li><a href="blog-single.html">Blog Single</a></li>
                  <li><a href="portfolio.html">Portfolio</a></li>
                  <li><a href="portfolio-single.html">Portfolio Single</a></li>
                  <li><a href="testimonials.html">Testimonials</a></li>
                  <li><a href="faq.html">Frequently Ask Questions</a></li>
                  <li><a href="gallery.html">Gallery</a></li>
                </ul>
              </li>
              <li><a href="blog.html">Blog</a></li>
              <li><a href="contact.html">Contact</a></li>
              <li class="d-lg-none"><a href="post-job.html"><span class="mr-2">+</span> Post a Job</a></li>
              <li class="d-lg-none"><a href="login.html">Log In</a></li>
            </ul>
          </nav>
          
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
<!--              <a href="post-job.html" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-add"></span>Post a Job</a>-->
              <a href="Company_Home.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Home</a>
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/home_sifat.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Searching for : </h1>
            <div class="custom-breadcrumbs">
              <!--<a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Services</strong></span> -->
              <!--<h1 class="text-white font-weight-bold"> <?php echo $TotalDescription ?></h1>-->
              <h1 class="text-white font-weight-bold"> <?php echo $jobtype ." in ". $jobloc ?></h1>
              <h1 class="text-white font-weight-bold"> <?php echo "Offered Salary-".$jobsal ?></h1>
              <h1 class="text-white font-weight-bold"> <?php echo "Overtime- ". $jobovert ?></h1>
              <h1 class="text-white font-weight-bold"> <?php echo "Required Skills- ". $jobskills ?></h1>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="site-section services-section bg-light block__62849" id="next-section">


        <div class="container">
            <div class="row">

<!--        --><?php
//            $count=1;
//            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
<!---->
<!--                    <div class="col-6 col-md-6 col-lg-4 mb-4 mb-lg-5">-->
<!---->
<!--                        <a href="service-single.html" class="block__16443 text-center d-block">-->
<!--                            <span class="custom-icon mx-auto"><span class="icon-magnet d-block"></span></span>-->
<!--                            <h3> --><?php //echo $row["JobType"] ?><!-- </h3>-->
<!--                            <p> --><?php //echo $row["Company"] ?><!-- </p>-->
<!--                            <p>See Details</p>-->
<!--                        </a>-->
<!---->
<!--                    </div>-->
<!--        --><?php
//            $count++;} ?>


                <?php

                for($x = 0; $x < count($alljobs); $x++){ ?>

                    <div class="col-6 col-md-6 col-lg-4 mb-4 mb-lg-5"  >
                        <!--href="service-single.html"-->
                        <div  id="jobAdvert" class="block__16443 text-center d-block" onmouseenter="showDetails(this)" onmouseleave="hideDetails(this)">
                            <span class="custom-icon mx-auto"><span class="icon-magnet d-block"></span></span>

                            <h3> <?php echo $alljobs[$x]->ASerial ?> </h3>
                            <h3> <?php echo $alljobs[$x]->jobtype ?> </h3>
                            <h5> Name </h5>
                            <p> <?php echo $alljobs[$x]->jobname ?> </p>
                            <h5> Contact </h5>
                            <p> <?php echo $alljobs[$x]->jobemail ?> </p>
                            <h5 style="color: red"> <?php echo number_format($alljobs[$x]->cossim*100,3) ." % matches" ?> </h5>
                            <h5 id="child1" style="display: none;border-bottom: 2px solid limegreen"> Job Location </h5>
                            <p id="child2" style="display: none"> <?php echo $alljobs[$x]->jobloc ?> </p>
                            <h5 id="child3" style="display: none;border-bottom: 2px solid limegreen"> Salary </h5>
                            <p id="child4" style="display: none"> <?php echo $alljobs[$x]->jobsal ?> </p>
                            <h5 id="child5" style="display: none;border-bottom: 2px solid limegreen"> Ovartime </h5>
                            <p id="child6" style="display:none;"> <?php echo $alljobs[$x]->jobovert ?> </p>
                            <h5 id="child7" style="display: none;border-bottom: 2px solid limegreen"> Skills </h5>
                            <p id="child8" style="display: none"> <?php echo $alljobs[$x]->jobskills ?> </p>

                            <a href="mailto:<?php echo $alljobs[$x]->jobemail ?>?subject=Potential job offer for the position <?php echo $alljobs[$x]->jobtype ?> at <?php echo $sessname ?>" target="_blank">
                                <div style="background:#e7f1d0">
                                    <h3>Contact on- <?php echo $alljobs[$x]->jobemail ?> </h3>
                                </div>
                            </a>


                            <p id="details" > See Details </p>
<!--                            <form method="post">-->
<!--                                <input type="hidden" name="ActualSerial" value="--><?php //echo $alljobs[$x]->ASerial ?><!--">-->
<!--                                <input type="hidden" name="cvEmail" value="--><?php //echo $alljobs[$x]->jobemail ?><!--">-->
<!--                                <button class="btn btn-outline-primary border-width-2" id="details" name="details" type="submit" "><a>See Details</a></button>-->
<!--                            </form>-->
                        </div>


                    </div>
                    <?php
                    } ?>

            </div>

        </div>

    </section>
    
    <footer class="site-footer">

      <a href="#top" class="smoothscroll scroll-top">
        <span class="icon-keyboard_arrow_up"></span>
      </a>

      <div class="container">
        <div class="row mb-5">
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Search Trending</h3>
            <ul class="list-unstyled">
              <li><a href="#">Web Design</a></li>
              <li><a href="#">Graphic Design</a></li>
              <li><a href="#">Web Developers</a></li>
              <li><a href="#">Python</a></li>
              <li><a href="#">HTML5</a></li>
              <li><a href="#">CSS3</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Company</h3>
            <ul class="list-unstyled">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Career</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Resources</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Support</h3>
            <ul class="list-unstyled">
              <li><a href="#">Support</a></li>
              <li><a href="#">Privacy</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Contact Us</h3>
            <div class="footer-social">
              <a href="#"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-instagram"></span></a>
              <a href="#"><span class="icon-linkedin"></span></a>
            </div>
          </div>
        </div>

        <div class="row text-center">
          <div class="col-12">
            <p class="copyright"><small>
              <!-- Link back to Sifat can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made</i> by <a href="https://Sifat.com" target="_blank" >Sifat</a>
            <!-- Link back to Sifat can't be removed. Template is licensed under CC BY 3.0. --></small></p>
          </div>
        </div>
      </div>
    </footer>
  
  </div>

    <!-- SCRIPTS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/stickyfill.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/quill.min.js"></script>
    
    
    <script src="js/bootstrap-select.min.js"></script>
    
    <script src="js/custom.js"></script>

  <script>
    wd=document.getElementById("jobAdvert");
      showDetails=(f)=>{

        //f.querySelector("#child1").innerHTML="fuck youuu";
        f.querySelector("#child1").style.display="block";
        f.querySelector("#child2").style.display="block";
        f.querySelector("#child3").style.display="block";
        f.querySelector("#child4").style.display="block";
        f.querySelector("#child5").style.display="block";
        f.querySelector("#child6").style.display="block";
        f.querySelector("#child7").style.display="block";
        f.querySelector("#child8").style.display="block";

        f.querySelector("#details").style.display="none";


    }
    hideDetails=(f)=>{
        f.querySelector("#child1").style.display="none";
        f.querySelector("#child2").style.display="none";
        f.querySelector("#child3").style.display="none";
        f.querySelector("#child4").style.display="none";
        f.querySelector("#child5").style.display="none";
        f.querySelector("#child6").style.display="none";
        f.querySelector("#child7").style.display="none";
        f.querySelector("#child8").style.display="none";

        f.querySelector("#details").style.display="block";

    }


    //
    //let showCvDetail=(f)=>{
    //   f.style.display="none";
    //   <?php //header("Location: index.html"); ?>
    //}



  </script>

     
  </body>
</html>