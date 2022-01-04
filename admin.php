<?php
session_start();
include('config.php');
if (isset($_POST['admin_login'])) {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];
    $sql = "SELECT * FROM tbl_admin WHERE admin_username='$admin_username' AND admin_password='$admin_password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("location: admin/index.php");
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['admin_username'] = $row['admin_username'];
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
                    <h3 class="card-title">Login as Admin</h3>
                    <form method="POST" action="<?php $_PHP_SELF ?>" class="form-horizontal form-material mx-2">
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Username</label>
                            <div class="col-md-12">
                                <input required name="admin_username" value="Admin" type="text" placeholder="Enter your username" class="form-control ps-0 form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Password</label>
                            <div class="col-md-12">
                                <input required name="admin_password" value="2bB@2bB@" type="password" placeholder="Enter your password" class="form-control ps-0 form-control-line" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 d-flex">
                                <button name="admin_login" type="submit" class="btn btn-success mx-auto mx-md-0 text-white">Login</button>
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