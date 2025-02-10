
<?php
session_start();
include("dbconnection.php");
$sql ="select * from panchayatraj where departmentid='$_GET[deptid]'";
$qsql = mysqli_query($con,$sql);
echo "<select class='selectpicker' name='pan' id='pan'  >";
while($qsql1=mysqli_fetch_array($qsql))
{	
	echo "<option value=''>Select panchayatraj</option>";
	echo "<option value='$qsql1[panchayatrajid]'>$qsql1[panchayatrajname]</option>";		
}
echo "</select>"
?>	          
