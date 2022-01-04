<?php
session_start();
if (!$_SESSION['vaccinator_id']) {
    header("Location: ../vaccinator_login.php");
}
include('../config.php');
$vaccination_id = $_GET['vaccination_id'];
$sql = "UPDATE tbl_vaccination SET vaccination_status='Vaccinated',vaccinated_date=CURRENT_DATE(),vaccinated_time=CURRENT_TIME() WHERE vaccination_id='$vaccination_id'";
if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
