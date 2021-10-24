<?php
session_start();
session_unset();
session_destroy();
header("Location: ../vaccinator_login.php");
