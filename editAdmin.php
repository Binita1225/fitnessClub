<?php
require 'includes/database.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $lname=$_POST['lesson_name'];
    $ldate=$_POST['lesson_date'];
    $stime=$_POST['start_time'];
    $etime=$_POST['end_time'];
    $day=$_POST['day'];
    $id = $_POST['id'];
   
    if($lname == '' || $ldate == '' || $stime == '' || $etime == '' || $day == ''){
        echo 'One or more fields are empty';
    }else{
        $conn=getDB();
        $sqlfitnesslesson="UPDATE fitnesslesson SET name=? WHERE id=? ";//?is a placeholder for record item
        $stmt=mysqli_prepare($conn,$sqlfitnesslesson);
        if($stmt===false){
            echo mysqli_error($conn);

        }else{
            mysqli_stmt_bind_param($stmt,"si",$lname, $id);
            // here ss is to pass string values and i is to pass integer values
            if(mysqli_stmt_execute($stmt)){

            }  

            
        }
        $sqltimetable="UPDATE fitnesslesson_timetable SET LessonDate=?,StartTime=?,EndTime=?,Day=? WHERE FL_ID=? ";//?is a placeholder for record item
        $stmt=mysqli_prepare($conn,$sqltimetable);
        if($stmt===false){
            echo mysqli_error($conn);

        }else{
            mysqli_stmt_bind_param($stmt,"isssi",$ldate,$stime,$etime,$day,$id);
            // here ss is to pass string values and i is to pass integer values
            mysqli_stmt_execute($stmt);
            echo 'Lesson updated sucessfully!';
        }
        }  
    }else{
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $conn = getDB();
            $sqleditlesson = 'SELECT * FROM fitnesslesson WHERE id=?';
            
            
            $stmt = mysqli_prepare($conn, $sqleditlesson);
            if($stmt === false){
                echo mysqli_error($conn);
            }else{
                mysqli_stmt_bind_param($stmt, 'i', $id);
                mysqli_stmt_execute($stmt);
                $resultlesson = mysqli_stmt_get_result($stmt);
                $lesson = mysqli_fetch_assoc($resultlesson);

            }
            $sqledittimetable = 'SELECT * FROM fitnesslesson_timetable WHERE fl_id=?';
            $stmt = mysqli_prepare($conn, $sqledittimetable);
            if($stmt === false){
                echo mysqli_error($conn);
            }else{
                mysqli_stmt_bind_param($stmt, 'i', $id);
                mysqli_stmt_execute($stmt);
                $resulttimetable = mysqli_stmt_get_result($stmt);
                $timetable = mysqli_fetch_assoc($resulttimetable);


            }
         } 
    }

?>


<?php require 'header.php'; ?>


<div class="admin-background">
<div class="admin-container">
    <form class="admin-form" action="" method="GET">
        <label for="id">Enter ID of lesson you want to edit: </label>
        <input type="text" name="id" id="id">
        <button type="submit">Edit</button>
    </form>

    <h2>Edit Lesson</h2>
    <form class="admin-form" action="" method="post">
        <input type="hidden" name="id" value="<?php echo $lesson['Id'] ?? ''; ?>">
        <label for="lesson_name">Name:</label>
        <input type="text" name="lesson_name" value="<?php echo $lesson['Name'] ?? ''; ?>"><br>
        <label for="lesson_date">LessonDate:</label>
        <input type="date" name="lesson_date" value="<?php echo $timetable['LessonDate'] ?? ''; ?>"><br>
        <label for="start_time">StartTime:</label>
        <input type="time" name="start_time" value="<?php echo $timetable['StartTime'] ?? ''; ?>"><br>
        <label for="end_time">EndTime:</label>
        <input type="time" name="end_time" value="<?php echo $timetable['EndTime'] ?? ''; ?>"><br>
        <label for="day">Day:</label>
        <input type="text" name="day" value="<?php echo $timetable['Day'] ?? ''; ?>"><br>
        <button type="submit">Edit Lesson</button>
    </form>
    <div class="admin-links">
    <a href="admin.php">Back to Admin Panel</a>
</div>
</div>
</div>

