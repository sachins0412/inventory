<head>
	<style type="text/css">
			.bg1{
background: url(bg.jpg) repeat center center/cover;
  background-attachment:fixed; 
  background-size:auto*1.5rem auto;
  height: 40em;
   }
	</style></head><div class="bg1">
<?php
include "navbar.php";
session_start();
$cat=$_POST['cat'];



$sql="INSERT INTO category(name) VALUES('$cat')";
$result=mysqli_query($conn,$sql);
if($result){
	?>
	<div class="container  " style="padding-top:5em;">
  <div class="jumbotron " style="color:white;background-color:rgba(0,6,1,0.5);">
    <h1>SUCCESS</h1> 
    <p> Category Created successfully</p> 
  </div>
  
</div>
	<?php
}
	 
else{
	?>
	<div class="container  " style="padding-top:5em;">
  <div class="jumbotron " style="color:white;background-color:rgba(0,6,1,0.5);">
    <h1>ERROR</h1> 
    <p>Failed to create</p> 
  </div>
  
</div><?php
}
?>
</div>