<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../index.php");
}
include('../config.php');
if (isset($_POST['search_vaccinator'])) {
    $_SESSION['vaccination_date'] = $_POST['vaccination_date'];
    $_SESSION['vaccination_time'] = $_POST['vaccination_time'];
    header("Location: vaccination_book.php");
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
                <h6 class="card-subtitle">Vaccination should be booked at least 24 hours in advance.</h6>
                <form class="form-horizontal form-material mx-2" method="POST" action="<?php $_PHP_SELF ?>">
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
                        <div class="col-sm-12 d-flex">
                            <button name="search_vaccinator" class="btn btn-success mx-auto mx-md-0 text-white">Search Vaccinators</button>
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