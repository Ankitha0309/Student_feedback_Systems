<?php
session_start();

// Handle student login (any StudentID/password)
if(isset($_POST['login'])) {
    $studentID = $_POST['studentID'];
    $_SESSION['slogin'] = $studentID;
}

// Handle logout
if(isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// If student is not logged in, show login form
if(!isset($_SESSION['slogin'])):
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        body { font-family: Arial; padding: 50px; background:#f2f2f2; }
        form { max-width: 400px; margin: auto; background:#fff; padding: 20px; border-radius:10px; box-shadow:0 0 10px #ccc; }
        input[type=text], input[type=password] { width: 100%; padding: 10px; margin: 5px 0; }
        input[type=submit] { padding: 10px; width: 100%; background-color: #4CAF50; color: white; border: none; cursor:pointer; }
        input[type=submit]:hover { background-color: #45a049; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Student Login</h2>
<form method="POST" action="">
    <label for="studentID">Student ID:</label>
    <input type="text" name="studentID" id="studentID" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <input type="submit" name="login" value="Login">
</form>

</body>
</html>

<?php
exit();
endif; // End login check
?>

<!-- Student is logged in: show feedback form -->
<!DOCTYPE html>
<html>
<head>
    <title>Student Feedback</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>

<h2>Welcome Student: <?php echo htmlspecialchars($_SESSION['slogin']); ?></h2>
<p><a href="?logout=1">Logout</a></p>

<h1 class="main-heading">Student Feedback Form</h1>

<div class="container">
    <h3>Fill this student feedback form so that we can make our teaching better.</h3>

    <form action="php/feedback.php" method="post" class="student-form">
        <!-- STUDENT DETAILS -->
        <div class="student-details">
            <label for="year">Academic Year</label>
            <select name="year" id="year">
                <option value="" disabled selected>Select Year</option>
                <option value="2026">2026</option>
                 <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
            </select>
            <br />

            <label for="sem">Semester</label>
            <select name="sem" id="sem">
                <option value="1st">Sem 1</option>
                <option value="2nd">Sem 2</option>
                <option value="3rd">Sem 3</option>
                <option value="4th">Sem 4</option>
                <option value="5th">Sem 5</option>
                <option value="6th">Sem 6</option>
                <option value="7th">Sem 7</option>
                <option value="8th">Sem 8</option>
            </select>
            <br />

            <label for="date">Date of Feedback</label>
            <input type="date" id="date" name="date" />
            <br />

            <label for="branch">Branch</label>
            <select name="branch" id="branch">
                <option value="CSE">CSE</option>
                <option value="ECE">ECE</option>
                <option value="ME">ME</option>
                
            </select>
            <br />

            <label for="section">Section</label>
            <select name="section" id="section">
                <option value="A">Sec A</option>
                <option value="B">Sec B</option>
                <option value="C">Sec C</option>
            </select>
            <br />

            
            <div class="student-details">
    <label for="subject">Subject</label>
    <input type="text" id="subject" name="subject" placeholder="Enter Subject Name" required />
    <br />

    <label for="teacher">Teacher</label>
<input type="text" id="teacher" name="Teacher" placeholder="Enter Teacher Name" required />
<input type="hidden" name="id" value="12"> <!-- set dynamically -->

        </div>

        <!-- STUDENT FEEDBACK QUESTIONS -->
        <div class="student-feedback">
            <!-- Question 1 --><!-- STUDENT FEEDBACK QUESTIONS -->
<div class="student-feedback">

    <!-- Question 1 -->
    <h4>1) Has the Teacher covered entire Syllabus as prescribed by University?</h4>
    <label><input type="radio" name="ques1" value="5" /> 5- Excellent</label>
    <label><input type="radio" name="ques1" value="4" /> 4- Very Good</label>
    <label><input type="radio" name="ques1" value="3" /> 3- Good</label>
    <label><input type="radio" name="ques1" value="2" /> 2- Average</label>
    <label><input type="radio" name="ques1" value="1" /> 1- Below Average</label>
    <br /><br />

    <!-- Question 2: Effectiveness of Teacher (all sub-parts combined) -->
    <h4>2) Effectiveness of Teacher in terms of Technical Content, Communication Skills, Availability, Pace, and Overall effectiveness</h4>
    <label><input type="radio" name="ques2" value="5" /> 5- Excellent</label>
    <label><input type="radio" name="ques2" value="4" /> 4- Very Good</label>
    <label><input type="radio" name="ques2" value="3" /> 3- Good</label>
    <label><input type="radio" name="ques2" value="2" /> 2- Average</label>
    <label><input type="radio" name="ques2" value="1" /> 1- Below Average</label>
    <br /><br />

    <!-- Question 3 -->
    <h4>3) How do you rate the contents of the curriculum?</h4>
    <label><input type="radio" name="ques3" value="5" /> 5- Excellent</label>
    <label><input type="radio" name="ques3" value="4" /> 4- Very Good</label>
    <label><input type="radio" name="ques3" value="3" /> 3- Good</label>
    <label><input type="radio" name="ques3" value="2" /> 2- Average</label>
    <label><input type="radio" name="ques3" value="1" /> 1- Below Average</label>
    <br /><br />

    <!-- Question 4 -->
    <h4>4) How do you rate lab experiments, if applicable?</h4>
    <label><input type="radio" name="ques4" value="5" /> 5- Excellent</label>
    <label><input type="radio" name="ques4" value="4" /> 4- Very Good</label>
    <label><input type="radio" name="ques4" value="3" /> 3- Good</label>
    <label><input type="radio" name="ques4" value="2" /> 2- Average</label>
    <label><input type="radio" name="ques4" value="1" /> 1- Below Average</label>
    <br /><br />

    <!-- Question 5 -->
    <h4>5) Pace on which contents were covered</h4>
    <label><input type="radio" name="ques5" value="5" /> 5- Excellent</label>
    <label><input type="radio" name="ques5" value="4" /> 4- Very Good</label>
    <label><input type="radio" name="ques5" value="3" /> 3- Good</label>
    <label><input type="radio" name="ques5" value="2" /> 2- Average</label>
    <label><input type="radio" name="ques5" value="1" /> 1- Below Average</label>
    <br /><br />

    <!-- Question 6 -->
    <h4>6) Overall effectiveness of the teacher</h4>
    <label><input type="radio" name="ques6" value="5" /> 5- Excellent</label>
    <label><input type="radio" name="ques6" value="4" /> 4- Very Good</label>
    <label><input type="radio" name="ques6" value="3" /> 3- Good</label>
    <label><input type="radio" name="ques6" value="2" /> 2- Average</label>
    <label><input type="radio" name="ques6" value="1" /> 1- Below Average</label>
    <br /><br />

    <!-- Question 7 -->
    <h4>7) How do you rate the content of the curriculum?</h4>
    <label><input type="radio" name="ques7" value="5" /> 5- Excellent</label>
    <label><input type="radio" name="ques7" value="4" /> 4- Very Good</label>
    <label><input type="radio" name="ques7" value="3" /> 3- Good</label>
    <label><input type="radio" name="ques7" value="2" /> 2- Average</label>
    <label><input type="radio" name="ques7" value="1" /> 1- Below Average</label>
    <br /><br />

    <!-- Question 8 -->
    <h4>8) How do you rate lab experiments, if applicable?</h4>
    <label><input type="radio" name="ques8" value="5" /> 5- Excellent</label>
    <label><input type="radio" name="ques8" value="4" /> 4- Very Good</label>
    <label><input type="radio" name="ques8" value="3" /> 3- Good</label>
    <label><input type="radio" name="ques8" value="2" /> 2- Average</label>
    <label><input type="radio" name="ques8" value="1" /> 1- Below Average</label>
    <br /><br />

    <!-- Question 9 -->
    <h4>9) Teacher’s use of teaching aids and tools</h4>
    <label><input type="radio" name="ques9" value="5" /> 5- Excellent</label>
    <label><input type="radio" name="ques9" value="4" /> 4- Very Good</label>
    <label><input type="radio" name="ques9" value="3" /> 3- Good</label>
    <label><input type="radio" name="ques9" value="2" /> 2- Average</label>
    <label><input type="radio" name="ques9" value="1" /> 1- Below Average</label>
    <br /><br />

    <!-- Question 10 -->
    <h4>10) Overall experience and satisfaction with the teaching</h4>
    <label><input type="radio" name="ques10" value="5" /> 5- Excellent</label>
    <label><input type="radio" name="ques10" value="4" /> 4- Very Good</label>
    <label><input type="radio" name="ques10" value="3" /> 3- Good</label>
    <label><input type="radio" name="ques10" value="2" /> 2- Average</label>
    <label><input type="radio" name="ques10" value="1" /> 1- Below Average</label>
    <br /><br />

    <!-- Remarks -->
    <h4>Any Remarks</h4>
    <textarea name="remarks" rows="5"></textarea>
    <br /><br />

    <div class="submit-form">
        <input type="submit" name="submit" value="Submit" id="submit" />
    </div>
</div>

            
   

   