<?php
    require 'includes/database.php';

   
    $conn=getDB();// database connection 


    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $lname=$_POST['lesson_name'];
        // $flid=$_POST['fl_id'];
        $ldate=$_POST['lesson_date'];
        $stime=$_POST['start_time'];
        $etime=$_POST['end_time'];
        $day=$_POST['day'];
        $last_inserted_id = 0;
        
       
  
    // Validate essential fields
    if (empty($lname) || empty($ldate) || empty($stime) || empty($etime) || empty($day)) {
        echo "Please fill in all required fields.";
    } else {
        $conn = getDB();
        $sqlfitnesslesson = "INSERT INTO fitnesslesson(Name) VALUES(?)";
        $stmt = mysqli_prepare($conn, $sqlfitnesslesson);

        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, "s", $lname);
            mysqli_stmt_execute($stmt);

            // Retrieve the last inserted ID
            $last_inserted_id = mysqli_insert_id($conn);

            $sqltimetable = "INSERT INTO fitnesslesson_timetable(FL_ID, LessonDate, StartTime, EndTime, Day) VALUES(?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sqltimetable);

            if ($stmt === false) {
                echo mysqli_error($conn);
            } else {
                mysqli_stmt_bind_param($stmt, "issss", $last_inserted_id, $ldate, $stime, $etime, $day);
                mysqli_stmt_execute($stmt);
                echo "Lesson inserted successfully.";
            }
        }
    }
}

    ?>

<?php require 'header.php'; ?>


<div class="admin-background">
<div class="admin-container">
    <h2>New Record</h2>
    <form class="admin-form" action="" method="post">
        <label for="lesson_name">Name:</label>
        <input type="text" name="lesson_name" id=""><br>
        <label for="lesson_date">LessonDate:</label>
        <input type="date" name="lesson_date" id=""><br>
        <label for="start_time">StartTime:</label>
        <input type="time" name="start_time" id=""><br>
        <label for="end_time">EndTime:</label>
        <input type="time" name="end_time" id=""><br>
        <label for="day">Day:</label>
        <input type="text" name="day" id=""><br>
        <button type="submit">Insert</button>
    </form>
    <div class="admin-links">
        <a href="editAdmin.php">Edit Lesson</a>
        <a href="deleteAdmin.php">Delete Lesson</a>
    </div>
</div>
</div>
