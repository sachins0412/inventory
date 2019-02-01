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
$catid=$_POST['datapost'];	
$sql="SELECT name FROM subcategory WHERE catid='$catid' AND user='admin'";
$result=mysqli_query($conn,$sql);
?>
<option value="" disabled selected>Sub-category</option>
<?php
while($row=mysqli_fetch_row($result)){
								?>
								<option value=<?php echo $row[0];?>> <?php echo $row[0];?></option>
								<?php
									}

?>