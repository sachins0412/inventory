<?php
session_start();
$user=$_SESSION['user'];
include "usernav.php";
$catid=$_GET['cat'];
$sql="SELECT name FROM category WHERE catid='$catid'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
$subcat=$_GET['subcat'];
$sql2="SELECT * FROM subcategory WHERE catid='$catid' AND name='$subcat' AND user='$user'";
$result2=mysqli_query($conn,$sql2);
$count=mysqli_num_rows($result2);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container mt-5" >
	<div class="row">
		<div class="col-md-6">
			<div class="card">
  <div class="card-header">
    <strong>StockIn</strong>
  </div>
  <div class="card-body">
  	<div class="row">
  		<div class="col-sm-6">
    <h5 class="card-title">Category: <span style="font-weight: 10;font-family: TIMES"><?php echo ucfirst($row[0]); ?></span></h5>
    <h5 class="card-title">SubCategory: <span style="font-weight: 10;font-family: TIMES"><?php echo ucfirst($subcat); ?></span></h5>
    </div>
    <div class="col-sm-6">
    	<h5 class="card-title">Available: <span style="font-weight: 10;font-family: TIMES"><?php
    	if($count>0) echo $row[3];
    	else 
    	echo 0; ?></span></h5>
    </div>
</div>
    <p class="card-text"><form method="POST">
  <div class="form-group">
    <label>StockIn</label>
    <input type="text" class="form-control" name="quan" id="quan" placeholder="Enter Quantity">
    
  </div>
  <div class="row">
  	<div class="col-sm-6">
  <div class="form-group">
    <label>UnitCost</label>
    <input type="text" class="form-control" name="unit" placeholder="Cost per unit" onchange="myfun(this.value)">
  </div>
</div>
<div class="col-sm-6">
  <div class="form-group">
    <label>TotalCost</label>
    <input type="text" class="form-control" id="total" disabled value="" >
    
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
    <strong>StockOut</strong>
  </div>
  <div class="card-body">
    <h5 class="card-title">Category: <span style="font-weight: 10;font-family: TIMES"><?php echo ucfirst($row[0]); ?></span></h5>
    
    <h5 class="card-title">SubCategory: <span style="font-weight: 10;font-family: TIMES"><?php echo ucfirst($subcat); ?>
    	</span></h5>
    
    <p class="card-text"><form>
  <div class="form-group">
    <label>StockIn</label>
    <input type="text" class="form-control" placeholder="Enter Quantity">
    
  </div>
  <div class="form-group">
    <label>UnitCost</label>
    <input type="text" class="form-control" placeholder="Cost per unit">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form></p>
    
  </div>
</div>
<script type="text/javascript">
	function myfun(cost){
		var quan=document.getElementById('quan').value;
		if(quan){
			var total= cost*quan;
		}
		else{
			var total=0;
		}
		document.getElementById('total').setAttribute("value",total);
	}
</script>
</body>
</html>