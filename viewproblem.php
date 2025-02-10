<?php
include("adformheader.php");
include("dbconnection.php");

// Handle deletion of a problem record
if (isset($_GET['delid'])) {
    $sql = "DELETE FROM problem WHERE problemid='$_GET[delid]'";
    $qsql = mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
        echo "<script>alert('Problem record deleted successfully..');</script>";
    }
}

// Handle approval of a problem record
if (isset($_GET['approveid'])) {
    $sql = "UPDATE problem SET status='Approved' WHERE problemid='$_GET[approveid]'";
    $qsql = mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
        echo "<script>alert('Problem record approved successfully..');</script>";
    }
}
?>
<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">View Problem Records</h2>
    </div>

    <div class="card">
        <section class="container">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                    <tr>
                        <th>User Detail</th>
                        <th>Date & Time</th>
                        <th>Department</th>
                        <th>Volunteer</th>
                        <th>PanchayatRaj</th>
                        <th>Problem Reason</th>
                        <th>Status</th>
                        <th><div align="center">Action</div></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM problem WHERE status != ''";
                    if (isset($_SESSION['userid'])) {
                        $sql .= " AND userid='$_SESSION[userid]'";
                    }
                    $qsql = mysqli_query($con, $sql);
                    if (mysqli_num_rows($qsql) > 0) {
                        while ($rs = mysqli_fetch_array($qsql)) {
                            // Fetch user details
                            $sqlusr = "SELECT * FROM user WHERE userid='$rs[userid]'";
                            $qsqlusr = mysqli_query($con, $sqlusr);
                            $rsusr = mysqli_fetch_array($qsqlusr);

                            // Fetch department details
                            $sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]'";
                            $qsqldept = mysqli_query($con, $sqldept);
                            $rsdept = mysqli_fetch_array($qsqldept);

                            // Fetch volunteer details
                            $sqlvol = "SELECT * FROM volunteer WHERE volunteerid='$rs[volunteerid]'";
                            $qsqlvol = mysqli_query($con, $sqlvol);
                            $rsvol = mysqli_fetch_array($qsqlvol);

                            // Fetch PanchayatRaj details
                            $sqlpan = "SELECT * FROM panchayatraj WHERE panchayatrajid='$rs[panchayatrajid]'";
                            $qsqlpan = mysqli_query($con, $sqlpan);
                            $rspan = mysqli_fetch_array($qsqlpan);

                            echo "<tr>
                                <td>&nbsp;$rsusr[username]<br>&nbsp;$rsusr[mobileno]</td>
                                <td>&nbsp;" . date("d-M-Y", strtotime($rs['date'])) . " &nbsp; " . date("H:i A", strtotime($rs['time'])) . "</td>
                                <td>&nbsp;$rsdept[departmentname]</td>
                                <td>&nbsp;$rsvol[volunteername]</td>
                                <td>&nbsp;$rspan[panchayatrajname]</td>
                                <td>&nbsp;$rs[pro_reason]</td>
                                <td>&nbsp;$rs[status]</td>
                                <td><div align='center'>";
                            if ($rs['status'] != "Approved") {
                                if (!isset($_SESSION['userid'])) {
                                    echo "<a href='problemapproval.php?editid=$rs[problemid]'>Approve</a><hr>";
                                }
                                echo "<a href='viewproblem.php?delid=$rs[problemid]'>Delete</a>";
                            } else {
                                echo "<a href='userreport.php?userid=$rs[userid]&problemid=$rs[problemid]' class='btn btn-raised bg-green'>View Report</a>";
                            }
                            echo "</div></td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
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