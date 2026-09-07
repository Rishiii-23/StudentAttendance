<?php
include "db.php";

if (!isset($_GET['id'])) {
    die("Student ID not provided.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM student WHERE id = $id";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    die("Student not found.");
}

if (isset($_POST['update_student'])) {

    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $course = $_POST['course'];
    $semester = $_POST['semester'];

    $sql = "UPDATE student
            SET roll_no='$roll_no',
                name='$name',
                course='$course',
                semester='$semester'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: students.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

<h1>Edit Student</h1>

<form method="POST">

    <label>Roll No:</label>
    <input type="text" name="roll_no"
           value="<?php echo $student['roll_no']; ?>" required>
    <br><br>

    <label>Name:</label>
    <input type="text" name="name"
           value="<?php echo $student['name']; ?>" required>
    <br><br>

    <label>Course:</label>
    <input type="text" name="course"
           value="<?php echo $student['course']; ?>" required>
    <br><br>

    <label>Semester:</label>
    <input type="text" name="semester"
           value="<?php echo $student['semester']; ?>" required>
    <br><br>

    <input type="submit" name="update_student" value="Update Student">

</form>

<br>

<a href="students.php">Back to Students</a>

</body>
</html>