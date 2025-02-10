<?php
session_start();
include("dbconnection.php");
?>

<table class="table table-bordered table-striped">
    <tr>
        <td><strong> Date & Time</strong></td>
        <td><strong>Volunteer</strong></td>
        <td><strong>PanchayatRaj</strong></td>
        <td><strong> Description</strong></td>
    </tr>
    <?php
    $sql = "SELECT * FROM action_records WHERE userid='{$_GET['userid']}' AND problemid='{$_GET['problemid']}'";
    $qsql = mysqli_query($con, $sql);
    
    while ($rs = mysqli_fetch_array($qsql)) {
        $sqlvol = "SELECT * FROM volunteer WHERE volunteerid='{$rs['volunteerid']}'";
        $qsqlvol = mysqli_query($con, $sqlvol);
        $rsvol = mysqli_fetch_array($qsqlvol);

        $sqlpan = "SELECT * FROM panchayatraj WHERE panchayatrajid='{$rs['panchayatrajid']}'";
        $qsqlpan = mysqli_query($con, $sqlpan);
        $rspan = mysqli_fetch_array($qsqlpan);

        echo "<tr>
                <td>" . date("d-m-Y", strtotime($rs['date'])) . " " . date("h:i A", strtotime($rs['time'])) . "</td>
                <td>{$rsvol['volunteername']}</td>
                <td>{$rspan['panchayatrajname']}</td>
                <td>{$rs['description']}</td>
              </tr>";
    }
    ?>
</table>

<?php
if (isset($_SESSION['volunteerid']) && isset($_SESSION['panchayatrajid'])) {
?>
<hr>
<table>
    <tr>
        <td>
            <div align="center">
                <strong>
                    <a href="actionrecord.php?userid=<?php echo $_GET['userid']; ?>&proid=<?php echo $_GET['problemid']; ?>">
                        Add Action Records
                    </a>
                </strong>
            </div>
        </td>
    </tr>
</table>
<?php
}
?>

<script type="application/javascript">
function validateform() {
    if (document.frmactdetail.select.value === "") {
        alert("Action name should not be empty.");
        document.frmactdetail.select.focus();
        return false;
    } else if (document.frmactdetail.select2.value === "") {
        alert("Volunteer name should not be empty.");
        document.frmactdetail.select2.focus();
        return false;
    } else if (document.frmactdetail.select2.value === "") {
        alert("PanchayatRaj name should not be empty.");
        document.frmactdetail.select2.focus();
        return false;
    } else if (document.frmactdetail.textarea.value === "") {
        alert("Description should not be empty.");
        document.frmactdetail.textarea.focus();
        return false;
    } else if (document.frmactdetail.date.value === "") {
        alert("Date should not be empty.");
        document.frmactdetail.date.focus();
        return false;
    } else if (document.frmactdetail.time.value === "") {
        alert("Time should not be empty.");
        document.frmactdetail.time.focus();
        return false;
    } else {
        return true;
    }
}
</script>
