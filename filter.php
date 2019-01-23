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
$from=$_POST['from_date'];	
$to=$_POST['to_date'];		
$user=$_SESSION["user"];
$sql1="SELECT name FROM category WHERE catid='$catid'";
$result1=mysqli_query($conn,$sql1);
$sql3="SELECT name FROM subcategory WHERE catid='$catid' AND user='$user'";
$result3=mysqli_query($conn,$sql3);
?><tr>
    <?php
      if (mysqli_num_rows($result1)>0){
          while ($row1=mysqli_fetch_array($result1)) 
          { while( $row3=mysqli_fetch_array($result3)){
           $sql2="SELECT * FROM stockin WHERE catid='$catid' AND  user='$user' AND DATE(dt) BETWEEN '$from' AND '$to'";
$result2=mysqli_query($conn,$sql2);
 while($row2=mysqli_fetch_row($result2)){;
        ?>
        <td id="catid"><?php echo $catid;?></td>
        <td><?php echo $row1[0];?></td>
        <td id="subcat"><?php echo $row3[0];?></td>
         <td><?php if($row2[2]==0){echo "";} else echo $row2[3]/$row2[2];?></td>
        <td><?php echo $row2[2];?></td>
        <td><?php echo $row2[3];?></td>
        <td><?php echo $row2[4];?></td>
        <td><?php echo $row2[5];?></td>
    </tr>
    <?php
  }

}}
}
?>
</tr>
?>