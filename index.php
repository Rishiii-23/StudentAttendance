<?php
include "db.php";

// Total Students
$student_query = "SELECT COUNT(*) AS total_students FROM student";
$student_result = mysqli_query($conn, $student_query);
$student_data = mysqli_fetch_assoc($student_result);
$total_students = $student_data['total_students'];

// Total Attendance Records
$attendance_query = "SELECT COUNT(*) AS total_attendance FROM attendance";
$attendance_result = mysqli_query($conn, $attendance_query);
$attendance_data = mysqli_fetch_assoc($attendance_result);
$total_attendance = $attendance_data['total_attendance'];

// Total Present
$present_query = "SELECT COUNT(*) AS total_present FROM attendance WHERE status = 'Present'";
$present_result = mysqli_query($conn, $present_query);
$present_data = mysqli_fetch_assoc($present_result);
$total_present = $present_data['total_present'];

// Total Absent
$absent_query = "SELECT COUNT(*) AS total_absent FROM attendance WHERE status = 'Absent'";
$absent_result = mysqli_query($conn, $absent_query);
$absent_data = mysqli_fetch_assoc($absent_result);
$total_absent = $absent_data['total_absent'];
?>

<!DOCTYPE html>
<html>
<head>

    <title>Student Attendance System</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            margin: 0;
            padding: 50px;
        }

        .container {
            background: white;
            width: 800px;
            margin: auto;
            padding: 40px;
            border-radius: 10px;
        }

        h1 {
            margin-bottom: 10px;
        }

        .welcome {
            color: #555;
            margin-bottom: 30px;
        }

        .cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            width: 160px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 10px;
        }

        .card h2 {
            margin: 5px 0;
            font-size: 18px;
        }

        .number {
            font-size: 30px;
            font-weight: bold;
            margin: 10px 0;
        }

        .btn {
            display: block;
            width: 300px;
            margin: 15px auto;
            padding: 12px;
            text-decoration: none;
            background-color: #333;
            color: white;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #555;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Student Attendance System</h1>

    <p class="welcome">
        Welcome to the Attendance Management System
    </p>


    <!-- Dashboard Cards -->

    <div class="cards">

        <div class="card">
            <h2>Total Students</h2>
            <p class="number"><?php echo $total_students; ?></p>
        </div>

        <div class="card">
            <h2>Total Attendance</h2>
            <p class="number"><?php echo $total_attendance; ?></p>
        </div>

        <div class="card">
            <h2>Present</h2>
            <p class="number"><?php echo $total_present; ?></p>
        </div>

        <div class="card">
            <h2>Absent</h2>
            <p class="number"><?php echo $total_absent; ?></p>
        </div>

    </div>


    <!-- Buttons -->

    <a class="btn" href="students.php">View Students</a>

    <a class="btn" href="add_student.php">Add Student</a>

    <a class="btn" href="attendance.php">Mark Attendance</a>

    <a class="btn" href="view_attendance.php">View Attendance</a>

    <a class="btn" href="attendance_percentage.php">
        Attendance Percentage
    </a>

</div>

</body>
</html>