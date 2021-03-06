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
              <a class="navbar-brand" href="/">Account Abroad</a>
            </div>
            <div class="navbar-collapse collapse">
              <?php if ($session->isLoggedIn()) { ?>
	              <ul class="nav navbar-nav">
		              <li class="active"><a href="/">Home</a></li>
		              <li><a href="/dashboard">My Dashboard</a></li>
		              <li><a href="/report">Reports</a></li>
		              <li><a href="https://accountabroad.zendesk.com/hc/en-us">Help</a></li>
	              </ul>
	              <ul class="nav navbar-nav navbar-right">
			              <li class="navbar-text">Hello, 
			              <?php 
 			              $user = new User();
			              $result = $user->getOneById($session->user_id);
			              echo $result['username'];
			              ?></li>
			              <li><button onclick="window.location='/logout'" type="button" class="btn btn-default navbar-btn">Sign Out</button></li>
			      </ul>
              <?php 
              } else {
				?>
				<ul class="nav navbar-nav">
				<li class="active"><a href="/">Home</a></li>
				<li><a href="https://accountabroad.zendesk.com/hc/en-us">Help</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				<li><a href="/user/create_user">Create Account</a></li>
				<li><button onclick="window.location='/login'" type="button" class="btn btn-default navbar-btn">Sign In</button></li>
				</ul>
			<?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>