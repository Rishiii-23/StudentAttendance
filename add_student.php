<?php
include "db.php";

if (isset($_POST['add_student'])) {

    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $course = $_POST['course'];
    $semester = $_POST['semester'];

    $sql = "INSERT INTO student (roll_no, name, course, semester)
            VALUES ('$roll_no', '$name', '$course', '$semester')";

    if (mysqli_query($conn, $sql)) {
        echo "Student added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>

<body>

<h1>Add New Student</h1>

<form method="POST">

    <label>Roll No:</label>
    <input type="text" name="roll_no" required>
    <br><br>

    <label>Name:</label>
    <input type="text" name="name" required>
    <br><br>

    <label>Course:</label>
    <input type="text" name="course" required>
    <br><br>

    <label>Semester:</label>
    <input type="text" name="semester" required>
    <br><br>

    <input type="submit" name="add_student" value="Add Student">

</form>

<br>

<a href="index.php">Back to Dashboard</a>

</body>
</html>