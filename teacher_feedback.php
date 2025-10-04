<?php
session_start();
require 'php/config.php';

if (!isset($_SESSION['login_user'])) {
    echo "<p>Please login as admin to view feedback.</p>";
    exit();
}

if (!isset($_POST['teacher'])) {
    echo "<p>No teacher selected. Go back and select a teacher.</p>";
    exit();
}

$selectedTeacher = $_POST['teacher'];

// Chart type: default to 'bar' if not set
$chartType = isset($_POST['chart_type']) ? $_POST['chart_type'] : 'bar';

// Fetch feedback for the selected teacher
$result = mysqli_query($con, "SELECT * FROM feedback WHERE Teacher='$selectedTeacher'");

// Calculate averages for graph
$avgData = [];
for ($i = 1; $i <= 10; $i++) {
    $qResult = mysqli_query($con, "SELECT AVG(ques$i) as avgQ FROM feedback WHERE Teacher='$selectedTeacher'");
    $qRow = mysqli_fetch_assoc($qResult);
    $avgData[$i] = round($qRow['avgQ'], 2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback for <?php echo htmlspecialchars($selectedTeacher); ?></title>
    <link rel="stylesheet" href="css/styles2.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            padding: 20px;
        }
        h2, h3 {
            text-align: center;
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto;
            background: #fff;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        th { background-color: #e0e0e0; }
        input[type="submit"], select {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover { background-color: #45a049; }
        canvas {
            display: block;
            margin: 0 auto 30px;
            background: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        form.chart-form { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>

<h2>Feedback for Teacher: <?php echo htmlspecialchars($selectedTeacher); ?></h2>

<!-- Table of feedback -->
<table>
    <tr>
        <th>Year</th><th>Sem</th><th>Date</th><th>Branch</th><th>Section</th>
        <th>Subject</th>
        <?php for($i=1;$i<=10;$i++){ echo "<th>Ques$i</th>"; } ?>
        <th>Remarks</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['year']; ?></td>
            <td><?php echo $row['sem']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['branch']; ?></td>
            <td><?php echo $row['section']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <?php for($i=1;$i<=10;$i++){ echo "<td>".$row['ques'.$i]."</td>"; } ?>
            <td><?php echo $row['remarks']; ?></td>
        </tr>
    <?php } ?>
</table>

<!-- Chart Type Selector -->
<form method="POST" action="teacher_feedback.php" class="chart-form">
    <input type="hidden" name="teacher" value="<?php echo htmlspecialchars($selectedTeacher); ?>">
    <label for="chart_type">Select Chart Type: </label>
    <select name="chart_type" id="chart_type">
        <option value="bar" <?php if($chartType=='bar') echo 'selected'; ?>>Bar</option>
        <option value="line" <?php if($chartType=='line') echo 'selected'; ?>>Line</option>
        <option value="pie" <?php if($chartType=='pie') echo 'selected'; ?>>Pie</option>
    </select>
    <input type="submit" value="Update Chart">
</form>

<!-- Chart -->
<h3>Average Ratings Graph</h3>
<canvas id="feedbackChart" width="600" height="300"></canvas>

<!-- Back button -->
<form action="admin_feedback.php" method="GET">
    <input type="submit" value="Back to Admin Feedback" />
</form>

<script>
const ctx = document.getElementById('feedbackChart').getContext('2d');

const chartType = '<?php echo $chartType; ?>';
const chartData = {
    labels: ['Q1','Q2','Q3','Q4','Q5','Q6','Q7','Q8','Q9','Q10'],
    datasets: [{
        label: 'Average Rating (1–10)',
        data: <?php echo json_encode(array_values($avgData)); ?>,
        backgroundColor: [
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(199, 199, 199, 0.6)',
            'rgba(83, 102, 255, 0.6)',
            'rgba(255, 102, 178, 0.6)',
            'rgba(102, 255, 204, 0.6)'
        ],
        borderColor: 'rgba(0,0,0,0.8)',
        borderWidth: 1
    }]
};

const feedbackChart = new Chart(ctx, {
    type: chartType,
    data: chartData,
    options: {
        scales: {
            y: chartType === 'pie' ? {} : { beginAtZero: true, max: 5 }
        }
    }
});
</script>

</body>
</html>
