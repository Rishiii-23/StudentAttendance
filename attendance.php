<?php
include "db.php";

$sql = "SELECT * FROM student";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 40px;
        }

        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
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

        input[type="text"],
        input[type="date"],
        select {
            padding: 8px;
            width: 200px;
        }

        .form-group {
            margin-top: 20px;
            text-align: center;
        }

        .save {
            margin-top: 25px;
            padding: 12px 30px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
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

    <h1>Mark Attendance</h1>

    <form method="POST" action="save_attendance.php">

        <div class="form-group">
            <label>Subject:</label>
            <input type="text" name="subject" required>
        </div>

        <div class="form-group">
            <label>Date:</label>
            <input type="date" name="date" required>
        </div>

        <table>

            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Status</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {

                echo "<tr>";

                echo "<td>" . $row['roll_no'] . "</td>";

                echo "<td>" . $row['name'] . "</td>";

                echo "<td>";

                echo "<select name='status[" . $row['id'] . "]'>";
                echo "<option value='Present'>Present</option>";
                echo "<option value='Absent'>Absent</option>";
                echo "</select>";

                echo "</td>";

                echo "</tr>";
            }
            ?>

        </table>

        <div class="form-group">
            <input class="save" type="submit" value="Save Attendance">
        </div>

    </form>

    <div style="text-align:center;">
        <a class="back" href="index.php">Back to Dashboard</a>
    </div>

</div>

</body>
</html>