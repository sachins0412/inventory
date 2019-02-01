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
$sql4="SELECT * FROM category ";
$result4=mysqli_query($conn,$sql4);
 
?>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
          
             <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
           <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
      
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
        <div class="col-xs-3 col-lg-3 col-md-12"> 
     <h1 style="font-family:Century">Stock In Transactions</h1>
     <form class="form-inline my-2 my-lg-0" action="javascript:void(0);">
      <div class="input-group form-group">
            
            <input class="form-control" id="myInput" type="search" placeholder="Search in this table" aria-label="Search">
     
            
          </div>
      
    </form>
   </div> <div class="col-xs-6 col-lg-6 col-md-12 form-inline">
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date">
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date">  
                
                
                     <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info"> 
                
</div><div class="col-xs-3 col-lg-3 col-md-12 form-inline" >
  <a href="transout.php?cat=<?php echo $catid ?> &subcat=<?php echo $subname ?>"><button type="button" class="btn btn-success" style="float: right;" title="click to view stock out">Stock Out</button></a>
<button type="button" onclick="down()" class="btn btn-success ml-1  " title="click to view stock out">download pdf</button>
</div>
    <br>
      <table class="table table-hover border mt-4" style="" >
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
     if(mysqli_num_rows($result1)==0)
        { if (mysqli_num_rows($result2)==0){
          while ($row4=mysqli_fetch_array($result4)) 
          { $sql6="SELECT name FROM subcategory WHERE catid='$row4[0]' AND user='$user'";
$result6=mysqli_query($conn,$sql6);
            while( $row6=mysqli_fetch_array($result6)){
           $sql5="SELECT * FROM stockin WHERE catid='$row4[0]' AND user='$user' AND subcat='$row6[0]'";
           $result5=mysqli_query($conn,$sql5);
          while ($row5=mysqli_fetch_row($result5)) {
            
          
 
        ?><div id="catid"></div><div id="subcat"></div>
        <td ><?php echo $row4[0];?></td>
        <td><?php echo $row4[1];?></td>
        <td><?php echo $row6[0];?></td>
         <td><?php if($row5[2]==0){echo "";} else echo $row5[3]/$row5[2];?></td>
        <td><?php echo $row5[2];?></td>
        <td><?php echo $row5[3];?></td>
        <td><?php echo $row5[4];?></td>
        <td><?php echo $row5[5];?></td>
    </tr>
    <?php
}
}}}
}
     else if(mysqli_num_rows($result2)==0)
        { if (mysqli_num_rows($result1)>0){
          while ($row1=mysqli_fetch_array($result1)) 
          { while( $row3=mysqli_fetch_array($result3)){
           $sql4="SELECT * FROM stockin WHERE catid='$catid' AND user='$user' AND subcat='$row3[0]'";
           $result4=mysqli_query($conn,$sql4);
          while ($row4=mysqli_fetch_row($result4)) {
            
          
 
        ?>
        <td id="catid"><?php echo $catid;?></td>
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
}}}
} else{  if(mysqli_num_rows($result2)>0){
         if(mysqli_num_rows($result1)>0)
         {
          while($row1=mysqli_fetch_array($result1))
          {       
            while($row2=mysqli_fetch_row($result2)){
           
           ?>
        <td id="catid"><?php echo $catid;?></td>
        <td ><?php echo $row1[0];?></td>
        <td id="subcat"><?php echo $subname;?></td>
        <td><?php if($row2[2]==0){echo "";} else echo $row2[3]/$row2[2];?></td>
        <td><?php echo $row2[2];?></td>
        <td><?php echo $row2[3];?></td>
        <td><?php echo $row2[4];?></td>
        <td><?php echo $row2[5];?></td>
        
    </tr>
    <?php
}}}}}
?>
</tr>
</tbody>
</table>
</div>
<script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {   
    var catid=document.getElementById("catid").innerText;
                  
                  if(subcat){
                      var subcat=document.getElementById("subcat").innerText;
                     $.ajax({  
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date,catid:catid, subcat:subcat},  
                          success:function(data)  
                          {  
                               $('#myTable').html(data);  
                          }  
                     });  
                }
                else
                {var subcat=null;
                 $.ajax({  
                  
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date,catid:catid, subcat:subcat},  
                          success:function(data)  
                          {  
                               $('#myTable').html(data);  
                          }  
                     }); 
                }
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      }); 
      function down() {
         window.print();
       } 
 </script>
  </body>
  </html>