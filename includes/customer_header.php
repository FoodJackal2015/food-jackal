<script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link href="https://bootswatch.com/cosmo/bootstrap.min.css" rel="stylesheet">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../">FoodJackal</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="../customer/cart.php">Cart</a>
                    </li>
                    <li>
                        <a href="../customer/profile.php?profile=My-Details">Profile</a>
                    </li>
                </ul>
				<ul class="nav navbar-nav navbar-right">
				<li>
				 <form class="navbar-form" action="../customer/search/search.php?go" method="post" role="search">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Search" name="srchterm" id="srchterm">
			<div class="input-group-btn">
				<button class="btn btn-default" name ="submit" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			</div>
		</div>
		</form>
		</li>
				<li>
                    <a href="../customer/settings.php?setting=My-Settings"><i class="glyphicon glyphicon-cog"></i>Settings</a>
                </li>	
				<li>
					<a href="../Login/Logout.php"><i class="glyphicon glyphicon-log-out"></i>Logout</a>
				</li>
      </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
