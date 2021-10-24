<?php
session_start();
if (!$_SESSION['admin_id']) {
  header("Location: ../admin.php");
}
include('../config.php');
if (isset($_POST['vaccine_add'])) {
  $vaccine_age = $_POST['vaccine_age'];
  $vaccine_name = $_POST['vaccine_name'];
  $sql = "INSERT INTO tbl_vaccine (vaccine_age,vaccine_name,vaccine_status) VALUES ('$vaccine_age','$vaccine_name','Active')";
  if (mysqli_query($conn, $sql)) {
    header("Location: vaccines.php");
    echo "<script>alert('Vaccine added successfully!');</script>";
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
      <h3 class="page-title mb-0 p-0">Vaccines</h3>
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
          <h3 class="card-title">Add Vaccine</h3>
          <form class="form-horizontal form-material mx-2" method="POST" action="<?php $_PHP_SELF ?>">
            <div class="form-group">
              <label class="col-md-12 mb-0">Vaccine Age</label>
              <div class="col-md-12">
                <input required name="vaccine_age" type="text" placeholder="Enter new vaccine age" class="form-control ps-0 form-control-line">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">Vaccine Name</label>
              <div class="col-md-12">
                <input required name="vaccine_name" type="text" placeholder="Enter new vaccine name" class="form-control ps-0 form-control-line">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12 d-flex">
                <button name="vaccine_add" class="btn btn-success mx-auto mx-md-0 text-white" type="submit">Add Vaccine</button>
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