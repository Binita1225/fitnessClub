<?php require'header.php'?>

<table class="table"> 
<thead>
        <th>
            Id
</th>
<th>
    Lesson Name
</th>
<th>
    Day
</th>
<th>
    Date
</th>
<th>
    Start Time
</th>
<th>
    End Time
</th>
<th>
    Status
</th>
<th>
    Action
</th>
</thead>


<?php 

require 'includes/database.php';
$conn=getDB();

$customerId= $_SESSION['customerId'];
$sql = "SELECT ft.Id, fl.Id as LessonId, fl.Name, ft.Day, ft.LessonDate, ft.StartTime, ft.EndTime, bl.Status FROM `fitnesslesson_timetable` ft
JOIN fitnesslesson fl ON ft.FL_ID=fl.Id
LEFT JOIN booked_lesson bl ON bl.FL_TT_ID=ft.Id";

$result=$conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){  
        ?>
<tr>
    <td>
        <?php echo $row["Id"] ?>
    </td>
    <td>
        <?php echo $row["Name"] ?>
    </td>
    <td>
        <?php echo $row["Day"] ?>
    </td>
    <td>
        <?php echo $row["LessonDate"] ?>
    </td>
    <td>
        <?php echo $row["StartTime"] ?>
    </td>
    <td>
     <?php echo $row["EndTime"] ?>
    </td>
    <td>
        <?php 
            if($row["Status"] == null) {
                echo "Aavailable";
            } else {
                echo $row["Status"];
            }
        ?>
    </td>
   <td>

   <?php if ($row["Status"] == null || $row["Status"] == "Cancelled"): ?>
    <button class="btn btn-primary" onclick="BookMe(<?php echo $row['Id'] ?>, <?php echo $customerId ?>)">
        Book
    </button>
<?php endif ?>

<?php if ($row["Status"] == "Booked"): ?>
    <button class="btn btn-primary" onclick="Attend(<?php echo $row['Id'] ?>, <?php echo $customerId ?>)">
        Attend
    </button>
    <button class="btn btn-primary" onclick="Cancel(<?php echo $row['Id'] ?>, <?php echo $customerId ?>)">
        Cancel
    </button>
<?php endif ?>

    <a href="lesson_detail.php?id=<?php echo $row['LessonId'] ?>&name=<?php echo $row['Name'] ?>">Feedback</a>

    </td>
    </tr>
    
    <?php
    }
}

?>
</table>

<?php require 'footer.php'; ?>