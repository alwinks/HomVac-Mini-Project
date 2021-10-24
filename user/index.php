<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../index.php");
}
include('../config.php');
if (isset($_POST['vaccination_book'])) {
    $user_id = $_SESSION['user_id'];
    $place_id = $_SESSION['place_id'];
    $member_id = $_POST['member_id'];
    $vaccine_id = $_POST['vaccine_id'];
    $vaccinator_id = $_POST['vaccinator_id'];
    $vaccination_date = $_POST['vaccination_date'];
    $vaccination_time = $_POST['vaccination_time'];
    $sql = "INSERT INTO tbl_vaccination (user_id,place_id,member_id,vaccine_id,vaccinator_id,vaccination_date,vaccination_time,vaccination_status) VALUES ('$user_id','$place_id','$member_id','$vaccine_id','$vaccinator_id','$vaccination_date','$vaccination_time','Pending')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        echo "<script>alert('Vaccination booked successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
include("header.php");
?>
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Home</h3>
        </div>
    </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->
<!-- Container fluid  -->
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Book Vaccination</h3>
                <form class="form-horizontal form-material mx-2" method="POST" action="<?php $_PHP_SELF ?>">
                    <div class="form-group">
                        <label class="col-sm-12">Family Member</label>
                        <div class="col-sm-12 border-bottom">
                            <select required name="member_id" class="form-select shadow-none ps-0 border-0 form-control-line">
                                <option disabled selected>Choose family member</option>
                                <?php
                                include('../config.php');
                                $user_id = $_SESSION['user_id'];
                                $sql = "SELECT member_id,member_name FROM tbl_member WHERE user_id='$user_id'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['member_id'] . "'>" . $row['member_name'] . "</option>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                mysqli_close($conn);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Vaccine</label>
                        <div class="col-sm-12 border-bottom">
                            <select required name="vaccine_id" class="form-select shadow-none ps-0 border-0 form-control-line">
                                <option disabled selected>Choose vaccine</option>
                                <?php
                                include('../config.php');
                                $sql = "SELECT vaccine_id,vaccine_age,vaccine_name FROM tbl_vaccine";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['vaccine_id'] . "'>" . $row['vaccine_age'] . " - " . $row['vaccine_name'] . "</option>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                mysqli_close($conn);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 mb-0">Vaccination Date</label>
                        <div class="col-md-12">
                            <input required name="vaccination_date" type="date" class="form-control ps-0 form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 mb-0">Vaccination Time</label>
                        <div class="col-md-12">
                            <select required name="vaccination_time" class="form-control ps-0 form-control-line">
                                <option disabled selected>Choose vaccination time</option>
                                <option value="09:30 AM - 10:30 AM">09:30 AM - 10:30 AM</option>
                                <option value="10:30 AM - 11:30 AM">10:30 AM - 11:30 AM</option>
                                <option value="11:30 AM - 12:30 PM">11:30 AM - 12:30 PM</option>
                                <option value="01:30 PM - 02:30 PM">01:30 PM - 02:30 PM</option>
                                <option value="02:30 PM - 03:30 PM">02:30 PM - 03:30 PM</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Vaccinator</label>
                        <div class="col-sm-12 border-bottom">
                            <select required name="vaccinator_id" class="form-select shadow-none ps-0 border-0 form-control-line">
                                <option disabled selected>Choose vaccinator</option>
                                <?php
                                include('../config.php');
                                $sql = "SELECT vaccinator_id,vaccinator_name FROM tbl_vaccinator";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['vaccinator_id'] . "'>" . $row['vaccinator_name'] . "</option>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                mysqli_close($conn);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 d-flex">
                            <button name="vaccination_book" class="btn btn-success mx-auto mx-md-0 text-white">Book Vaccination</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Container fluid  -->
<?php
include("footer.php");
?>