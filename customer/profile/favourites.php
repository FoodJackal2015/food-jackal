


 <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="?profile=My-Details" class="list-group-item">My Details</a>
                    <a href="?profile=My-Orders" class="list-group-item">My Orders</a>
                    <a href="?profile=Favourites" class="list-group-item active">Favourites</a>
                </div>
            </div>
            <div class="col-md-9">
                                         <table class="table table-striped">
    <thead>
      <tr>
        <th>Store</th>
        <th>No. Orders</th>
      </tr>
    </thead>
    <tbody>
    <tr>
    <td>

    </tr>
    <?php

include '../classes/database/database-connect.php';
$con = new Database();
$con->connectToDatabase();

$test = "SELECT COUNT(*) AS n FROM vendor";
if($test_result = $con->selectData($test)){
    $roa = mysqli_fetch_array($test_result);
}
$n = intval($roa['n']);

for($i = 0; $i<=$n; $i++){


    ${'$n'} = "SELECT COUNT(*) AS NumberOfOrders,vendor.vendorName,vendor.vendorId FROM Orders 
                    inner join vendor on orders.FK_vendorId = vendor.vendorId 
                    where FK_customerId = '".$_COOKIE['user']."' AND FK_vendorId ='$i'";

    if(${'$nresult'}= $con->selectData(${'$n'})){
    ${'$nrow'} = mysqli_fetch_array(${'$nresult'});
    ${'$ntitle'} = ${'$nrow'}['vendorName'];

    ${'$nnum'} = ${'$nrow'}['NumberOfOrders'];
    ${'$nnu'} = ${'$nrow'}['vendorId'];
}
if(intval(${'$nnum'})==0){
    echo "";
}
else{
echo '<tr>
        <td><a href="vendor.php?vid='.${'$nnu'}.'">'.${'$ntitle'}.'</a></td>
        <td>'.${'$nnum'}.'</td>
      </tr>';
}
}

?>


    </tbody>
  </table>

            </div>

        </div>
