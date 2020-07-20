<?php 
$servername = "localhost";
$username = "root";
$password = "***";
$dbname = "***";

session_start();

$mysqli = new mysqli($servername,$username,$password,$dbname) or die (mysqli_error($mysqli));

$id = 0;
$update = false;
$name = "";
$location = "";

//Data Inserting using Submit Button 
if (isset($_POST['save'])) {
	$name = $_POST['name'];
	$location = $_POST['location'];
	$mysqli->query("INSERT INTO crud(name, location) VALUES('$name','$location')") or die($mysqli->error);
	echo "Data Inserted";

	$_SESSION['message'] = "Record Has Been Saved";
	$_SESSION['msg_type'] = "success";

	header("location: index.php");
}

//Delete data using Delete Button
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM crud WHERE id=$id") or die($mysqli->error());	
	echo "Data Deleted";	

	$_SESSION['message'] = "Record has been deleted";
	$_SESSION['msg_type'] = "danger";

	header("location: index.php");
}

//Edit data using Edit Button
if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM crud WHERE id=$id") or die($mysqli->error());
	if ($result->num_rows) {
		$row = $result->fetch_array();
		$name = $row['name'];
		$location = $row['location'];
	}
}

if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$location = $_POST['location'];

	$mysqli->query("UPDATE crud SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error);

	$_SESSION['message'] = "Record has been updated";
	$_SESSION['msg_type'] = "warning";

	header('location: index.php');	 
}
?>