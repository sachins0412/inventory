<?php
include "navbar.php";
$cat=$_POST['cat'];
$sql="INSERT INTO category(name) VALUES('$cat')";
$result=mysqli_query($conn,$sql);?>
	<html>
	<head>
  <style type="text/css">
      .bg1{
background: url(bg.jpg) repeat center center/cover;
  background-attachment:fixed; 
  background-size:auto*1.5rem auto;
  height: 40em;
}
  </style></head>
	<body><div class="bg1">
	<?php

if($result){?>
<div class="container  " style="padding-top:5em;">
  <div class="jumbotron " style="color:white;background-color:rgba(0,6,1,0.5);">
    <h1>SUCCESS</h1> 
    <p>Category Created successfully</p> 
  </div>
  
</div>
	<?php }

else{
	?>
	<div class="container  " style="padding-top:5em;">
  <div class="jumbotron " style="color:white;background-color:rgba(0,6,1,0.5);">
    <h1>FAILED</h1> 
    <p>Category Creation FAILED</p> 
  </div>
  
</div>
	<?php
}
?>	
</div>
	</body>
	</html>
