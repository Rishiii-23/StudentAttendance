<?php
include "db.php";

$subject = "";
$date = "";

if (isset($_GET['subject'])) {
    $subject = $_GET['subject'];
}

if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

$sql = "SELECT 
            student.id,
            student.roll_no,
            student.name,
            COUNT(attendance.id) AS total_classes,
            SUM(CASE WHEN attendance.status = 'Present' THEN 1 ELSE 0 END) AS present,
            SUM(CASE WHEN attendance.status = 'Absent' THEN 1 ELSE 0 END) AS absent
        FROM student
        LEFT JOIN attendance 
        ON student.id = attendance.student_id";

if ($subject != "") {
    $sql .= " AND attendance.subject = '$subject'";
}

if ($date != "") {
    $sql .= " AND attendance.date = '$date'";
}

$sql .= " GROUP BY student.id, student.roll_no, student.name
          ORDER BY student.roll_no";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Attendance Percentage</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 40px;
        }

        .container {
            width: 90%;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
        }

        .filter-box {
            text-align: center;
            margin-top: 25px;
        }

        input {
            padding: 10px;
            margin: 5px;
        }

        .search-btn {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .clear-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #777;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #333;
            color: white;
        }

        .back {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Attendance Percentage</h1>


    <!-- Filter -->

    <div class="filter-box">

        <form method="GET">

            <input
                type="text"
                name="subject"
                placeholder="Enter Subject"
                value="<?php echo htmlspecialchars($subject); ?>"
            >

            <input
                type="date"
                name="date"
                value="<?php echo htmlspecialchars($date); ?>"
            >

            <input
                class="search-btn"
                type="submit"
                value="Filter"
            >

            <a class="clear-btn" href="attendance_percentage.php">
                Clear
            </a>

        </form>

    </div>


    <!-- Percentage Table -->

    <table>

        <tr>
            <th>Roll No</th>
            <th>Name</th>
            <th>Total Classes</th>
            <th>Present</th>
            <th>Absent</th>
            <th>Percentage</th>
        </tr>

        <?php

        while ($row = mysqli_fetch_assoc($result)) {

            $total = $row['total_classes'];
            $present = $row['present'];

            if ($total > 0) {
                $percentage = ($present / $total) * 100;
            } else {
                $percentage = 0;
            }

            echo "<tr>";

            echo "<td>" . htmlspecialchars($row['roll_no']) . "</td>";

            echo "<td>" . htmlspecialchars($row['name']) . "</td>";

            echo "<td>" . $total . "</td>";

            echo "<td>" . $present . "</td>";

            echo "<td>" . $row['absent'] . "</td>";

            echo "<td>" . number_format($percentage, 2) . "%</td>";

            echo "</tr>";
        }

        ?>

    </table>


    <div style="text-align:center;">

        <a class="back" href="index.php">
            Back to Dashboard
        </a>

    </div>

</div>

</body>
</html>