<?php
include "navbar.php";
?>
<html>
<head>
	</head>
	<title>
		 
	</title>
	<body>
<?php
	$sql="SELECT * FROM category";
	$result=mysqli_query($conn,$sql);
	?>
<form action="newsubcatcreated.php" method="POST">
	<select name='catid'>
	<?php
	if(mysqli_num_rows($result)>0){
		while($row= mysqli_fetch_row($result)){

			?>
			<option value=<?php echo $row[0]?>>
				<?php echo $row[1];?>
			</option>
		<?php }?>
			</select><?php
		
	}
	?>
	ENTER NAME:<input type="text" name="subcatname" required><br>
	
	<input type="submit">	
	</form>
</body>
	</html>