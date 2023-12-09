<?php
include("conn-db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rollno = $_POST["rollno"];
    $pass = $_POST["pass"];
    $_SESSION['rollno'] = $_POST["rollno"];
    $sql = "SELECT * FROM student WHERE rollno = '$rollno' AND pass = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["log"] == 0) {
            
            header("Location: main.html");
            exit();
        } else {
            echo "Error: User already logged in.";
        }
    } else {
        echo "Error: Incorrect roll number or password.";
    }
}

mysqli_close($conn);
?>
