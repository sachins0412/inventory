<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db="inventory";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$catid=$_POST['catid'];
$subcat=$_POST['subcat']; 
$from=$_POST['from_date'];  
$to=$_POST['to_date'];    
$user=$_SESSION["user"];
$sql1="SELECT name FROM category WHERE catid='$catid'";
$result1=mysqli_query($conn,$sql1);
$sql2="SELECT * FROM stockout WHERE catid='$catid' AND subcat='$subcat' AND user='$user' AND DATE(dt) BETWEEN '$from' AND '$to'";
$result2=mysqli_query($conn,$sql2);
$sql3="SELECT name FROM subcategory WHERE catid='$catid' AND user='$user'";
$result3=mysqli_query($conn,$sql3);
$sql4="SELECT * FROM category ";
$result4=mysqli_query($conn,$sql4);
 
?>
<tr>
    <?php
     if(mysqli_num_rows($result1)==0)
        { if (mysqli_num_rows($result2)==0){
          while ($row4=mysqli_fetch_array($result4)) 
          { $sql6="SELECT name FROM subcategory WHERE catid='$row4[0]' AND user='$user'";
$result6=mysqli_query($conn,$sql6);
            while( $row6=mysqli_fetch_array($result6)){
           $sql5="SELECT * FROM stockout WHERE catid='$row4[0]' AND user='$user' AND subcat='$row6[0]' AND DATE(dt) BETWEEN '$from' AND '$to'";
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
          {
          while( $row3=mysqli_fetch_array($result3)){
           $sql4="SELECT * FROM stockout WHERE catid='$catid' AND user='$user' AND subcat='$row3[0]' AND DATE(dt) BETWEEN '$from' AND '$to'";
          $result4=mysqli_query($conn,$sql4);
 while($row4=mysqli_fetch_row($result4)){
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
        <td id="catid"><?php echo $catid;?></td>
        <td><?php echo $row1[0];?></td>
        <td id="subcat"><?php echo $subcat;?></td>
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