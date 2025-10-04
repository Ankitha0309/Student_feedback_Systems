<?php
session_start();
require 'php/config.php';

if (!isset($_SESSION['login_user'])) {
    echo "<p>Please login as admin to view feedback.</p>";
    exit();
}

// Fetch distinct teachers for the dropdown
$teacherResult = mysqli_query($con, "SELECT DISTINCT Teacher FROM feedback");
$teachers = [];
while($t = mysqli_fetch_assoc($teacherResult)) {
    $teachers[] = $t['Teacher'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Feedback</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .logout { margin-bottom: 20px; }
    </style>
</head>
<body>

<form action="php/logout.php" method="POST">
    <div class="logout">
        <input type="submit" value="Log Out" name="logout" />
    </div>
</form>

<h2>All Feedback</h2>
<?php
$result = mysqli_query($con, "SELECT * FROM feedback");
echo "<table>
        <tr>
            <th>Year</th><th>Sem</th><th>Date</th><th>Branch</th><th>Section</th>
            <th>Subject</th><th>Teacher</th>";
for($i=1;$i<=10;$i++){ echo "<th>Ques$i</th>"; }
echo "<th>Remarks</th></tr>";

while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['year']."</td>";
    echo "<td>".$row['sem']."</td>";
    echo "<td>".$row['date']."</td>";
    echo "<td>".$row['branch']."</td>";
    echo "<td>".$row['section']."</td>";
    echo "<td>".$row['subject']."</td>";
    echo "<td>".$row['Teacher']."</td>";
    for($i=1;$i<=10;$i++){
        echo "<td>".$row['ques'.$i]."</td>";
    }
    echo "<td>".$row['remarks']."</td>";
    echo "</tr>";
}
echo "</table>";
?>

<!-- Teacher selection form -->
<h3>View Feedback Graph for a Teacher</h3>
<form method="POST" action="teacher_feedback.php">
    <label for="teacher">Select Teacher:</label>
    <select name="teacher" id="teacher" required>
        <option value="">-- Select Teacher --</option>
        <?php
        foreach($teachers as $t) {
            echo "<option value='".htmlspecialchars($t)."'>".htmlspecialchars($t)."</option>";
        }
        ?>
    </select>
    <input type="submit" value="View Graph">
</form>

</body>
</html>
