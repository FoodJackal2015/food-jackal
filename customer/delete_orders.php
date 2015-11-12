<?PHP
include '../classes/database/database-connect.php';
$con = new Database();
$con->connectToDatabase();

$sql = "DELETE FROM orders WHERE FK_customerID = '".$_COOKIE['user']."'";

if($result = $con->selectData($sql)){

echo '<div class="alert alert-info alert-dismissible" id="poll" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Orders have been deleted.
</div>';
}
else{
	echo '<div class="alert alert-warning alert-dismissible" id="poll" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Something went wrong...
</div>';
}

?>
