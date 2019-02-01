<?php

	
$servername = "localhost";
$username = "root";
$password = "";
$db="inventory";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$uname=$_POST['uname'];
$pw=$_POST['pword'];

$sql="SELECT * FROM users WHERE username='$uname' AND password='$pw'";

$result = mysqli_query($conn,$sql);
$count= mysqli_num_rows($result);
if($count>0)
{   
	session_start();
	$_SESSION["user"] = $uname;
	if($uname=="admin")
	header('Location: index.php?user='.$uname);
else header('Location: indexuser.php?user='.$uname);
}
else
{
	echo "username or password incorrect";
	header('Location: login.php');
	
}
?>