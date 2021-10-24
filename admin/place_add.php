<?php
session_start();
if (!$_SESSION['admin_id']) {
  header("Location: ../admin.php");
}
include('../config.php');
if (isset($_POST['place_add'])) {
  $place_name = $_POST['place_name'];
  $sql = "INSERT INTO tbl_place (place_name,place_status) VALUES ('$place_name','Active')";
  if (mysqli_query($conn, $sql)) {
    header("Location: places.php");
    echo "<script>alert('Product added successfully!');</script>";
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
      <h3 class="page-title mb-0 p-0">Places</h3>
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
          <h3 class="card-title">Add Place</h3>
          <form class="form-horizontal form-material mx-2" method="POST" action="<?php $_PHP_SELF ?>">
            <div class="form-group">
              <label class="col-md-12 mb-0">Place Name</label>
              <div class="col-md-12">
                <input required name="place_name" type="text" placeholder="Enter new place name" class="form-control ps-0 form-control-line">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12 d-flex">
                <button name="place_add" class="btn btn-success mx-auto mx-md-0 text-white" type="submit">Add Place</button>
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