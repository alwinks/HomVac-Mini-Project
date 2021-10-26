<?php
session_start();
if (!$_SESSION['admin_id']) {
    header("Location: ../admin.php");
}
include('../config.php');
$vaccinator_id = $_GET['vaccinator_id'];
$sql = "UPDATE tbl_vaccinator SET vaccinator_status='Verified' WHERE vaccinator_id='$vaccinator_id'";
if (mysqli_query($conn, $sql)) {
    header("Location: vaccinators.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}