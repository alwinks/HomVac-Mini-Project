<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../user_login.php");
}
include("header.php");
?>
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Account</h3>
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
                    <h3 class="card-title">Account Details</h3>
                    <form class="form-horizontal form-material mx-2">
                        <?php
                        include('../config.php');
                        $user_id = $_SESSION['user_id'];
                        $sql = "SELECT * FROM tbl_user INNER JOIN tbl_place ON tbl_user.place_id=tbl_place.place_id WHERE user_id='$user_id'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result)
                        ?>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Name</label>
                            <div class="col-md-12">
                                <input readonly value="<?php echo $row['user_name']; ?>" class="form-control ps-0 form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">House Name</label>
                            <div class="col-md-12">
                                <input readonly value="<?php echo $row['user_house']; ?>" class="form-control ps-0 form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Nearest Landmark</label>
                            <div class="col-md-12">
                                <input readonly value="<?php echo $row['user_landmark']; ?>" class="form-control ps-0 form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Place</label>
                            <div class="col-md-12">
                                <input readonly value="<?php echo $row['place_name']; ?>" class="form-control ps-0 form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 mb-0">Mobile Number</label>
                            <div class="col-md-12">
                                <input readonly value="<?php echo $row['user_mobile']; ?>" class="form-control ps-0 form-control-line">
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