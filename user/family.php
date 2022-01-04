<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../index.php");
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
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Family Members</h4>
                    <button class="ms-auto btn btn-sm btn-rounded btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                        Add Family Member
                    </button>
                </div>
                <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header d-flex">
                                <h4 class="modal-title">Add Family Member</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <?php
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
                                    echo "<script>alert('Family member added successfully!');</script>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                            }
                            ?>
                            <div class="modal-body">
                                <form method="POST" action="<?php $_PHP_SELF ?>">
                                    <div class="form-group">
                                        <label class="col-md-12 mb-0">Name</label>
                                        <div class="col-md-12">
                                            <input required name="member_name" type="text" placeholder="Enter new member name" class="form-control">
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
                                            <input required name="member_dob" type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 mb-0">Proof Type</label>
                                        <div class="col-md-12">
                                            <select required name="member_proof_type" class="form-control">
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button name="member_add" type="submit" class="btn btn-success">
                                            Add Family Member
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <div class="table-responsive">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Gender</th>
                                <th class="border-top-0">Date of Birth</th>
                                <th class="border-top-0">Proof Type</th>
                                <th class="border-top-0">Proof Photo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('../config.php');
                            $user_id = $_SESSION['user_id'];
                            $sql = "SELECT * FROM tbl_member WHERE user_id='$user_id'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['member_name'] . "</td>";
                                    echo "<td>" . $row['member_gender'] . "</td>";
                                    echo "<td>" . date("d-m-Y", strtotime($row['member_dob'])) . "</td>";
                                    echo "<td>" . $row['member_proof_type'] . "</td>";
                                    echo "<td><img src='../assets/images/" . $row['member_proof_photo'] . "' height=250px></td></tr>";
                                }
                            } else {
                                echo "0 results";
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Container fluid  -->
<?php
include("footer.php");
?>