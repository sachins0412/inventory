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
include "navbar.php";
?>
<html>
<head>
</head>
<title>
</title>
<body>
	
    	<div class="bg1" style="height: 40em; width: 100%; ">
<div class="container " style="padding-top: 5em;" >
	<div class="row">
		<div class="col-md-6">
			<div class="card">
  <div class="card-header">
    <strong>New Category</strong>
  </div>
  <div class="card-body">
  	
    <p class="card-text">
    	<form method="POST" action="newcatcreated.php">
      
  <div class="row">
  	<div class="col-sm-6">
  <div class="form-group">
    <label>Category</label>
    <input type="text" class="form-control" name="cat" id="cost" placeholder="Enter Category name" required >
  </div>
</div>

</div>  
  <button type="submit" class="btn btn-primary">Submit</button>
</form></p>
    
  </div>
</div>
		</div>
		<div class="col-md-6">
			<div class="card">
  <div class="card-header">
    <strong>New Subcategory</strong>
  </div>
  <div class="card-body">
  	
    <p class="card-text">
    	<form method="POST" action=" newsubcatcreated.php">
      
  <div class="row">
<div class="col-sm-6">
<?php
	$sql="SELECT * FROM category";
	$result=mysqli_query($conn,$sql);
	?>
<div class="form-group">
	<label>Category</label>
	<select class="form-control" name='catid'>
    <option disabled selected>Select Category</option>
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
	?></div>
	</div>
	  	<div class="col-sm-6">
  <div class="form-group">
    <label>Subcategory</label>
    <input type="text" class="form-control" name="subcatname" id="cost" placeholder="Enter Subcategory name" required >
  </div>
</div>

</div>  
  <button type="submit" class="btn btn-primary">Submit</button>
</form></p>
    
  </div>
</div>
		</div>
		</div>
</div>
</div>

</body>
</html>