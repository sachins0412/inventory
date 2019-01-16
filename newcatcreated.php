<?php
include "navbar.php";
$catname=$_POST['name'];
$sql="INSERT INTO category(name) VALUES('$catname')"; 
$result=mysqli_query($conn,$sql);
if($result)
{
	echo "category created successfully";
	?>
	<html>
	<head></head>
	<title></title>
	<body><a href=index.php><button>go back</button></a>
	</body>
	</html>
	<?php
}
else 
{
 echo "failed to create";
}
?>
