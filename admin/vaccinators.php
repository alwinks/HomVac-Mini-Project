<?php
session_start();
if (!$_SESSION['admin_id']) {
    header("Location: ../admin_login.php");
}
include("header.php");
?>
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="page-title mb-0 p-0">Vaccinators</h3>
        </div>
    </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->
<!-- Container fluid  -->
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Non-verified Vaccinators</h4>
                <div class="table-responsive">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Place</th>
                                <th class="border-top-0">Mobile</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('../config.php');
                            $sql = "SELECT * FROM tbl_vaccinator INNER JOIN tbl_place ON tbl_vaccinator.place_id=tbl_place.place_id WHERE vaccinator_status='Non-verified'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['vaccinator_name'] . "</td>";
                                    echo "<td>" . $row['place_name'] . "</td>";
                                    echo "<td>" . $row['vaccinator_mobile'] . "</td>";
                                    echo "<td>"; ?>
                                    <a href="vaccinator_verify.php?vaccinator_id=<?php echo $row['vaccinator_id']; ?>" onclick="return confirm('Are you sure to verify <?php echo $row['vaccinator_name']; ?>?')">Verify</a>
                            <?php echo "</td></tr>";
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
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Verified Vaccinators</h4>
                <div class="table-responsive">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Place</th>
                                <th class="border-top-0">Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('../config.php');
                            $sql = "SELECT * FROM tbl_vaccinator INNER JOIN tbl_place ON tbl_vaccinator.place_id=tbl_place.place_id WHERE vaccinator_status='Verified'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['vaccinator_name'] . "</td>";
                                    echo "<td>" . $row['place_name'] . "</td>";
                                    echo "<td>" . $row['vaccinator_mobile'] . "</td></tr>";
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