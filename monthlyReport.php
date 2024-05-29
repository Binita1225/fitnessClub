<?php require'header.php'?>

<h2>All Fitness Lesson</h2>
<table class="table"> 
<thead>
        <th>
           Lesson Id
</th>
<th>
    Lesson Name
</th>
<th>
    Date
</th>
<th>
    Day
</th>
<th>
    Start Time
</th>
<th>
    End Time
</th>
<th>
    Customer
</th>
<th>
    Status
</th>
</thead>


<?php 

require 'includes/database.php';
$conn=getDB();

$customerId= $_SESSION['customerId'];


$sql = "SELECT ft.Id as LessonID, fl.Name, ft.LessonDate, ft.Day, ft.StartTime, ft.EndTime, cs.FullName as customer, bl.Status FROM fitnesslesson_timetable ft 
INNER JOIN fitnesslesson fl on ft.FL_ID=fl.Id 
LEFT JOIN booked_lesson bl on ft.Id=bl.FL_TT_ID 
LEFT JOIN customer cs ON cs.Id=bl.C_ID";

$result=$conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){  
        ?>
<tr>
    <td>
        <?php echo $row["LessonID"] ?>
    </td>
    <td>
        <?php echo $row["Name"] ?>
    </td>
    <td>
        <?php echo $row["LessonDate"] ?>
    </td>
    <td>
        <?php echo $row["Day"] ?>
    </td>
    <td>
        <?php echo $row["StartTime"] ?>
    </td>
    <td>
        <?php echo $row["EndTime"] ?>
    </td>
    <td>
     <?php if(!isset($row["customer"])||empty($row["customer"]))
     {
        echo "Available";
     }else{
        echo $row["customer"];
     }
     ?>
    </td>
   <td>
   <?php if(!isset($row["Status"])||empty($row["Status"]))
     {
        echo "Available";
     }else{
        echo $row["Status"];
     } ?>
    </td>
    </tr>
        <?php
    }
}

?>
</table>
<?php require 'footer.php'; ?>
