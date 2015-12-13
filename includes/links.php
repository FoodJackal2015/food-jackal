<?php
/*
 * @category  Includes for Core CSS and Javascript
 * @package   includes
 * @file      links.php
 * @data      26/10/15
 * @author    Graham Murray <graham@graham-murray.com>
 * @copyright Copyright (c) 2015
*/

$SERVER = "http://".$_SERVER['HTTP_HOST']."/FoodJackal/";
?>

<link href="https://bootswatch.com/cosmo/bootstrap.min.css" rel="stylesheet">
<!-- AngularJS -->
<script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script> 


<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


<!-- Bootstrap Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

<!-- Custom CSS -->
<link href="./css/custom.css" rel="stylesheet">

<!-- styles needed by jScrollPane -->
<link type="text/css" href="<?php echo $SERVER;?>/css/jquery.jscrollpane.css" rel="stylesheet" media="all" />

<!-- the mousewheel plugin - optional to provide mousewheel support -->
<script type="text/javascript" src="http://jscrollpane.kelvinluck.com/script/jquery.mousewheel.js"></script>

<!-- the jScrollPane script -->
<script type="text/javascript" src="http://jscrollpane.kelvinluck.com/script/jquery.jscrollpane.min.js"></script>

<!-- jScrollPane Settings -->
<script type="text/javascript" id="sourcecode" src="<?php echo $SERVER;?>javascript/jscroll.settings.js"></script> 


 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->