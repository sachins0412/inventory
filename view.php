<?php
session_start();
include "usernav.php";
$user=$_SESSION['user'];
$catid=$_GET['cat'];
$subname= $_GET['subcat'];
$sql1="SELECT name FROM category WHERE catid='$catid'";
$result1=mysqli_query($conn,$sql1);
$sql2="SELECT quantity FROM subcategory WHERE catid='$catid' AND name='$subname' AND user='$user'";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_row($result2);
$sql3="SELECT unitcost FROM stockin WHERE catid='$catid' AND subcat='$subname' AND user='$user'";
$result3=mysqli_query($conn,$sql3);
$row3=mysqli_fetch_row($result3);
$sql4="SELECT name,quantity FROM subcategory WHERE catid='$catid' AND user='$user'";
$result4=mysqli_query($conn,$sql4);

?>
<html>
<head>
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
	<title>
	</title>
	<body>
		<div class="container mt-5">
		<form class="form-inline my-2 my-lg-0">
      <input class="form-control-sm " id="myInput" type="search" placeholder="Search in this table" aria-label="Search">
      
    </form><br>
			<table class="table table-hover border">
   <tr>
      <th scope='col'>Catid</th>
      <th scope='col'>Category</th>
      <th scope='col'>Subcategory</th>
      <th scope='col'>qty in stock</th>


    </tr><tbody id="myTable""><tr>
    <?php
    	if(mysqli_num_rows($result2)==0){
    if(mysqli_num_rows($result1)>0){
    while ($row1 = mysqli_fetch_array($result1))
        { while($row4=mysqli_fetch_array($result4)){
      $sql5="SELECT unitcost FROM stockin WHERE catid='$catid' AND subcat='$row4[0]' AND user='$user'";
      $result5=mysqli_query($conn,$sql5);
      $row5=mysqli_fetch_row($result5);
        ?>
        <td id="catid"><?php echo $catid;?></td>
        <td><?php echo $row1[0];?></td>
        <td id="subcat"><?php echo $row4[0];?><button class="btn btn-outline" onclick="myfun()" style="padding-top: 1px;"><i class="fas fa-trash-alt" ></i></button></td>
        <td><?php echo $row4[1];?></td>
    </tr>
    <?php
  }
}
}
}
else{
   if(mysqli_num_rows($result2)>0){
    while ($row1 = mysqli_fetch_array($result1))
    {
        ?>
        <td id="catid"><?php echo $catid;?></td>
        <td><?php echo $row1[0];?></td>
        <td id="subcat"><?php echo $subname;?><button class="btn btn-outline" onclick="myfun()" style="padding-top: 1px;"><i class="fas fa-trash-alt" ></i></button></td>
        <td><?php echo $row2[0];?></td>
    </tr>
    <?php
}
}	
}
?>
</tr>
</tbody>
</table>
</div>
<script type="text/javascript">
  function myfun(){
  
if (confirm("Want to delete?")) {
  var subcat=document.getElementById("subcat").value ;
  var catid=document.getElementById("catid").value ;
  $.ajax({

      url: 'delete.php',
      type:'POST',
      data:{datapost : subcat, catid :},
      success: function(result){
          $('#myTable').html(result);
      }
      
    });
}
}
  
</script>
	</body>
	</html>