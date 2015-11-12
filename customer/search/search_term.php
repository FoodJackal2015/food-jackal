 <?php
if(isset($_POST['submit'])){
if(isset($_GET['go'])){
if(preg_match("/[A-Z | a-z]+/", $_POST['srchterm'])){
$srchterm=$_POST['srchterm'];
//connect to the database
include '../classes/database/database-connect.php';
$con = new Database();
$con->connectToDatabase();



//-query the database table
$sql="SELECT * FROM product WHERE productTitle LIKE '%" . $srchterm . "%'";
//-run the query against the mysql query function
$result=$con->selectData($sql);
//-count results
$numrows=mysqli_num_rows($result);
echo "<p>" .$numrows . " results found for " . stripslashes($srchterm) . "</p>"; 
//-create while loop and loop through result set
while($row=mysqli_fetch_array($result)){
$title =$row['productTitle'];
	$description=$row['productDesciption'];
	$id=$row['productId'];
	$price=$row['productPrice'];	
	$date = $row['productAddedDate'];

	include_once("../classes/security/timeago.php"); // Include the class library
        $timeAgoObject = new convertToAgo;
        $convertedTime = ($timeAgoObject -> convert_datetime($date)); // Convert Date Time
        $when = ($timeAgoObject -> makeAgo($convertedTime));
//-display the result of the array
echo '<br><br>';
echo '<div class="container">';
echo '<div class="thumbnail">';
echo '<h3><u>Product:</u> <a href="product.php?id='.$id.'">'  .$title .'</a></h3><br><p>Date: <i>' .$when. '</i></p><br>';
echo "<h4><u>Description</u>:</h4> <p><i>" .$description. "</i></p><br><h5><b>Price: €".$price."</b></h5>";
echo "</div>";
echo "</div>";
}
}
else{
echo "<p>Please enter a search query</p></div></div>";
}
}
else{
	header("Location: ../");
}

}
else{
	header("Location: ../");
}
?>
