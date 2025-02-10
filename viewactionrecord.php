<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM action_records WHERE problemid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('problem record deleted successfully..');</script>";
	}
}
?>

<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">View new action records</h2>

  </div>

  <div class="card">

    <section class="container">
     <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
     	<thead>
     		 <tr>
            
            <td width="52"	scope="col">User</td>
            <td width="78"	scope="col">Volunteer</td>
			<td width="78"	scope="col">PanchayatRaj</td>
            <td width="82"	scope="col"> Description</td>
            <td width="43"	scope="col"> date</td>
            <td width="43"	scope="col"> time</td>
     
          </tr>
     	</thead>
        <tbody>
         
          <?php
		$sql ="SELECT * FROM action_records where status='Active'";
		if(isset($_SESSION['userid']))
		{
			$sql = $sql . " AND userid='$_SESSION[userid]'"; 
		}
		if(isset($_SESSION['volunteerid']))
		{
			$sql = $sql . " AND volunteerid='$_SESSION[volunteerid]'";
		}
		if(isset($_SESSION['panchayatrajid']))
		{
			$sql = $sql . " AND panchayatrajid='$_SESSION[panchayatrajid]'";
		}
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlusr = "SELECT * FROM user WHERE userid='$rs[userid]'";
			$qsqlusr = mysqli_query($con,$sqlusr);
			$rsusr = mysqli_fetch_array($qsqlusr);
			
			$sqlvol= "SELECT * FROM volunteer WHERE volunteerid='$rs[volunteerid]'";
			$qsqlvol = mysqli_query($con,$sqlvol);
			$rsvol = mysqli_fetch_array($qsqlvol);

			$sqlpan= "SELECT * FROM panchayatraj WHERE panchayatrajid='$rs[panchayatrajid]'";
			$qsqlpan = mysqli_query($con,$sqlpan);
			$rspan = mysqli_fetch_array($qsqlpan);
			
			
			
        echo "<tr>
          
		   <td>&nbsp;$rsusr[username]</td>
		    <td>&nbsp;$rsvol[volunteername]</td>
			<td>&nbsp;$rspan[panchayatrajname]</td>
			<td>&nbsp;$rs[description]</td>
			 <td>&nbsp;$rs[date]</td>
			  <td>&nbsp;$rs[time]</td>";  
	
       echo " </tr>";
		}
		?>
        </tbody>
      </table>
</section>
</div>
</div>
<?php
include("adformfooter.php");
?>