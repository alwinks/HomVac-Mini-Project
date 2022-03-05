<?php
session_start();
if (!$_SESSION['vaccinator_id']) {
    header("Location: ../vaccinator_login.php");
}
include("header.php");
?>
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Vaccinations</h3>
        </div>
    </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->
<!-- Container fluid  -->
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Previous Vaccinations</h4>
                <div class="table-responsive">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th class="border-top-0">Date</th>
                                <th class="border-top-0">Time</th>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Age Group</th>
                                <th class="border-top-0">Vaccine</th>
                                <th class="border-top-0">DOB</th>
                                <th class="border-top-0">Proof</th>
                                <th class="border-top-0">Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('../config.php');
                            $vaccinator_id = $_SESSION['vaccinator_id'];
                            $sql = "SELECT * FROM tbl_vaccination INNER JOIN tbl_member ON tbl_vaccination.member_id=tbl_member.member_id INNER JOIN tbl_vaccine ON tbl_vaccination.vaccine_id=tbl_vaccine.vaccine_id INNER JOIN tbl_user ON tbl_vaccination.user_id=tbl_user.user_id INNER JOIN tbl_place ON tbl_vaccination.place_id=tbl_place.place_id WHERE vaccinator_id='$vaccinator_id' AND vaccination_status='Vaccinated'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<td>" . date("d-m-Y", strtotime($row['vaccinated_date'])) . "</td>";
                                    echo "<td>" . date("h:i A", strtotime($row['vaccinated_time'])) . "</td>";
                                    echo "<td>" . $row['member_name'] . "</td>";
                                    echo "<td>" . $row['vaccine_age'] . "</td>";
                                    echo "<td>" . $row['vaccine_name'] . "</td>";
                                    echo "<td>" . date("d-m-Y", strtotime($row['member_dob'])) . "</td>";
                                    echo "<td><img src='../assets/images/" . $row['member_proof_photo'] . "' height=250px></td>";
                                    echo "<td>" . $row['user_name'] . "<br>" . $row['user_house'] . "<br>" . $row['user_landmark'] . "<br>" . $row['place_name'] . "</td></tr>";
                                }
                            } else {
                                echo "No previous vaccinations yet..";
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Container fluid  -->
<?php
include("footer.php");
?>