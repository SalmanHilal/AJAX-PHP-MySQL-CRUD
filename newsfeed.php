<?php
$uemail = $_SESSION['useremail'];
include_once 'connection.php';
$q = "SELECT * FROM usersinfo WHERE email = '$uemail'";
    if (!$result = mysqli_query($conn,$q)) {
        exit(mysqli_error());
    }
    $response = array();
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { 
          $response = $row; 
           $userName = $response['userName'];
           $email = $response['email'];
           $phone = $response['phone'];
           $imgpath = $response['imgpath'];
         }
    }
$qall = "SELECT * FROM usersinfo WHERE email!='$uemail'";
    if (!$resultall = mysqli_query($conn,$qall)) {
        exit(mysqli_error());
    }
    $responseall = array();


?>
		<header id="header">
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
            <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo" /></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-menu">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home <span><img src="images/down-arrow.png" alt="" /></span></a>
                  <ul class="dropdown-menu newsfeed-home">
                    <li><a href="index.html#">Landing Page 1</a></li>
                    <li><a href="index-register.html#">Landing Page 2</a></li>
                  </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Newsfeed <span><img src="images/down-arrow.png" alt="" /></span></a>
                  <ul class="dropdown-menu newsfeed-home">
                    <li><a href="newsfeed.html#">Newsfeed</a></li>
                    <li><a href="newsfeed-people-nearby.html#">Poeple Nearly</a></li>
                    <li><a href="newsfeed-friends.html#">My friends</a></li>
                    <li><a href="newsfeed-messages.html#">Chatroom</a></li>
                    <li><a href="newsfeed-images.html#">Images</a></li>
                    <li><a href="newsfeed-videos.html#">Videos</a></li>
                  </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Timeline <span><img src="images/down-arrow.png" alt="" /></span></a>
                <ul class="dropdown-menu login">
                  <li><a href="timeline.html#">Timeline</a></li>
                  <li><a href="timeline-about.html#">Timeline About</a></li>
                  <li><a href="timeline-album.html#">Timeline Album</a></li>
                  <li><a href="timeline-friends.html#">Timeline Friends</a></li>
                  <li><a href="edit-profile-basic.html#">Edit: Basic Info</a></li>
                  <li><a href="edit-profile-work-edu.html#">Edit: Work</a></li>
                  <li><a href="edit-profile-interests.html#">Edit: Interests</a></li>
                  <li><a href="edit-profile-settings.html#">Account Settings</a></li>
                  <li><a href="edit-profile-password.html#">Change Password</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle pages" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">All Pages <span><img src="images/down-arrow.png" alt="" /></span></a>
                <ul class="dropdown-menu page-list">
                  <li><a href="index.html#">Landing Page 1</a></li>
                  <li><a href="index-register.html#">Landing Page 2</a></li>
                  <li><a href="newsfeed.html#">Newsfeed</a></li>
                  <li><a href="newsfeed-people-nearby.html#">Poeple Nearly</a></li>
                  <li><a href="newsfeed-friends.html#">My friends</a></li>
                  <li><a href="newsfeed-messages.html#">Chatroom</a></li>
                  <li><a href="newsfeed-images.html#">Images</a></li>
                  <li><a href="newsfeed-videos.html#">Videos</a></li>
                  <li><a href="timeline.html#">Timeline</a></li>
                  <li><a href="timeline-about.html#">Timeline About</a></li>
                  <li><a href="timeline-album.html#">Timeline Album</a></li>
                  <li><a href="timeline-friends.html#">Timeline Friends</a></li>
                  <li><a href="edit-profile-basic.html#">Edit Profile</a></li>
                  <li><a href="contact.html#">Contact Us</a></li>
                  <li><a href="faq.html#">FAQ Page</a></li>
                  <li><a href="404.html#">404 Not Found</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="contact.html#">Contact</a></li>
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

    <div id="page-contents">
    	<div class="container">
    		<div class="row">

    			<!-- Newsfeed Common Side Bar Left
          ================================================= -->
    			<div class="col-md-3" style="position:static;">
            <div class="profile-card">
            	<img src="<?php echo $imgpath; ?>" alt="user" class="profile-photo" />
            	<h5><a href="me.php" class="text-white"><?php echo $userName; ?></a></h5>
            	<!-- <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> 1,299 followers</a> -->
              <a href="logout.php" class="text-white"><i class="ion ion-android-person-add"></i> Logout</a>
            </div><!--profile card ends-->
            <ul class="nav-news-feed">
              <li><i class="icon ion-ios-paper"></i><div><a href="newsfeed.html#">My Newsfeed</a></div></li>
              <li><i class="icon ion-ios-people"></i><div><a href="newsfeed-people-nearby.html#">People Nearby</a></div></li>
              <li><i class="icon ion-ios-people-outline"></i><div><a href="newsfeed-friends.html#">Friends</a></div></li>
              <li><i class="icon ion-chatboxes"></i><div><a href="newsfeed-messages.html#">Messages</a></div></li>
              <li><i class="icon ion-images"></i><div><a href="newsfeed-images.html#">Images</a></div></li>
              <li><i class="icon ion-ios-videocam"></i><div><a href="newsfeed-videos.html#">Videos</a></div></li>
            </ul><!--news-feed links ends-->
            <div id="chat-block">
              <div class="title">Chat online</div>
              <ul class="online-users list-inline">
   
              </ul>
            </div><!--chat block ends-->
          </div>
    			<div class="col-md-7">

            <!-- Post Create Box
            ================================================= -->
            <div class="create-post">
            	<div class="row">
            		<div class="col-md-7 col-sm-7">
                  <div class="form-group">
                    <img src="<?php echo $imgpath; ?>" alt="" class="profile-photo-md" />
                    <textarea name="texts" id="exampleTextarea" cols="30" rows="1" class="form-control" placeholder="Write what you wish"></textarea>
                  </div>
                </div>
            		<div class="col-md-5 col-sm-5">
                  <div class="tools">
                    <ul class="publishing-tools list-inline">
                      <li><a href="#"><i class="ion-compose"></i></a></li>
                      <li><a href="#"><i class="ion-images"></i></a></li>
                      <li><a href="#"><i class="ion-ios-videocam"></i></a></li>
                      <li><a href="#"><i class="ion-map"></i></a></li>
                    </ul>
                    <button class="btn btn-primary pull-right">Publish</button>
                  </div>
                </div>
            	</div>
            </div><!-- Post Create Box End -->
              <div class="post-content">
              <img src="images/post-images/2.jpg" alt="post-image" class="img-responsive post-image">
              <div class="post-container">
                <img src="images/users/user-4.jpg" alt="user" class="profile-photo-md pull-left">
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline.html#" class="profile-link">John Doe</a> <span class="following">following</span></h5>
                    <p class="text-muted">Published a photo about 2 hour ago</p>
                  </div>
                  <div class="reaction">
                    <a class="btn text-green"><i class="icon ion-thumbsup"></i> 39</a>
                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 2</a>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt</p>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-comment">
                    <img src="images/users/user-13.jpg" alt="" class="profile-photo-sm">
                    <p><a href="timeline.html#" class="profile-link">Brian </a>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
                  </div>
                  <div class="post-comment">
                    <img src="images/users/user-8.jpg" alt="" class="profile-photo-sm">
                    <p><a href="timeline.html#" class="profile-link">Richard</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                  </div>
                  <div class="post-comment">
                    <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm">
                    <input type="text" class="form-control" placeholder="Post a comment">
                  </div>
                </div>
              </div>
            </div>
            <!-- Friend List
            ================================================= -->
            <div class="friend-list">
            	<div class="row">
            		<div class="col-md-6 col-sm-6">
                  <div class="friend-card">
                  	<img src="images/covers/1.jpg" alt="profile-cover" class="img-responsive cover" />
                  	<div class="card-info">
                      <img src="images/users/user-3.jpg" alt="user" class="profile-photo-lg" />
                      <div class="friend-info">
                        <a href="#" class="pull-right text-green">My Friend</a>
                      	<h5><a href="timeline.html#" class="profile-link">Sophia Lee</a></h5>
                      	<p>Student at Harvard</p>
                      </div>
                    </div>
                  </div>
                </div>
            		<div class="col-md-6 col-sm-6">
                  <div class="friend-card">
                  	<img src="images/covers/3.jpg" alt="profile-cover" class="img-responsive cover" />
                  	<div class="card-info">
                      <img src="images/users/user-4.jpg" alt="user" class="profile-photo-lg" />
                      <div class="friend-info">
                        <a href="#" class="pull-right text-green">My Friend</a>
                      	<h5><a href="timeline.html#" class="profile-link">John Doe</a></h5>
                      	<p>Traveler</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="friend-card">
                  	<img src="images/covers/4.jpg" alt="profile-cover" class="img-responsive cover" />
                  	<div class="card-info">
                      <img src="images/users/user-10.jpg" alt="user" class="profile-photo-lg" />
                      <div class="friend-info">
                        <a href="timeline.html#" class="pull-right text-green">My Friend</a>
                      	<h5><a href="#" class="profile-link">Julia Cox</a></h5>
                      	<p>Art Designer</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="friend-card">
                  	<img src="images/covers/5.jpg" alt="profile-cover" class="img-responsive cover" />
                  	<div class="card-info">
                      <img src="images/users/user-7.jpg" alt="user" class="profile-photo-lg" />
                      <div class="friend-info">
                        <a href="#" class="pull-right text-green">My Friend</a>
                      	<h5><a href="timelime.html#" class="profile-link">Robert Cook</a></h5>
                      	<p>Photographer at Photography</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="friend-card">
                  	<img src="images/covers/6.jpg" alt="profile-cover" class="img-responsive cover" />
                  	<div class="card-info">
                      <img src="images/users/user-8.jpg" alt="user" class="profile-photo-lg" />
                      <div class="friend-info">
                        <a href="#" class="pull-right text-green">My Friend</a>
                      	<h5><a href="timeline.html#" class="profile-link">Richard Bell</a></h5>
                      	<p>Graphic Designer at Envato</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="friend-card">
                  	<img src="images/covers/7.jpg" alt="profile-cover" class="img-responsive cover" />
                  	<div class="card-info">
                      <img src="images/users/user-2.jpg" alt="user" class="profile-photo-lg" />
                      <div class="friend-info">
                        <a href="#" class="pull-right text-green">My Friend</a>
                      	<h5><a href="timeline.html#" class="profile-link">Linda Lohan</a></h5>
                      	<p>Software Engineer</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="friend-card">
                  	<img src="images/covers/8.jpg" alt="profile-cover" class="img-responsive cover" />
                  	<div class="card-info">
                      <img src="images/users/user-9.jpg" alt="user" class="profile-photo-lg" />
                      <div class="friend-info">
                        <a href="#" class="pull-right text-green">My Friend</a>
                      	<h5><a href="timeline.html#" class="profile-link">Anna Young</a></h5>
                      	<p>Musician</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="friend-card">
                  	<img src="images/covers/9.jpg" alt="profile-cover" class="img-responsive cover" />
                  	<div class="card-info">
                      <img src="images/users/user-6.jpg" alt="user" class="profile-photo-lg" />
                      <div class="friend-info">
                        <a href="#" class="pull-right text-green">My Friend</a>
                      	<h5><a href="timeline.html#" class="profile-link">James Carter</a></h5>
                      	<p>CEO at IT Farm</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="friend-card">
                  	<img src="images/covers/10.jpg" alt="profile-cover" class="img-responsive cover" />
                  	<div class="card-info">
                      <img src="images/users/user-5.jpg" alt="user" class="profile-photo-lg" />
                      <div class="friend-info">
                        <a href="#" class="pull-right text-green">My Friend</a>
                      	<h5><a href="timeline.html#" class="profile-link">Alexis Clark</a></h5>
                      	<p>Traveler</p>
                      </div>
                    </div>
                  </div>
                </div>
            	</div>
            </div>
          </div>

    			<!-- Newsfeed Common Side Bar Right
          ================================================= -->
    			<div class="col-md-2 static">
            <div class="suggestions" id="sticky-sidebar">
              <h4 class="grey">All Members</h4>
 <?php   if(mysqli_num_rows($resultall) > 0) {
        while ($rowall = mysqli_fetch_assoc($resultall)) { ?>
              <div class="follow-user">
                <img src="<?php echo $rowall['imgpath']; ?>" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="#"><?php echo $rowall['userName']; ?></a></h5>
                  <a href="#" class="text-green">Add friend</a>
                </div>
              </div>


    <?php     }
    } ?>

            </div>
          </div>
    		</div>
    	</div>
    </div>

    <!-- Footer
    ================================================= -->
    <footer id="footer">
      <div class="container">
      	<div class="row">
          <div class="footer-wrapper">
            <div class="col-md-3 col-sm-3">
              <a href="#"><img src="images/logo-black.png" alt="" class="footer-logo" /></a>
              <ul class="list-inline social-icons">
              	<li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-pinterest"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-linkedin"></i></a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h5>For individuals</h5>
              <ul class="footer-links">
                <li><a href="#">Signup</a></li>
                <li><a href="#">login</a></li>
                <li><a href="#">Explore</a></li>
                <li><a href="#">Finder app</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">Language settings</a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h5>For businesses</h5>
              <ul class="footer-links">
                <li><a href="#">Business signup</a></li>
                <li><a href="#">Business login</a></li>
                <li><a href="#">Benefits</a></li>
                <li><a href="#">Resources</a></li>
                <li><a href="#">Advertise</a></li>
                <li><a href="#">Setup</a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h5>About</h5>
              <ul class="footer-links">
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Help</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-3">
              <h5>Contact Us</h5>
              <ul class="contact">
                <li><i class="icon ion-ios-telephone-outline"></i>+1 (234) 222 0754</li>
                <li><i class="icon ion-ios-email-outline"></i>info@thunder-team.com</li>
                <li><i class="icon ion-ios-location-outline"></i>228 Park Ave S NY, USA</li>
              </ul>
            </div>
          </div>
      	</div>
      </div>
      <div class="copyright">
        <p>Thunder Team © 2016. All rights reserved</p>
      </div>
		</footer>