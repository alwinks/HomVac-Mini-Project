<?php
session_start();
include('config.php');
if (isset($_POST['vaccinator_login'])) {
    $vaccinator_mobile = $_POST['vaccinator_mobile'];
    $vaccinator_password = $_POST['vaccinator_password'];
    $sql = "SELECT vaccinator_id,vaccinator_name FROM tbl_vaccinator WHERE vaccinator_mobile='$vaccinator_mobile' AND vaccinator_password='$vaccinator_password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("Logged in successfully!");</script>';
        header("location: vaccinator/index.php");
        $row = mysqli_fetch_assoc($result);
        $_SESSION['vaccinator_id'] = $row['vaccinator_id'];
        $_SESSION['vaccinator_name'] = $row['vaccinator_name'];
    } else {
        echo '<script>alert("Incorrect username or password!");</script>';
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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Login as Vaccinator</h3>
                    <p>Don't have an account? <a href="vaccinator_register.php">Register here</a>.</p>
                    <form method="POST" action="<?php $_PHP_SELF ?>" class="form-horizontal form-material mx-2">
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Mobile Number</label>
                            <div class="col-md-12">
                                <input required name="vaccinator_mobile" type="number" maxlength="10" value="8765432109" placeholder="Enter your mobile number" class="form-control ps-0 form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Password</label>
                            <div class="col-md-12">
                                <input required name="vaccinator_password" type="password" value="4dD$4dD$" placeholder="Enter your password" class="form-control ps-0 form-control-line" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 d-flex">
                                <button name="vaccinator_login" type="submit" class="btn btn-success mx-auto mx-md-0 text-white">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Container fluid  -->
<?php
include("footer.php");
?>