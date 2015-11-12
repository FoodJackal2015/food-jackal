<?PHP
include '../classes/database/database-connect.php';
$con = new Database();
$con->connectToDatabase();

$sql = "DELETE FROM customer WHERE customerId = ".$_COOKIE['user']."";

if($result = $con->selectData($sql)){

header("Location:../");
}
else{
	echo '<div class="alert alert-warning alert-dismissible" id="poll" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Something went wrong...
</div>';
}

?>
