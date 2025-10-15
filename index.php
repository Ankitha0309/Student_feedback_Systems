<!DOCTYPE html>
<html>
<head>
    <title>Login Selection</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Link your CSS -->
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body class="login-background">

<div class="login-selection">
    <form action="php/admin.php" method="POST">
        <input type="submit" name="admin" value="Admin Login" class="login-btn" />
    </form>

    <form action="student_login.php" method="POST">
        <input type="submit" name="student" value="Student Login" class="login-btn" />
    </form>
</div>

</body>
</html>
