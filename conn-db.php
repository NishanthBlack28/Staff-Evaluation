<?php
session_start();
$conn = mysqli_connect("0.0.0.0", "root", "root", "staff_eval");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>