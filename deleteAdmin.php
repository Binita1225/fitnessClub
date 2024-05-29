<?php
require 'includes/database.php';

$conn=getDB();


if (isset($_GET['id'])){
    $id=$_GET['id'];
    $sqlfitnesslesson="DELETE FROM fitnesslesson WHERE id=? ";//?is a placeholder for record item
    $stmt=mysqli_prepare($conn,$sqlfitnesslesson);
    if($stmt===false){
        echo mysqli_error($conn);

    }else{
        mysqli_stmt_bind_param($stmt,'i',$id);
        // here ss is to pass string values and i is to pass integer values
        mysqli_stmt_execute($stmt);
        }
    
    $sqltimetable="DELETE FROM fitnesslesson_timetable WHERE FL_ID=? ";//?is a placeholder for record item
    $stmt=mysqli_prepare($conn,$sqltimetable);
    if($stmt===false){
        echo mysqli_error($conn);

    }else{
        mysqli_stmt_bind_param($stmt,'i',$id);
        // here ss is to pass string values and i is to pass integer values
        mysqli_stmt_execute($stmt);
           
        echo 'Lesson deleted sucessfully!';
    }
    }
    

?>

<?php require 'header.php'; ?>


<div class="admin-background">
<div class="admin-container">
    <form class="admin-form" action="" method="GET">
        <label for="id">Enter ID of lesson you want to delete: </label>
        <input type="text" name="id" id="id">
        <button type="submit">Delete</button>
    </form>
    <div class="admin-links">
    <a href="admin.php">Back to Admin Panel</a>
</div>
</div>
</div>
