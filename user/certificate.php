<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../user_login.php");
}
?>
<html>

<head>
    <style type='text/css'>
        body,
        html {
            margin: 0;
            padding: 0;
        }

        body {
            color: black;
            display: table;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-size: 24px;
            text-align: center;
        }

        .container {
            border: 20px solid #1e88e5;
            width: 750px;
            height: 563px;
            display: table-cell;
            vertical-align: middle;
            margin: 20px;
        }

        .logo {
            color: #1e88e5;
            margin: 20px;
        }

        .marquee {
            color: #1e88e5;
            font-size: 48px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            HomVac
        </div>
        <div class="marquee">
            Certificate of Immunization
        </div>
        <?php
        include('../config.php');
        $vaccination_id = $_GET['vaccination_id'];
        $sql = "SELECT * FROM tbl_vaccination INNER JOIN tbl_member ON tbl_vaccination.member_id=tbl_member.member_id INNER JOIN tbl_user ON tbl_vaccination.user_id=tbl_user.user_id INNER JOIN tbl_vaccine ON tbl_vaccination.vaccine_id=tbl_vaccine.vaccine_id INNER JOIN tbl_vaccinator ON tbl_vaccination.vaccinator_id=tbl_vaccinator.vaccinator_id WHERE vaccination_id='$vaccination_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<table style='margin: 20px;'>";
                echo "<tr><td><b>Name</b></td><td>" . $row['member_name'] . "</td></tr>";
                echo "<tr><td><b>Date of Birth</b></td><td>" . date("d-m-Y", strtotime($row['member_dob'])) . "</td></tr>";
                echo "<tr><td><b>Gender</b></td><td>" . $row['member_gender'] . "</td></tr>";
                echo "<tr><td><b>Age Group</b></td><td>" . $row['vaccine_age'] . "</td></tr>";
                echo "<tr><td><b>Vaccine</b></td><td>" . $row['vaccine_name'] . "</td></tr>";
                echo "<tr><td><b>Vaccinated Date</b></td><td>" . date("d-m-Y", strtotime($row['vaccinated_date'])) . "</td></tr>";
                echo "<tr><td><b>Vaccinated Time</b></td><td>" . date("h:i A", strtotime($row['vaccinated_time'])) . "</td></tr>";
                echo "</table>";
                echo "<p style='margin: 20px;'>I certify that this immunization information was transferred from the above-named individual's medical records. </p>";
                echo $row['vaccinator_name'];
            }
        }
        mysqli_close($conn);
        ?>
    </div>
</body>

</html>