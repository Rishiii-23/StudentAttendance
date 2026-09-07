<?php
include "db.php";

if (!isset($_GET['id'])) {
    die("Student ID not provided.");
}

$id = $_GET['id'];

$sql = "DELETE FROM student WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: students.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>