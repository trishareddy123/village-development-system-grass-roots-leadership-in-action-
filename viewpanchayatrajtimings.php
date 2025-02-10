<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM Village_Development_Department WHERE Village_Development_Department_id='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Village Development Department record deleted successfully..');</script>";
	}
}
?>
<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">View Village Development Department</h2>

  </div>

<div class="card">

  <section class="container">
    <table class="table table-bordered table-striped table-hover js-exportable dataTable" >
      <thead>
        <tr>
          <td>Panchayat Raj</td>
          <td>Timings available</td>
          <td>Status</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        
          <?php
		$sql ="SELECT * FROM Village_Development_Department where panchayatrajid='$_SESSION[panchayatrajid]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpanchayatraj  = "SELECT * FROM panchayatraj  WHERE panchayatrajid='$rs[panchayatrajid]'";
			$qsqlpanchayatraj  = mysqli_query($con,$sqlpanchayatraj );
			$rspanchayatraj  = mysqli_fetch_array($qsqlpanchayatraj );
			
			$sqlpan = "SELECT * FROM Village_Development_Department WHERE Village_Development_Department_id='$rs[Village_Development_Department_id]'";
			$qsqlpan = mysqli_query($con,$sqlpan);
			$rspan = mysqli_fetch_array($qsqlpan);
			
        echo "<tr>
          <td>&nbsp;$rspanchayatraj [panchayatrajname]</td>
          <td>&nbsp;$rspan[start_time] - $rsvol[end_time]</td>
          <td>&nbsp;$rs[status]</td>
          <td width='250'>&nbsp;<a href='VillageDevelopmentDepartment.php?editid=$rs[Village_Development_Department_id]' class='btn btn-raised btn-sm g-bg-cyan'>Edit</a>  <a href='viewVillageDevelopmentDepartment.php?delid=$rs[Village_Development_Department_id]' class='btn btn-raised btn-sm g-bg-blush2'>Delete</a> </td>
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