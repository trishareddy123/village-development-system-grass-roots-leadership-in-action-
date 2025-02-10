<?php
include("adheader.php");
include("dbconnection.php");
if(!isset($_SESSION['userid']))
{
	echo "<script>window.location='userlogin.php';</script>";
}

$sqluser = "SELECT * FROM user WHERE userid='$_SESSION[userid]' ";
$qsqluser = mysqli_query($con,$sqluser);
$rsuser = mysqli_fetch_array($qsqluser);

$sqluserproblem = "SELECT * FROM problem WHERE userid='$_SESSION[userid]' order by problemid DESC limit 1";
$qsqluserproblem = mysqli_query($con,$sqluserproblem);
$rsuserproblem = mysqli_fetch_array($qsqluserproblem);
?>
<div class=" container-fluid">
    <div class="block-header">
        <h2>Dashboard</h2>
    </div>




    <div class="card">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <div class="alert bg-teal">
                            <h3>Welcome , <?php echo $rsuser['username']; ?>! </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home_animation_1"
                            aria-expanded="true">Registration History</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile_animation_1"
                            aria-expanded="false">Problem</a></li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content" style="padding: 10px">
                    <div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1"
                        aria-expanded="true"> <b>Registration History</b>
                        <h3>You are with us from <?php echo $rsuser['admissiondate']; ?>
                            <?php echo $rsuser['admissiontime']; ?></h3>
                    </div>
                    <div role="tabpanel" class="tab-pane animated flipInX" id="profile_animation_1"
                        aria-expanded="false"> <b>Problem</b>
                        <?php
                        if(mysqli_num_rows($qsqluserproblem) == 0)
                        {
                            ?>
                        <h3>Problem records not found.. </h3>
                        <?php
                        }
                        else
                        {
                            ?>
                        <h3>Last Problem taken on - <?php echo $rsuserproblem['problemdate']; ?>
                            <?php echo $rsuserproblem['problemtime']; ?> </h3>
                        <?php
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>

<?php
include("adfooter.php");
?>