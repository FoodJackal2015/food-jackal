<?php
if(isset($_COOKIE['pay'])){
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Food Jackal - Home</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cerulean/bootstrap.min.css" rel="stylesheet">

    
            <script>
                function check(){
                   if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                    xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("poll").innerHTML=xmlhttp.responseText;
                }
            }
 
                xmlhttp.open("POST","check.php");
                xmlhttp.send();
            }
            </script>
</head>

<body style ='background-color: #C0C0C0;'>
    <!-- Navigation -->
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
                <a class="navbar-brand" href="#"><font face="magneto">FoodJackal</font></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="">Services</a>
                    </li>
                    <li>
                        <a href="Contact">Contact</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <li>
                 <form class="navbar-form" action="search.php?go" method="post" role="search">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="srchterm" id="srchterm">
            <div class="input-group-btn">
                <button class="btn btn-default" name ="submit" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
        </li>
                    <li>
                    <a href="Signup">Signup</a>
                </li>
                <li>
                    <a href="Login">Login</a>
                </li>
      </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
   <div> 
        
        <a type="image" src="c:\users\niall\desktop\cart.png" alt="Submit" title="Go to shopping cart" width="200" height="150" style="float:right; margin-top:75px; margin-right:20px"></a>
        
   </div>

    <div> 
        
        <a type="image" src="c:\users\niall\desktop\acc.png" alt="Submit" width="200" height="150" title="Go to shopping cart"  style="float:right; margin-top:330px; margin-right:-200px"></a>
        
   </div>

    <div> 
        
        <a type="image" src="c:\users\niall\desktop\logo.jpg" alt="Submit" width="200" height="150" title="Go to shopping cart" style="float:right; margin-top:600px; margin-right:-200px"></a>
        
   </div>


    <div class="container top-margin-content" >

        <div class="row">


            </br></br></br>
            <center><div class="col-md-9">

                <div class="thumbnail" style="border-style:solid; border-width:5px; border-color: #0D4F8B" >
                </br>
                    <img class="img-responsive" src="..\images\logo.jpg" alt="">
                    <hr style="border-style:inset; border-width:1px; border-color: #0D4F8B">
                    <div class="caption-full">

                    </br></br>
                      <h3 style='font-family:impact; color: #0D4F8B'><u>Special deals for the week: </u></h3>
                        </br>
                        <div class="col-md-3"> 
                            <img class="img-responsive" src="..\images\shop1.jpg" alt="shop1" style="width:200px; height:100px">
                            <center><h5>Burrito Student Deal</h5></center>
                            <center><h4><b>€5</b></h4></center>
                            <center><div class="ratings">
                                
                                    
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                            
                            </div></center>
                        </div>
                        
                        <div class="col-md-3"> 
                            <img class="img-responsive" src="c:\users\niall\desktop\shop2.jpg" alt="shop2" style="width:200px; height:100px">
                            <center><h5>Chicken Fillet Roll</h5></center>
                            <center><h4><b>€2.50</b></h4></center>
                            <center><div class="ratings">
                                
                                    
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                            
                            </div></center>
                        </div>
                        
                        <div class="col-md-3"> 
                            <img class="img-responsive" src="..\images\shop2.jpg" alt="shop3" style="width:200px; height:100px">
                            <center><h5> 6 Inch Meatball Marinara</h5></center>
                            <center><h4><b> €3 </b></h4></center>
                            <center><div class="ratings">
                                
                                    
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                            
                            </div></center>
                        </div>
                        
                        <div class="col-md-3"> 
                            <img class="img-responsive" src="..\images\shop3.jpg" alt="shop4" style="width:200px; height:100px" >
                            <center><h4>Chicken Wrap</h4></center>
                            <center><h4><b> €2.50 </b></h4></center>
                            <center><div class="ratings">
                                
                                    
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                            
                            </div></center>
                        </div>
                                                      
                    </div>
                
                   <center><div>
                        

                                    
                            <input type="image" src="..\images\button.jpg" alt="Submit" height="120px" width="220px">
                                       
                            
                    </div></center>
                </div>




                <div class="well">
                    
                   

                    

              

            </div>

        </div>

    </div></center>
    

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <center><p>Copyright &copy; FoodJackal</p></center>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
