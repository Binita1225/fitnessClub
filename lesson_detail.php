<?php
 require'header.php';

  $lessonId = isset($_GET['id']) ? $_GET['id'] : null;
  $name = isset($_GET['name']) ? $_GET['name'] : null;
  ?>
    
  <hr>
  <p>Ratings and Reviews</p>

  <?php 
require 'includes/database.php';
$conn=getDB();

$sql = "SELECT fl.Id, fl.Name, cr.Comment as Review, r.DisplayName as Rating FROM fitnesslesson fl INNER JOIN fitnesslesson_timetable ft ON fl.Id=ft.FL_ID 
INNER JOIN booked_lesson bl ON bl.FL_TT_ID=ft.Id 
INNER JOIN customer_review cr ON cr.B_ID=bl.Id 
INNER JOIN rating r ON r.Id=cr.R_ID 
where fl.Id=$lessonId";

$result=$conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
?>
<table class="table"> 
<thead>
  <th>
    Id
</th>
<th>
    Name
</th>
<th>
    Review
</th>
<th>
    Rating
</th>
</thead>

<tr>
  <td>
  <?php echo $row["Id"] ?>
  </td>
  <td>
  <?php echo $row["Name"] ?>
  </td>
  <td>
  <?php echo $row["Review"] ?>
  </td>
  <td>
  <?php echo $row["Rating"] ?>
  </td>
  </tr>
  
  <?php
  }
  ?>
  </table>
  <?php
} else {
  echo "0 results";
}
?>