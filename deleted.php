<head>
	<style type="text/css">
			.bg1{
background: url(bg.jpg) repeat center center/cover;
  background-attachment:fixed; 
  background-size:auto*1.5rem auto;
  height: 40em;

}
	</style></head>
<?php
session_start();
include "navbar.php";
$user=$_SESSION['user'];
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
$subcat=$_GET['subcat'];	
$catid=$_GET['cat'];?><div class="bg1" style="margin-top:"> <?php
if(empty($subcat) )
{
$sql2="DELETE FROM category WHERE catid='$catid'";
$result2=mysqli_query($conn,$sql2);
if($result2)
{?>

	
	
	<div class="container  " style="padding-top:5em;">
  <div class="jumbotron " style="color:white;background-color:rgba(0,6,1,0.5);">
    <h1>SUCCESS</h1> 
    <p>Category Deleted successfully</p> 
  </div>
  
</div>
	<?php
}
else
{
	?><div class="container  " style="padding-top:5em;">
	 <div class="jumbotron" style="color:white;background-color:rgba(0,6,1,0.5);">
    <h1>ERROR</h1> 
    <p>Cannot be deleted as this category is currently in use</p> 
  </div>
  
</div>
	<?php
}
}
else
{
$sql="SELECT * FROM subcategory WHERE name='$subcat' AND catid='$catid' and user NOT LIKE 'admin'";
$result=mysqli_query($conn,$sql);
$count=mysqli_num_rows($result);
if($count>0)
{
	?>
	<div class="container  " style="padding-top:5em;">
  <div class="jumbotron" style="color:white;background-color:rgba(0,6,1,0.5);">
    <h1>ERROR</h1> 
    <p>Cannot be deleted as this subcategory is currently in use</p> 
  </div>
  
</div>
	<?php
}
else{

$sql="DELETE FROM subcategory WHERE name='$subcat' and catid='$catid'  ";
$result=mysqli_query($conn,$sql);
?>
	<div class="container  " style="padding-top:5em;">
  <div class="jumbotron " style="color:white;background-color:rgba(0,6,1,0.5);">
    <h1>SUCCESS</h1> 
    <p>Deleted successfully</p> 
  </div>
  
</div>
	<?php
}
}



?>

</div>