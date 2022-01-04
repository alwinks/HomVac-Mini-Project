<?php
session_start();
include('config.php');
if (isset($_POST['user_login'])) {
    $user_mobile = $_POST['user_mobile'];
    $user_password = $_POST['user_password'];
    $sql = "SELECT * FROM tbl_user WHERE user_mobile='$user_mobile' AND user_password='$user_password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("location: user/index.php");
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['place_id'] = $row['place_id'];
        echo '<script>alert("Logged in successfully!");</script>';
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
                    <h3 class="card-title">Login as User</h3>
                    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
                    <form method="POST" action="<?php $_PHP_SELF ?>" class="form-horizontal form-material mx-2">
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Mobile Number</label>
                            <div class="col-md-12">
                                <input required name="user_mobile" type="number" value="9876543210" maxlength="10" placeholder="Enter your mobile number" class="form-control ps-0 form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Password</label>
                            <div class="col-md-12">
                                <input required name="user_password" value="1aA!1aA!" type="password" placeholder="Enter your password" class="form-control ps-0 form-control-line" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 d-flex">
                                <button name="user_login" type="submit" class="btn btn-success mx-auto mx-md-0 text-white">Login</button>
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