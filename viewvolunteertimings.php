<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM volunteer_timings WHERE volunteer_timings_id='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('volunteertimings record deleted successfully..');</script>";
	}
}
?>
<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">View  Volunteer Timings</h2>

  </div>

<div class="card">

  <section class="container">
    <table class="table table-bordered table-striped table-hover js-exportable dataTable" >
      <thead>
        <tr>
          <td>Volunteer</td>
          <td>Timings available</td>
          <td>Status</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        
          <?php
		$sql ="SELECT * FROM volunteer_timings where volunteerid='$_SESSION[volunteerid]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlvolunteer = "SELECT * FROM volunteer WHERE volunteerid='$rs[volunteerid]'";
			$qsqlvolunteer = mysqli_query($con,$sqlvolunteer);
			$rsvolunteer = mysqli_fetch_array($qsqlvolunteer);
			
			$sqlvol = "SELECT * FROM volunteer_timings WHERE volunteer_timings_id='$rs[volunteer_timings_id]'";
			$qsqlvol = mysqli_query($con,$sqlvol);
			$rsvol = mysqli_fetch_array($qsqlvol);
			
        echo "<tr>
          <td>&nbsp;$rsvolunteer[volunteername]</td>
          <td>&nbsp;$rsvol[start_time] - $rsvol[end_time]</td>
          <td>&nbsp;$rs[status]</td>
          <td width='250'>&nbsp;<a href='volunteertimings.php?editid=$rs[volunteer_timings_id]' class='btn btn-raised btn-sm g-bg-cyan'>Edit</a>  <a href='viewvolunteertimings.php?delid=$rs[volunteer_timings_id]' class='btn btn-raised btn-sm g-bg-blush2'>Delete</a> </td>
        </tr>";
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