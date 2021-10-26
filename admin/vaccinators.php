<?php
session_start();
if (!$_SESSION['admin_id']) {
    header("Location: ../admin.php");
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
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('../config.php');
                            $sql = "SELECT * FROM tbl_vaccinator WHERE vaccinator_status='Non-verified'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['vaccinator_name'] . "</td>";
                                    echo "<td>";
                                    echo "<a href='vaccinator_update.php?vaccinator_id=" . $row['vaccinator_id'] . "'>Update as Verified Vaccinator</a>&emsp;";
                                    echo "</td></tr>";
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('../config.php');
                            $sql = "SELECT * FROM tbl_vaccinator WHERE vaccinator_status='Verified'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['vaccinator_name'] . "</td></tr>";
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