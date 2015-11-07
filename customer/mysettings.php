    <!-- Page Content -->
    <script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    
    <div class="container">

        <div class="row">
        <br>
        <br/>
        <br>
        </div>
        <div class="row">

            <div class="col-md-3">
                <p class="lead">My Settings</p>
                <div class="list-group">
                    <a href="settings.php?setting=My-Settings" class="list-group-item active">My Settings</a>
                    <a href="settings.php?setting=General" class="list-group-item">General</a>
                    <a href="settings.php?setting=Advanced" class="list-group-item">Advanced</a>
                </div>
            </div>

            <div class="col-md-9">
            <br>
            <br>
            <div class="thumbnail">
            <form action="ccchange.php"  method="post" role="form" >
    <div ng-app="">
      <label>Card Number:</label>
      <input type="text" class="form-control" ng-model = "ccnum" id="ccnumber" name="ccnumber" placeholder="xxxxxxxxxxxxxxxx">
    <span ng-if="ccnum.length != 16" style="color:red;">Incorrect amount of numbers</span>
     
     <div class="form-group">
      <label>Expiry Date:</label>
      <input type="text" class="form-control" ng-model="expiry" id="expiry"  name="expiry" placeholder="xx/xx">
      <span ng-if="expiry.length !=5" style="color:red;">Incorrect format</span>
    </div>
    <div class="form-group">
      <label>CVV:</label>
      <input type="text" class="form-control" ng-model="cvv" name="cvv" id="cvv" placeholder ="xxx">
      <span ng-if="cvv.length !=3" style="color:red;">Incorrect amount of numbers</span>
    </div>
    </div>
    </div>
    <div class="text-right">
    <input type="submit" name="submit" Value="Update" class="btn btn-success"></a>
     </div>
     </div>
    </form>
           

            </div>

        </div>

    </div>
    <!-- /.container -->
