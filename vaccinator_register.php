<?php
include('config.php');
if (isset($_POST['vaccinator_register'])) {
  $place_id = $_POST['place_id'];
  $vaccinator_name = $_POST['vaccinator_name'];
  $vaccinator_mobile = $_POST['vaccinator_mobile'];
  $vaccinator_password = $_POST['vaccinator_password'];
  $sql1 = "SELECT * FROM tbl_vaccinator WHERE vaccinator_mobile='$vaccinator_mobile'";
  $result1 = mysqli_query($conn, $sql1);
  if (mysqli_num_rows($result1) == 0) {
    $sql2 = "INSERT INTO tbl_vaccinator (place_id,vaccinator_name,vaccinator_mobile,vaccinator_password,vaccinator_status) VALUES ($place_id,'$vaccinator_name','$vaccinator_mobile','$vaccinator_password','Non-verified')";
    if (mysqli_query($conn, $sql2)) {
      header("location: vaccinator_login.php");
      echo "<script>alert('Registered successfully!');</script>";
    }
    else {
      echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    }
  }
  else
    echo "<script>alert('Mobile number already exists!');</script>";
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
          <h3 class="card-title">Register as Vaccinator</h3>
          <p>Already have an account? <a href="vaccinator_login.php">Login here</a>.</p>
          <form class="form-horizontal form-material mx-2" onsubmit="return validate()" name="vaccinator_register" method="POST" action="<?php $_PHP_SELF ?>">
            <div class="form-group">
              <label class="col-md-12 mb-0">Name</label>
              <div class="col-md-12">
                <input required name="vaccinator_name" type="text" placeholder="What's your name?" class="form-control ps-0 form-control-line">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-12">Place</label>
              <div class="col-sm-12 border-bottom">
                <select required name="place_id" class="form-select shadow-none ps-0 border-0 form-control-line">
                  <option disabled selected>Choose your place</option>
                  <?php
                  include('config.php');
                  $place_id = $_POST['place_id'];
                  $place_name = $_POST['place_name'];
                  $sql = "SELECT place_id,place_name FROM tbl_place";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='" . $row['place_id'] . "'>" . $row['place_name'] . "</option>";
                    }
                  }
                  mysqli_close($conn);
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">Mobile Number</label>
              <div class="col-md-12">
                <input required name="vaccinator_mobile" type="number" maxlength="10" placeholder="Enter your mobile number" class="form-control ps-0 form-control-line">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">New Password</label>
              <div class="col-md-12">
                <input required name="vaccinator_password" type="password" placeholder="Enter new password" class="form-control ps-0 form-control-line" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 mb-0">Confirm Password</label>
              <div class="col-md-12">
                <input required name="vaccinator_password_confirm" type="password" placeholder="Confirm new password" class="form-control ps-0 form-control-line" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12 d-flex">
                <button name="vaccinator_register" class="btn btn-success mx-auto mx-md-0 text-white" type="submit">Register</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Container fluid  -->
<script>
  function validate() {
    var password = document.vaccinator_register.user_password.value;
    var confirm = document.vaccinator_register.user_password_confirm.value;
    if (password != confirm) {
      alert("Passwords do not match!");
      return false;
    }
    return true;
  }
</script>
<?php
include("footer.php");
?>