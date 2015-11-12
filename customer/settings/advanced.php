  
    <script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
       <script type="text/javascript">
            
  
  $(document).ready(function ()
            {
                $("button").click('m#yBtn', function ()
                {
                    //var fn = $("#fname").val();
                    //var ln = $("#lname").val();
                    //var data = 'fname='+fn+'&lname='+ln;
                    var data = $(this).serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'delete_account.php',
                        data: data,
                        success: function (data)
                        {         
                            $(".result").fadeIn(500).show(function ()
                            {
                                $(".result").html(data);
                            });
                            
                        }//Close Success
                    });
                    return false;
                });
            });

  $(document).ready(function ()
            {
                $("button").click('#orbtn',function ()
                {
                    //var fn = $("#fname").val();
                    //var ln = $("#lname").val();
                    //var data = 'fname='+fn+'&lname='+ln;
                    var data = $(this).serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'delete_orders.php',
                        data: data,
                        success: function (data)
                        {         
                            $(".result").fadeIn(500).show(function ()
                            {
                                $(".result").html(data);
                            });
                            
                        }//Close Success
                    });
                    return false;
                });
            });
    
        </script>
    <!-- Page Content -->
    <div class="container">
    

        <div class="row">
        <br>
        <br/>
        <br>
        </div>
           <div class="alert alert-danger" role="alert">
  Be cautious of what you do with your personal data, and your account settings.
</div>
        <div class="row">
       

            <div class="col-md-3">
                <p class="lead">Advanced</p>
                <div class="list-group">
                    <a href="settings.php?setting=My-Settings" class="list-group-item">My Settings</a>
                    <a href="settings.php?setting=General" class="list-group-item">General</a>
                    <a href="settings.php?setting=Advanced" class="list-group-item active">Advanced</a>
                </div>
            </div>
        

            <div class="col-md-9">
                 <div class="result">
    <br>
    </div>
            <br>
            <br>
            <div class="thumbnail">
            <form id="reg-form" role="form" >
<div ng-app="myApp" ng-controller="myCtrl">
    <div class="form-group">
    <label>Delete Account(Enter "<span style="color:red;">FOODJACKAL</span>"):</label>
      <input type="text" class="form-control" ng-model="del" id="del"  placeholder="Enter in 'FOODJACKAL' here:">
      <span ng-if="del =='FOODJACKAL'" style="color:red;">Are you really sure about this?</span>
    <div class="text-right">
    <button type="submit" id="myBtn"  ng-model="button" class="btn btn-danger btn-m">
  <span  class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove
</button>
</div>
</div>
</form>
        <form id="reg2-form" role="form" >
      <div class="form-group">
    <label>Delete Orders(Enter "<span style="color:red;">DELETE</span>"):</label>
      <input type="text" class="form-control" ng-model="del2" id="del"  placeholder="Enter in DELETE here:">
       <span ng-if="del2 =='DELETE'" style="color:red;">Are you sure about this?</span>
    <div class="text-right">
    <button type="submit" id="orbtn" name="submit"  ng-model="button" class="btn btn-danger btn-m">
  <span  class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
</button>

</form>
</div>
</div>
    </div>
    </div>
           

            </div>
 
 <script>
var app = angular.module('myApp', []);
app.controller("myCtrl",function($scope) {
    $scope.del = '';
    $scope.$watch('del', function () {
            if ($scope.del == "FOODJACKAL") {
                document.getElementById("myBtn").disabled = false;
        }
        else{
                    document.getElementById("myBtn").disabled = true;
        }
});
          $scope.del2 = '';
    $scope.$watch('del2', function () {
            if ($scope.del2 == "DELETE") {
                document.getElementById("orbtn").disabled = false;
        }
        else{
                    document.getElementById("orbtn").disabled = true;
        }
});
});
 </script>
