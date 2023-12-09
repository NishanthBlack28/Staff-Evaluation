<?php
include("conn-db.php");
$roll_no = $_SESSION['rollno'];
if (isset($_POST['submit'])) {
    
    for ($i = 1; $i <= 3; $i++) {
        $staffId = "sfn" . $i;

        for ($j = 1; $j <= 4; $j++) {
            $questionId = $staffId . "-q" . $j;

            if (isset($_POST[$questionId])) {
                $mark = $_POST[$questionId];
                $sql = "SELECT id, marks FROM staff WHERE id = '$staffId'";
                $result = mysqli_query($conn, $sql);

                if($result) {
                    if($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $existingMark = $row['marks'];
                        $newMark = $existingMark + $mark;

                        $update_query = "UPDATE staff SET marks = '$newMark' WHERE id = '$staffId'";
                        mysqli_query($conn, $update_query);
                       
                       $updateLog = "UPDATE student SET log = 1 WHERE rollno = '$roll_no'";
                       $conn->query($updateLog);
                    } else {
                        $insert_query = "INSERT INTO staff (id, marks) VALUES ('$staffId', '$mark')";
                        mysqli_query($conn, $insert_query);
                    }
                } else {
                    die("Error: " . mysqli_error($conn));
                }
            }
        }
    }
    if ($update_query) {
      echo "<script>alert('{$roll_no} Your Feedback Update');</script>";
      } else {
      echo "Not Update";
      }
}

mysqli_close($conn);
?>
