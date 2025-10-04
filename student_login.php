<?php
session_start();

if(isset($_POST['login'])) {
    // Accept any StudentID and password
    $studentID = $_POST['studentID'];
    $password  = $_POST['password']; // any password

    $_SESSION['slogin'] = $studentID;
    header("location: student_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Link your CSS file -->
    <link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body class="login-background">
<center>
<div class="login-container">
    <h2>Student Login</h2>
    <form method="POST" action="">
        <label for="studentID">Student ID:</label>
        <input type="text" name="studentID" id="studentID" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" name="login" value="Login"></center>
    </form>
</div>

</body>
</html>
