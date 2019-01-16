<?php
include "navbar.php";
$catid=$_POST['catid'];
$subname=$_POST['subcatname'];
$sql="INSERT INTO subcategory(name,catid) VALUES('$subname','$catid')";
$result=mysqli_query($conn,$sql);
if($result){
	echo "inserted succesfully";?>
	<html>
	<head></head>
	<title></title>
	<body><a href=index.php><button>go back</button></a>
	</body>
	</html>
<?php }
else{
	echo "failed with stupid error";
}
?>