<?php
include "db.php";

$search = "";
$subject = "";
$date = "";
$status = "";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

if (isset($_GET['subject'])) {
    $subject = $_GET['subject'];
}

if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

if (isset($_GET['status'])) {
    $status = $_GET['status'];
}

$sql = "SELECT attendance.*, student.roll_no, student.name
        FROM attendance
        INNER JOIN student ON attendance.student_id = student.id
        WHERE 1=1";

if ($search != "") {
    $sql .= " AND (student.name LIKE '%$search%'
              OR student.roll_no LIKE '%$search%')";
}

if ($subject != "") {
    $sql .= " AND attendance.subject LIKE '%$subject%'";
}

if ($date != "") {
    $sql .= " AND attendance.date = '$date'";
}

if ($status != "") {
    $sql .= " AND attendance.status = '$status'";
}

$sql .= " ORDER BY attendance.date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>

    <title>View Attendance</title>

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

        input, select {
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

    <h1>Attendance Records</h1>


    <!-- Search and Filter -->

    <div class="filter-box">

        <form method="GET">

            <input
                type="text"
                name="search"
                placeholder="Search by name or roll no"
                value="<?php echo htmlspecialchars($search); ?>"
            >

            <input
                type="text"
                name="subject"
                placeholder="Subject"
                value="<?php echo htmlspecialchars($subject); ?>"
            >

            <input
                type="date"
                name="date"
                value="<?php echo htmlspecialchars($date); ?>"
            >

            <select name="status">

                <option value="">All Status</option>

                <option value="Present"
                    <?php if ($status == "Present") echo "selected"; ?>>
                    Present
                </option>

                <option value="Absent"
                    <?php if ($status == "Absent") echo "selected"; ?>>
                    Absent
                </option>

            </select>

            <br>

            <input
                class="search-btn"
                type="submit"
                value="Search"
            >

            <a class="clear-btn" href="view_attendance.php">
                Clear
            </a>

        </form>

    </div>


    <!-- Attendance Table -->

    <table>

        <tr>
            <th>Roll No</th>
            <th>Name</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Status</th>
        </tr>

        <?php

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                echo "<tr>";

                echo "<td>" . htmlspecialchars($row['roll_no']) . "</td>";

                echo "<td>" . htmlspecialchars($row['name']) . "</td>";

                echo "<td>" . htmlspecialchars($row['subject']) . "</td>";

                echo "<td>" . htmlspecialchars($row['date']) . "</td>";

                echo "<td>" . htmlspecialchars($row['status']) . "</td>";

                echo "</tr>";
            }

        } else {

            echo "<tr>";
            echo "<td colspan='5'>No attendance records found.</td>";
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