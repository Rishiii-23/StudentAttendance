<?php
include "db.php";

$subject = $_POST['subject'];
$date = $_POST['date'];
$status = $_POST['status'];

foreach ($status as $student_id => $student_status) {

    // Check if attendance already exists
    $check_sql = "SELECT id FROM attendance
                  WHERE student_id = '$student_id'
                  AND date = '$date'
                  AND subject = '$subject'";

    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        continue;
    }

    // Insert new attendance
    $sql = "INSERT INTO attendance (student_id, date, status, subject)
            VALUES ('$student_id', '$date', '$student_status', '$subject')";

    mysqli_query($conn, $sql);
}

echo "Attendance saved successfully!";
?>