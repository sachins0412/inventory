<?php include 'navbar.php';
$sql="SELECT * FROM category";
$result=mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html>
<head>
	<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
  $("#myInput").focus(function(){
    $(this).css("background-color", "#cccccc");
  });
  $("#myInput").blur(function(){
    $(this).css("background-color", "#ffffff");
  });
});</script>
	<title></title>
</head>
<body>
	<div class="container mt-5 ">
	<form class="form-inline my-2 my-lg-0">
      <input class="form-control-sm " id="myInput" type="search" placeholder="Search in this table" aria-label="Search">
      
    </form><br>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">catid</th>
      <th scope="col"> Name</th>
      <th scope="col" style="padding-left: 40px;">Subcat</th>
    </tr>
  </thead>
  <tbody id="myTable">
  	<?php
    if(mysqli_num_rows($result)>0){
    	while($row=mysqli_fetch_row($result)){
    		$sql2= "SELECT name FROM subcategory WHERE catid='$row[0]' and user='admin'";
    		$result2=mysqli_query($conn,$sql2);
    	?>
    <tr>	
    	
      <th scope="row"><?php echo $row[0];?></th>
      <td><?php echo $row[1];?></td>
      <td>
      	<ul><?php 
      	if(mysqli_num_rows($result2)>0){
      		while($row1=mysqli_fetch_row($result2)){?>
      		<li><?php echo $row1[0];?></li>
      		<?php		
      		}
      	}
      	 ?>
      </ul></td>

    </tr>
<?php
}
    } 
    ?>
  </tbody>
</table>
</div>
</body>
</html>