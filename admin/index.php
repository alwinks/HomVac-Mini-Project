<?php
session_start();
if (!$_SESSION['admin_id']) {
    header("Location: ../admin_login.php");
}
include("header.php");
?>
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="page-title mb-0 p-0">Home</h3>
        </div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <div class="d-flex mt-2 justify-content-end">
                <div class="d-flex me-3 ms-2">
                    <?php
                    include('../config.php');
                    $sql = "SELECT COUNT(CASE WHEN MONTH(vaccinated_date)=MONTH(CURRENT_DATE()) THEN 1 END) AS this_month,COUNT(CASE WHEN MONTH(vaccinated_date)=MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) THEN 1 END) AS last_month,COUNT(CASE WHEN vaccination_status='Vaccinated' THEN 1 END) AS vaccinated,COUNT(CASE WHEN vaccination_status='Pending' THEN 1 END) AS pending FROM tbl_vaccination";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="chart-text me-2">
                        <h6 class="mb-0"><small>THIS MONTH</small></h6>
                        <h4 class="mt-0 text-info"><?php echo $row['this_month']; ?></h4>
                    </div>
                </div>
                <div class="d-flex ms-2">
                    <div class="chart-text me-2">
                        <h6 class="mb-0"><small>LAST MONTH</small></h6>
                        <h4 class="mt-0 text-primary"><?php echo $row['last_month']; ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bread crumb and right sidebar toggle -->
<!-- Container fluid  -->
<div class="container-fluid">
    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="ms-2 align-self-center">
                            <h3 class="mb-0"><?php echo $row['vaccinated']; ?></h3>
                            <h6 class="text-muted mb-0">Total Vaccinations</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="ms-2 align-self-center">
                            <h3 class="mb-0"><?php echo $row['pending']; ?></h3>
                            <h6 class="text-muted mb-0">Pending Vaccinations</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <?php
        include('../config.php');
        $sql = "SELECT COUNT(*) AS total_users FROM tbl_user";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="ms-2 align-self-center">
                            <h3 class="mb-0"><?php echo $row['total_users']; ?></h3>
                            <h6 class="text-muted mb-0">Total Users</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <?php
        include('../config.php');
        $sql = "SELECT COUNT(*) AS total_vaccinators FROM tbl_vaccinator WHERE vaccinator_status='Verified'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="ms-2 align-self-center">
                            <h3 class="mb-0"><?php echo $row['total_vaccinators']; ?></h3>
                            <h6 class="text-muted mb-0">Total Vaccinators</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Places</h4>
                <div class="table-responsive">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Vaccinated</th>
                                <th class="border-top-0">Pending</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('../config.php');
                            $sql = "SELECT COUNT(CASE WHEN vaccination_status='Vaccinated' THEN 1 END) AS vaccinated,COUNT(CASE WHEN vaccination_status='Pending' THEN 1 END) AS pending, place_name FROM tbl_vaccination INNER JOIN tbl_place ON tbl_vaccination.place_id=tbl_place.place_id GROUP BY place_name";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['place_name'] . "</td>";
                                    echo "<td>" . $row['vaccinated'] . "</td>";
                                    echo "<td><p class='text-danger'>" . $row['pending'] . "</p></td></tr>";
                                }
                            } else {
                                echo "No places booked vaccinations yet..";
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