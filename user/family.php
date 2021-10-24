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
                <h4 class="card-title">Family Members</h4>
                <div class="col-sm-12 d-flex">
                    <a href="member_add.php" class="btn btn-success text-white">Add Family Member</a>
                </div>
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
                                    echo "<td>" . $row['member_dob'] . "</td>";
                                    echo "<td>" . $row['member_proof_type'] . "</td>";
                                    echo "<td><img src='../images/" . $row['member_proof_photo'] . "' height=250px></td></tr>";
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