<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Feedback Details</title>
    <link rel="stylesheet" href="css/styles2.css" />
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <form action="php/logout.php" method="POST">
        <div class="logout">
            <input type="submit" value="Log Out" name="logout" />
        </div>
    </form>

    <?php 
    session_start();
    require 'php/config.php';

    if (isset($_SESSION['login_user'])) {
        $userLoggedIn = $_SESSION['login_user'];
        $result = mysqli_query($con,"SELECT * FROM feedback");

        echo "<h2>Feedback Details</h2>";
        echo "<table>
                <tr>
                    <th>Year</th>
                    <th>Sem</th>
                    <th>Date</th>
                    <th>Branch</th>
                    <th>Section</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Ques1</th>
                    <th>Ques2</th>
                    <th>Ques3</th>
                    <th>Ques4</th>
                    <th>Ques5</th>
                    <th>Ques6</th>
                    <th>Ques7</th>
                    <th>Ques8</th>
                    <th>Ques9</th>
                    <th>Ques10</th>
                    <th>Remarks</th>
                </tr>";

        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['sem'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['branch'] . "</td>";
            echo "<td>" . $row['section'] . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['Teacher'] . "</td>";
            echo "<td>" . $row['ques1'] . "</td>";
            echo "<td>" . $row['ques2'] . "</td>";
            echo "<td>" . $row['ques3'] . "</td>";
            echo "<td>" . $row['ques4'] . "</td>";
            echo "<td>" . $row['ques5'] . "</td>";
            echo "<td>" . $row['ques6'] . "</td>";
            echo "<td>" . $row['ques7'] . "</td>";
            echo "<td>" . $row['ques8'] . "</td>";
            echo "<td>" . $row['ques9'] . "</td>";
            echo "<td>" . $row['ques10'] . "</td>";
            echo "<td>" . $row['remarks'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";                                                                    
    } else {
        echo "<p>Please login as admin to view feedback.</p>";
    }
    ?>
</body>
</html>
