<?php

include("adheader.php");
include('dbconnection.php');

if(!isset($_SESSION['volunteerid']))
{
	echo "<script>window.location='volunteerlogin.php';</script>";
}

?>
<div class="container-fluid">
  <div class="block-header">
    <h2>Welcome <?php  $sql="SELECT * FROM `volunteer` WHERE volunteerid='$_SESSION[volunteerid]' ";
    $volunteertable = mysqli_query($con,$sql);
    $vol = mysqli_fetch_array($volunteertable);

    echo 'Mr. '. $vol['volunteername']; ?>

  </h2>
</div>
</div>





<div class="card">
  <section class="container">
    <div class="row clearfix" style="margin-top: 10px">
      <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="info-box-4 hover-zoom-effect">
          <div class="icon"> <i class="zmdi zmdi-file-plus col-blue"></i> </div>
          <div class="content">
            <div class="text">New Problem</div>
            <div class="number"><?php
            $sql = "SELECT * FROM problem WHERE `volunteerid`= '$_SESSION[volunteerid]' AND date=' ".date("Y-m-d")."'";
            $qsql = mysqli_query($con,$sql);
            echo mysqli_num_rows($qsql);
            ?></div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="info-box-4 hover-zoom-effect">
          <div class="icon"> <i class="zmdi zmdi-account col-cyan"></i> </div>
          <div class="content">
            <div class="text">Number of User</div>
            <div class="number"><?php
            $sql = "SELECT * FROM user WHERE status='Active'";
            $qsql = mysqli_query($con,$sql);
            echo mysqli_num_rows($qsql);
            ?></div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="info-box-4 hover-zoom-effect">
          <div class="icon"> <i class="zmdi zmdi-account-circle col-blush"></i> </div>
          <div class="content">
            <div class="text">Today's Problem</div>
            <div class="number">
              <?php
              $sql = "SELECT * FROM problem WHERE status='Approved' AND `volunteerid`= '$_SESSION[volunteerid]' AND date=' ".date("Y-m-d")."'" ;
            $qsql = mysqli_query($con,$sql);
            echo mysqli_num_rows($qsql);
            ?>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>



<?php
include("adfooter.php");
?>