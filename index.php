<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network html5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>getogether</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/ionicons.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/style.css">
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/fav.png"/>
	</head>
	<body>
<?php
if(isset($_SESSION['useremail'])){
	include_once 'newsfeed.php';
}else{
?>
    <!-- Header
    ================================================= -->
		<header id="header-inverse">
      <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index-register.html"><img src="images/logo.png" alt="logo" /></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-menu">

            </ul>
            <form class="navbar-form navbar-right hidden-sm">
              <div class="form-group">
                <i class="icon ion-android-search"></i>
                <input type="text" class="form-control" placeholder="Search friends, photos, videos">
              </div>
            </form>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>
    <!--Header End-->
    
    <!-- Landing Page Contents
    ================================================= -->
    <div id="lp-register">
    	<div class="container wrapper">
        <div class="row">
        	<div class="col-sm-5">
            <div class="intro-texts">
            	<h1 class="text-white">Make Cool Friends !!!</h1>
            	<p>Friend Finder is a social network template that can be used to connect people. The template offers Landing pages, News Feed, Image/Video Feed, Chat Box, Timeline and lot more. <br /> <br />Why are you waiting for? Buy it now.</p>
              <button class="btn btn-primary">Learn More</button>
            </div>
          </div>
        	<div class="col-sm-6 col-sm-offset-1">
            <div class="reg-form-container"> 
            
              <!-- Register/Login Tabs-->
              <div class="reg-options">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#register" data-toggle="tab">Register</a></li>
                  <li><a href="#login" data-toggle="tab">Login</a></li>
                </ul><!--Tabs End-->
              </div>
              
              <!--Registration Form Contents-->
              <div class="tab-content">
                <div class="tab-pane active" id="register">
                  <h3>Register Now !!!</h3>
                  <p class="text-muted">Be cool and join today. Meet millions</p>
                  
                  <!--Register Form-->
	<form id="insertDataForm" class=""  enctype="multipart/form-data">
		<div class="form-group">
			<label><!-- <span>User Name:</span> --> 
				<input type="text" name="userName" id="userName" placeholder="User Name" class="form-control" required/>
			</label>
		</div>
		<div class="form-group">
			<label><!-- <span>Email: </span> -->
				<input type="email" name="email" id="email" placeholder="Email" class="form-control" required/>
			</label>
		</div>
		<div class="form-group">
			<label><!-- <span>Phone: </span> -->
				<input type="text" name="phone" id="phone" placeholder="Phone" class="form-control" required/>
			</label>
		</div>
		<div class="form-group">
			<label><!-- <span>Password:</span>  -->
				<input type="password" name="pass" id="pass" placeholder="Password" class="form-control" required/>
			</label>
		</div>
		<div class="form-group">
			<label><!-- Profile Pic: -->
				<input type="file" name="myfile" id="myfile" class="form-control">
			</label>
		</div>
		 <input type="button" class="btn btn-primary btnc" onclick="insertData()" value="Register Now"/>
	</form><!--Register Now Form Ends-->
                  <p><a href="#">Already have an account?</a></p>
                </div><!--Registration Form Contents Ends-->
                
                <!--Login-->
                <div class="tab-pane" id="login">
                  <h3>Login</h3>
                  <p class="text-muted">Log into your account</p>
                  
                  <!--Login Form-->
                  <form name="loginForm" id='loginForm'>
                     <div class="row">
					<div class="form-group">
						<label><!-- <span>Email: </span> -->
							<input type="email" name="logemail" id="email" placeholder="Email" class="form-control" required/>
						</label>
					</div>
                    </div>
                    <div class="row">
						<div class="form-group">
							<label><!-- <span>Password:</span>  -->
								<input type="password" name="logpass" id="pass" placeholder="Password" class="form-control" required/>
							</label>
						</div>
                    </div>
                  </form><!--Login Form Ends--> 
                  <p><a href="#">Forgot Password?</a></p>
                  <button class="btn btn-primary" onclick="loginUser()">Login Now</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-6">
          
            <!--Social Icons-->
            <ul class="list-inline social-icons">
              <li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
              <li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
              <li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
              <li><a href="#"><i class="icon ion-social-pinterest"></i></a></li>
              <li><a href="#"><i class="icon ion-social-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
<?php } ?>
    <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>
    <div id="alert" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" id="alertmsg">
      </div>
    </div>

  </div>
</div>

    <!-- Scripts
    ================================================= -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.appear.min.js"></script>
		<script src="js/jquery.incremental-counter.js"></script>
    <script src="js/script.js"></script>
	</body>
</html>
