<?php
include "db.php";
$search = "";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sql = "SELECT * FROM student
        WHERE name LIKE '%$search%'
        OR roll_no LIKE '%$search%'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            padding: 40px;
        }

        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #333;
            color: white;
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

    <h1>Student List</h1>

    <form method="GET">
    <input type="text" name="search"
           placeholder="Search by name or roll no"
           value="<?php echo $search; ?>">

    <input type="submit" value="Search">
</form>
<a href="students.php">Clear Search</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Roll No</th>
            <th>Name</th>
            <th>Course</th>
            <th>Semester</th>
            <th>Action</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['roll_no'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['course'] . "</td>";
            echo "<td>" . $row['semester'] . "</td>";
            echo "<td>";
echo "<a href='edit_student.php?id=" . $row['id'] . "'>Edit</a> | ";
echo "<a href='delete_student.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this student?');\">Delete</a>";
echo "</td>";
            echo "</tr>";
        }
        ?>

    </table>

    <a class="back" href="index.php">Back to Dashboard</a>

</div>

</body>
</html>