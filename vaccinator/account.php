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
            <h3 class="page-title mb-0 p-0">Account</h3>
        </div>
    </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->
<!-- Container fluid  -->
<div class="container-fluid">
</div>
<!-- End Container fluid  -->
<?php
include("footer.php");
?>