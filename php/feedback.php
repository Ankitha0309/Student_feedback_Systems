<?php 
    ob_start(); 
    require 'config.php';

    $year = $_POST['year'];
    $sem = $_POST['sem'];
    $date = $_POST['date'];
    $branch = $_POST['branch'];
    $section = $_POST['section'];
    $subject = $_POST['subject'];
    $Teacher = $_POST['Teacher'];  // make sure you collect this in your form
    $ques1 = $_POST['ques1'];
    $ques2 = $_POST['ques2'];   // only one ques2 field in DB
    $ques3 = $_POST['ques3'];
    $ques4 = $_POST['ques4'];
    $ques5 = $_POST['ques5'];
    $ques6 = $_POST['ques6'];
    $ques7 = $_POST['ques7'];
    $ques8 = $_POST['ques8'];
    $ques9 = $_POST['ques9'];
    $ques10 = $_POST['ques10'];
    $remarks = $_POST['remarks'];

    $query = mysqli_query($con, "INSERT INTO `feedback`
        (`year`, `sem`, `date`, `branch`, `section`, `subject`, `Teacher`, 
         `ques1`, `ques2`, `ques3`, `ques4`, `ques5`, `ques6`, `ques7`, `ques8`, `ques9`, `ques10`, `remarks`) 
        VALUES 
        ('$year', '$sem', '$date', '$branch', '$section', '$subject', '$Teacher', 
         '$ques1', '$ques2', '$ques3', '$ques4', '$ques5', '$ques6', '$ques7', '$ques8', '$ques9', '$ques10', '$remarks')");

    echo '<script>alert("Thank you for the feedback."); location.replace(document.referrer);</script>';
?>
