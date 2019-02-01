<?php include 'navbar.php';
$sql="SELECT Id,username FROM users WHERE  NOT username='admin'";
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
		<div class="row">
      <div class="col-sm-6">
	<form class="form-inline my-2 my-lg-0" action="javascript:void(0);">
      <input class="form-control " id="myInput" type="search" placeholder="Search in this table" aria-label="Search">
      
    </form><br>
</div>
<div class="col-sm-6">
	<a href=""><button type="button" class="btn btn-success ml-1" onclick="down()" title="click to view stock out">Download PDF</button></a>
	</div>
</div>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Userid</th>
      <th scope="col"> Name</th>
      
    </tr>
  </thead>
  <tbody id="myTable">
  	<?php
    if(mysqli_num_rows($result)>0){
    	while($row=mysqli_fetch_row($result)){
    	?>
    <tr>	
    	
      <th scope="row"><?php echo $row[0];?></th>
      <td><?php echo $row[1];?></td>
      </tr>
<?php
    }
    } 
    ?>
  </tbody>
</table>
</div>
</body>
<script type="text/javascript">
   function down()
  {
    window.print();
  }
</script>
</html>