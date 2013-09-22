  <!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">
        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Project name</a>
            </div>
            <div class="navbar-collapse collapse">
              <?php
              if ($session->isLoggedIn()) {
              ?>
	              <ul class="nav navbar-nav">
		              <li class="active"><a href="#">Home</a></li>
		              <li><a href="#contact">Help</a></li>
		              <li><a href="dashboard.php?id=<?php echo $_SESSION['user_id']; ?>">My Dashboard</a></li>
	              </ul>
	              <ul class="nav navbar-nav navbar-right">
			              <li class="navbar-text">Hello, 
			              <?php 
			              $user = new User();
			              $id = $_SESSION['user_id'];
			              $result = $user->getOneById($id);
			              echo $result['username']; 
			              ?></li>
			              <li><button onclick="window.location='logout.php'" type="button" class="btn btn-default navbar-btn">Sign Out</button></li>
			      </ul>
              <?php 
              } else {
				?>
				<ul class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#contact">Help</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				<li><button onclick="window.location='login.php'" type="button" class="btn btn-default navbar-btn">Sign In</button></li>
				</ul>
			<?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>