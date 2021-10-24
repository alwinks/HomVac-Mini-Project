<?php
session_start();
if (!$_SESSION['user_id']) {
  header("Location: ../index.php");
}
include('../config.php');
if (isset($_POST['member_add'])) {
  $user_id = $_SESSION['user_id'];
  $member_name = $_POST['member_name'];
  $member_gender = $_POST['member_gender'];
  $member_dob = $_POST['member_dob'];
  $member_proof_type = $_POST['member_proof_type'];
  $member_proof_photo = $_POST['member_proof_photo'];
  $sql = "INSERT INTO tbl_member (user_id,member_name,member_gender,member_dob,member_proof_type,member_proof_photo,member_status) VALUES ('$user_id','$member_name','$member_gender','$member_dob','$member_proof_type','$member_proof_photo','Active')";
  if (mysqli_query($conn, $sql)) {
    header("Location: family.php");
    echo "<script>alert('Member added successfully!');</script>";
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
      <h3 class="page-title mb-0 p-0">My Family</h3>
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
          <h3 class="card-title">Add Family Member</h3>
          <form class="form-horizontal form-material mx-2" method="POST" action="<?php $_PHP_SELF ?>">
            <div class="form-group">
              <label class="col-md-12 mb-0">Name</label>
              <div class="col-md-12">
                <input required name="member_name" type="text" placeholder="Enter new member name" class="form-control ps-0 form-control-line">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">Gender</label>
              <div class="col-md-12">
                <input required name="member_gender" type="radio" value="Male">&nbsp;<label>Male</label>&emsp;
                <input required name="member_gender" type="radio" value="Female">&nbsp;<label>Female</label>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">Date of Birth</label>
              <div class="col-md-12">
                <input required name="member_dob" type="date" class="form-control ps-0 form-control-line">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">Proof Type</label>
              <div class="col-md-12">
                <select required name="member_proof_type" class="form-control ps-0 form-control-line">
                  <option disabled selected>Choose proof type</option>
                  <option value="Birth Certificate">Birth Certificate</option>
                  <option value="Aadhar Card">Aadhar Card</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">Proof Photo</label>
              <div class="col-md-12">
                <input required name="member_proof_photo" type="file">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12 d-flex">
                <button name="member_add" class="btn btn-success mx-auto mx-md-0 text-white" type="submit">Add Member</button>
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