<?php
include "navbar.php";


$sql="SELECT Id,username FROM users WHERE NOT username='admin'";
$result=mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html>
<head>


	<title></title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
});
</script>
</head>
<body>
	<div class="container mt-5">

<div class="row">
  <div class="col-sm-6">
<form class="form-inline my-2 my-lg-0" action="javascript:void(0);">
      <input class="form-control " id="myInput" type="search" placeholder="Search in this table" aria-label="Search">
      
    </form><br></div>
    <div class="col-sm-6">
    <button type="button" onclick="down()" class="btn btn-success ml-1" style="" title="click to view stock out">download pdf</button>
</div></div>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      
     
    </tr>
  </thead>
  <tbody id="mytable">
     <?php
    	
    if(mysqli_num_rows($result)>0){
    while ($row = mysqli_fetch_row($result))
    {?>
    <tr>
    	
      <th scope="row"><?php echo $row[0]?></th>
      <td><?php echo $row[1]?></td>
      
      

    </tr>
  <?php }
}  ?>
  </tbody>
</table>
</div>
</body>
</html>