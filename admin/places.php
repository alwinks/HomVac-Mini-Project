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
            <h3 class="page-title mb-0 p-0">Places</h3>
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
                    <h4 class="card-title">Places </h4>
                    <button class="ms-auto btn btn-sm btn-rounded btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                        Add Place
                    </button>
                </div>
                <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header d-flex">
                                <h4 class="modal-title">Add Place</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <?php
                            include('../config.php');
                            if (isset($_POST['place_add'])) {
                                $place_name = $_POST['place_name'];
                                $sql = "INSERT INTO tbl_place (place_name,place_status) VALUES ('$place_name','Active')";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>alert('Place added successfully!');</script>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                            }
                            ?>
                            <div class="modal-body">
                                <form method="POST" action="<?php $_PHP_SELF ?>">
                                    <div class="form-group">
                                        <label class="col-md-12 mb-0">Place Name</label>
                                        <div class="col-md-12">
                                            <input required name="place_name" type="text" placeholder="Enter new place name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button name="place_add" type="submit" class="btn btn-success">
                                            Add Place
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('../config.php');
                            $sql = "SELECT * FROM tbl_place";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['place_name'] . "</td></tr>";
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