<?php require'header.php'?>

<h2>Booked lesson</h2>
<table class="table"> 
<thead>
        <th>
            Id
</th>
<th>
    Booking ID
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

</thead>


<?php 


require 'includes/database.php';
$conn=getDB();

$customerId= $_SESSION['customerId'];

$sql = "SELECT ft.Id, bl.Id as BookingId, fl.Name, ft.Day, ft.LessonDate, ft.StartTime, ft.EndTime FROM `fitnesslesson_timetable` ft INNER JOIN fitnesslesson FL ON FT.FL_ID=FL.Id INNER JOIN
booked_lesson bl ON bl.FL_TT_ID=ft.Id where bl.C_ID=$customerId AND bl.Status='Booked' || bl.Status='Changed' ";

$result=$conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){  
        ?>
<tr>
    <td>
        <?php echo $row["Id"] ?>
    </td>
    <td>
        <?php echo $row["BookingId"] ?>
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
    </td>
    </tr>
        <?php
    }
}

?>
</table>

<div>
    <span>Booking Id<span>
        <input type="number" name="BookingId"  id="BookingId" />
        <button id="Attend" onClick="Attend()">Attend </button>
</div>

<div>
    <span> Feedback </span > 
    <input type="text" name="Feedback"  id="FeedbackId" />
</div>
<div>
    <span> Rating </span > 
    
    <label for="Rating">Rating:</label>

<select name="Rating" id="RatingId">
  <option value="5">Excellent</option>
  <option value="4">Very good</option>
  <option value="3">Good</option>
  <option value="2">Satisfactory</option>
  <option value="1">Poor</option>
</select>
</div>
<button onClick="submitFeedback()"> Submit </button>
</body>
</head>
    </html>


<?php require 'footer.php'; ?>
