<nav class="navbar navbar-inverse navbar-fixed-top main-top-nav" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div>
                <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/FoodJackal">
                    <img src="http://cloud.graham-murray.com/share/minecraft.png" height="40px" width="120px"/>
                </a>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/FoodJackal">Vendors</a>
                </li>
                <li>
                    <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/FoodJackal/services">Services</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form class="navbar-form" action="http://<?php echo $_SERVER['SERVER_NAME'];?>/FoodJackal/search/search.php" method="GET" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="key" id="key">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </li>
                <li title="My Settings">
                    <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/FoodJackal/account/customer/settings.php"><span class="glyphicon glyphicon-cog"></span></a>
                </li>
                <li title="My Profile">
                    <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/FoodJackal/account/customer/profile.php"><span class="glyphicon glyphicon-user"></span></a>
                </li>
                <li title="Logout">
                    <a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/FoodJackal/login/logout.php"><span class=" glyphicon glyphicon-log-out"></span></a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
