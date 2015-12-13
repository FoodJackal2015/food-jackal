<?php
/*
 * @category  Customers Favourite Store
 * @package   customer/profile
 * @file      favourites.php
 * @data      25/11/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
*/


include_once('../../classes/database/database-connect.php');
$con = new Database();
$con->connectToDatabase();

$test = "SELECT COUNT(*) AS n FROM `Vendor`";

if($test_result = $con->selectData($test))
{
    $roa = mysqli_fetch_array($test_result);
}
?>
<link rel="stylesheet" type="text/css" href="../../css/my-favourites.css"/>
<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="?profile=My-Details" class="list-group-item">My Details</a>
            <a href="?profile=My-Orders" class="list-group-item">My Orders</a>
            <a href="?profile=Favourites" class="list-group-item active">Favourites</a>
        </div>
    </div>
    <div class="col-md-9">
        <h1 class="text-center"><?php echo $_SESSION['customerFname'];?>'s Favourites</h1>
        <div class="scroll-pane">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="col-md-2 col-lg-2">Store</th>
                        <th class="col-md-3 col-lg-3">Location</th>
                        <th class="col-md-1 col-lg-1">No. Orders</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $n = intval($roa['n']);
                    
                    //Loop to output table row for each entry
                    for($i = 0; $i<=$n; $i++)
                    {
                        ${'$n'} = "SELECT COUNT(*) AS NumberOfOrders, `Vendor`.`vendorName`,`Vendor`.`vendorAddressLine1`,`Vendor`.`vendorAddressLine2`,`Vendor`.`vendorId` 
                                   FROM `Order` 
                                   INNER JOIN `Vendor` ON `Order`.`FK_vendorId` = `Vendor`.`vendorId` 
                                   WHERE `FK_customerId` = '".$_SESSION['customerId']."' AND FK_vendorId ='$i'";

                        if(${'$nresult'}= $con->selectData(${'$n'}))
                        {
                            ${'$nrow'} = mysqli_fetch_array(${'$nresult'});
                            ${'$ntitle'} = ${'$nrow'}['vendorName'];
                            ${'$naddress'} = ${'$nrow'}['vendorAddressLine1'].' '.${'$nrow'}['vendorAddressLine2'];
                            ${'$nnum'} = ${'$nrow'}['NumberOfOrders'];
                            ${'$nnu'} = ${'$nrow'}['vendorId'];
                        }

                        if(intval(${'$nnum'})==0)
                        {
                            echo "";
                        }
                        else{
                            echo '<tr>';
                            echo '<td><a href="../../cart/view-products.php?vid='.${'$nnu'}.'">'.${'$ntitle'}.'</a></td>';
                            echo '<td>'.${'$naddress'}.'</td>';
                            echo '<td>'.${'$nnum'}.'</td>';
                            echo '</tr>';
                            }
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
