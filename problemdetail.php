<?php
session_start();
include("dbconnection.php");

if (isset($_POST['submitapp'])) {
    $sql = "INSERT INTO problem (type, departmentid, date, time, volunteerid, panchayatrajid) 
            VALUES ('Online', '{$_POST['select3']}', '{$_POST['date']}', '{$_POST['time']}', '{$_POST['select5']}', '{$_POST['select5']}')";

    if ($qsql = mysqli_query($con, $sql)) {
        echo "<script>alert('Problem record inserted successfully...');</script>";
    } else {
        echo mysqli_error($con);
    }
}

if (isset($_GET['editid'])) {
    $sql = "SELECT * FROM problem WHERE problemid='{$_GET['editid']}'";
    $qsql = mysqli_query($con, $sql);
    $rsedit = mysqli_fetch_array($qsql);
}

$sqlproblem1 = "SELECT MAX(problemid) FROM problem WHERE userid='{$_GET['userid']}' AND (status='Active' OR status='Approved')";
$qsqlproblem1 = mysqli_query($con, $sqlproblem1);
$rsproblem1 = mysqli_fetch_array($qsqlproblem1);

$sqlproblem = "SELECT * FROM problem WHERE problemid='{$rsproblem1[0]}'";
$qsqlproblem = mysqli_query($con, $sqlproblem);
$rsproblem = mysqli_fetch_array($qsqlproblem);

if (mysqli_num_rows($qsqlproblem) == 0) {
    echo "<center><h2>No Problem records found..</h2></center>";
} else {
    // Ensure $rsproblem1[0] is correctly used
    $sqldepartment = "SELECT * FROM department WHERE departmentid='{$rsproblem['departmentid']}'";
    $qsqldepartment = mysqli_query($con, $sqldepartment);
    $rsdepartment = mysqli_fetch_array($qsqldepartment);

    $sqlvolunteer = "SELECT * FROM volunteer WHERE volunteerid='{$rsproblem['volunteerid']}'";
    $qsqlvolunteer = mysqli_query($con, $sqlvolunteer);
    $rsvolunteer = mysqli_fetch_array($qsqlvolunteer);

    $sqlpanchayatraj = "SELECT * FROM panchayatraj WHERE panchayatrajid='{$rsproblem['panchayatrajid']}'";
    $qsqlpanchayatraj = mysqli_query($con, $sqlpanchayatraj);
    $rspanchayatraj = mysqli_fetch_array($qsqlpanchayatraj);
    ?>
    <table class="table table-bordered table-striped">
        <tr>
            <td>Department</td>
            <td>&nbsp;<?php echo $rsdepartment['departmentname']; ?></td>
        </tr>
        <tr>
            <td>Volunteer</td>
            <td>&nbsp;<?php echo $rsvolunteer['volunteername']; ?></td>
        </tr>
        <tr>
            <td>PanchayatRaj</td>
            <td>&nbsp;<?php echo $rspanchayatraj['panchayatrajname']; ?></td>
        </tr>
        <tr>
            <td>Date</td>
            <td>&nbsp;<?php echo date("d-M-Y", strtotime($rsproblem['date'])); ?></td>
        </tr>
        <tr>
            <td>Time</td>
            <td>&nbsp;<?php echo date("h:i A", strtotime($rsproblem['time'])); ?></td>
        </tr>
    </table>
    <?php
}
?>

<script type="application/javascript">
function validateform() {
    if (document.frmprblmdetail.select.value === "") {
        alert("Type should not be empty.");
        document.frmprblmdetail.select.focus();
        return false;
    } else if (document.frmprblmdetail.select3.value === "") {
        alert("Department name should not be empty.");
        document.frmprblmdetail.select3.focus();
        return false;
    } else if (document.frmprblmdetail.date.value === "") {
        alert("Date should not be empty.");
        document.frmprblmdetail.date.focus();
        return false;
    } else if (document.frmprblmdetail.time.value === "") {
        alert("Time should not be empty.");
        document.frmprblmdetail.time.focus();
        return false;
    } else if (document.frmprblmdetail.select5.value === "") {
        alert("Volunteer name should not be empty.");
        document.frmprblmdetail.select5.focus();
        return false;
    } else if (document.frmprblmdetail.select5.value === "") {
        alert("PanchayatRaj name should not be empty.");
        document.frmprblmdetail.select5.focus();
        return false;    
    } else {
        return true;
    }
}
</script>
