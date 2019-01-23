<?php
session_start();
include "usernav.php";
$catid=$_GET['cat'];
$subname= $_GET['subcat'];
$user=$_SESSION["user"];
$sql1="SELECT name FROM category WHERE catid='$catid'";
$result1=mysqli_query($conn,$sql1);
$sql2="SELECT * FROM stockin WHERE catid='$catid' AND subcat='$subname' AND user='$user'";
$result2=mysqli_query($conn,$sql2);
$sql3="SELECT name FROM subcategory WHERE catid='$catid' AND user='$user'";
$result3=mysqli_query($conn,$sql3);
 
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
      
        <div class="row">
        <div class="col-sm-6"> 
     <h1 style="font-family:Century">Stock In Transactions</h1>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control-sm " id="myInput" type="search" placeholder="Search in this table" aria-label="Search">
      
    </form>
</div><div class="col-sm-6">
  <a href="transout.php?cat=<?php echo $catid ?> &subcat=<?php echo $subname ?>"><button type="button" class="btn btn-success" style="float: right;" title="click to view stock out">Stock Out</button></a><br><br>
  <a href=""><button type="button" class="btn btn-success" onclick="down()" style="float: right;" title="click to view stock out">Download PDF</button></a>
</div> 
      <table id="table" class="table table-hover border mt-3" >
        <thead>
   <tr>
      <th scope="col">Catid</th>
      <th scope="col">Category</th>
      <th scope="col">Subcategory</th>
      <th scope="col">Quantity</th>
      <th scope="col">Unitcost</th>
      <th scope="col">Totalcost</th>
      <th scope="col">Supplier</th>
      <th scope="col">Date</th>
    </tr>
    </thead>
    <tbody id="myTable""><tr>
    <?php
      if(mysqli_num_rows($result2)==0)
        { if (mysqli_num_rows($result1)>0){
          while ($row1=mysqli_fetch_array($result1)) 
          { while( $row3=mysqli_fetch_array($result3)){
           $sql4="SELECT * FROM stockin WHERE catid='$catid' AND user='$user' AND subcat='$row3[0]'";
          
$result4=mysqli_query($conn,$sql4);
 while($row4=mysqli_fetch_row($result4)){;
        ?>
        <td><?php echo $catid;?></td>
        <td><?php echo $row1[0];?></td>
        <td><?php echo $row3[0];?></td>
         <td><?php if($row4[2]==0){echo "";} else echo $row4[3]/$row4[2];?></td>
        <td><?php echo $row4[2];?></td>
        <td><?php echo $row4[3];?></td>
        <td><?php echo $row4[4];?></td>
        <td><?php echo $row4[5];?></td>
    </tr>
    <?php
  }
}
}}
} else{  if(mysqli_num_rows($result2)>0){
         if(mysqli_num_rows($result1)>0)
         {
          while($row1=mysqli_fetch_array($result1))
          {       
            while($row2=mysqli_fetch_row($result2))
            {
           
           ?>
        <td><?php echo $catid;?></td>
        <td><?php echo $row1[0];?></td>
        <td><?php echo $subname;?></td>
        <td><?php if($row2[2]==0){echo "";} else {echo $row2[3]/$row2[2];}?></td>
        <td><?php echo $row2[2];?></td>
        <td><?php echo $row2[3];?></td>
        <td><?php echo $row2[4];?></td>
        <td><?php echo $row2[5];?></td>
        
    </tr>
    <?php
}
}
}
}
}
?>
</tr>
</tbody>
</table>
</div>
<script language="javascript" type="text/javascript">
        function down() 
  {
            window.print();
        }
    </script>
  </body>
  </html>