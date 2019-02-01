<?php session_start();
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
$catid=$_GET['catid'];
$subcat=$_GET['subcat'];
$count=$_GET['count'];
$quan=$_POST['quan'];
$user=$_SESSION['user'];
$sign=$_GET['sign'];
$unit=$_POST['unit'];


$total=$unit*$quan;


if($sign==1){
	$supp=$_POST['supp'];
if($count>0){

$sql="UPDATE subcategory SET quantity= quantity + '$quan' WHERE  catid='$catid' AND name='$subcat' AND user='$user'";
$result=mysqli_query($conn,$sql);

}
else{
	$sql="INSERT INTO subcategory(catid,name,quantity,user) VALUES('$catid','$subcat','$quan','$user')";
	$result=mysqli_query($conn,$sql);
}
$sql2="INSERT INTO stockin(catid,subcat,unitcost,totalcost,supplier,user) VALUES('$catid','$subcat','$unit','$total','$supp','$user')";
$result2=mysqli_query($conn,$sql2);
}
else{
	
$buy=$_POST['buy'];
$sql="UPDATE subcategory SET quantity= quantity-'$quan' WHERE  catid='$catid' AND name='$subcat' AND user='$user'";
$result=mysqli_query($conn,$sql);

$sql2="INSERT INTO stockout(catid,subcat,unitcost,totalcost,buyer,user) VALUES('$catid','$subcat','$unit','$total','$buy','$user')";
$result2=mysqli_query($conn,$sql2);

}
header("refresh:0;url=indexuser.php");
echo '<script language="javascript">';
echo 'alert("SAVED SUCCESFULLY")';
echo '</script>';

?>