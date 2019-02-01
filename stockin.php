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
$row2=mysqli_fetch_row($result2);
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
    	<h5 class="card-title">Available: <span id="avail" style="font-weight: 10;font-family: TIMES"><?php
    	if($count>0) echo $row2[3];
    	else 
    	echo 0; ?></span></h5>
    </div>
</div>
    <p class="card-text"><form method="POST" action="insertstock.php?catid=<?php echo $catid?>&subcat=<?php echo $subcat?>&count=<?php echo $count?>&sign=1">
      <div class="row">
      <div class="col-sm-6">
  <div class="form-group">
    <label>StockIn</label>
    <input type="text" class="form-control" name="quan" id="quan" placeholder="Enter Quantity" required onchange="myfun2(this.value)">
    
  </div></div>
  <div class="col-sm-6">
  <div class="form-group">
    <label>Supplier</label>
    <input type="text" class="form-control" name="supp" id="" placeholder=" Supplier's name" required>
  </div>
</div></div>
  <div class="row">
  	<div class="col-sm-6">
  <div class="form-group">
    <label>UnitCost</label>
    <input type="text" class="form-control" name="unit" id="cost" placeholder="Cost per unit" required onchange="myfun(this.value)">
  </div>
</div>
<div class="col-sm-6">
  <div class="form-group">
    <label>TotalCost</label>
    <input type="text" class="form-control" id="total" name="total" disabled value="" >
    
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
  	<div class="row">
  		<div class="col-sm-6">
    <h5 class="card-title">Category: <span style="font-weight: 10;font-family: TIMES"><?php echo ucfirst($row[0]); ?></span></h5>
    <h5 class="card-title">SubCategory: <span style="font-weight: 10;font-family: TIMES"><?php echo ucfirst($subcat); ?></span></h5>
    </div>
   
</div>
    <p class="card-text">
      <form method="POST" action="insertstock.php?catid=<?php echo $catid?>&subcat=<?php echo $subcat?>&count=<?php echo $count?>&sign=2">
  <div class="row">
    <div class="col-sm-6">
  <div class="form-group">
    <label>StockOut</label>
    <input type="text" class="form-control" name="quan" id="quan2" placeholder="Enter Quantity" required onchange="myfun3(this.value)">
    <div id ="errors">
      </div>
  </div></div>
<div class="col-sm-6">
  <div class="form-group">
    <label>Buyer</label>
    <input type="text" class="form-control" name="buy" id="" placeholder="Buyer's name" required>
  </div>
</div>
</div>
  <div class="row">
  	<div class="col-sm-6">
  <div class="form-group">
    <label>UnitCost</label>
    <input type="text" class="form-control" name="unit" id="cost2" placeholder="Cost per unit" onchange="myfun4(this.value)" required>
  </div>
</div>
<div class="col-sm-6">
  <div class="form-group">
    <label>TotalCost</label>
    <input type="text" class="form-control" id="total2" name="total2" disabled value="" >
    
  </div>
</div>
</div>  
  <button type="submit" id="submit" class="btn btn-primary">Submit</button>
</form></p>
    
  </div>
</div>
		</div>
</div>
<script type="text/javascript">
	function myfun(cost){
		var quan=document.getElementById('quan').value;
		if(quan){
			var total= cost*quan;
		}
		else
			total=0;
		document.getElementById('total').setAttribute("value",total);
	}
	function myfun2(quan){
		var cost=document.getElementById('cost').value;
		if(cost){
			var total= cost*quan;
		}
		else
			total=0;
		document.getElementById('total').setAttribute("value",total);
	}
	function myfun4(cost2){
		var quan2=document.getElementById('quan2').value;
		if(quan2){
			var total2= cost2*quan2;
		}
		else
			total2=0;
		document.getElementById('total2').setAttribute("value",total2);
	}
	function myfun3(quan2){
 var avail=parseInt(document.getElementById('avail').innerText);
    if(quan2>avail)
    {
       document.getElementById('errors').innerHTML="*LIMIT CROSSED*";
       document.getElementById('submit').disabled=true;

    }
    else{
		var cost2=document.getElementById('cost2').value;
    document.getElementById('errors').innerHTML="";
document.getElementById('submit').disabled=false;

		if(cost2){
			var total2= cost2*quan2;
		}
		else
			total2=0;
		document.getElementById('total2').setAttribute("value",total2);
	}}
</script>
</body>
</html>