<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="jquery-3.7.0.min.js"  crossorigin="anonymous"></script>
<script src="main.js"  crossorigin="anonymous"></script>

<body>

<header>
    <div class="container">
      <div class="logo" id="logo">
        <img src="img/fitnesslogo.svg" alt="logo">
      </div>
      <div class="user-profile">
      <?php
        session_start();

        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
            
          // User is logged in
            $fullname = $_SESSION['fullname'];
        
            // Display the user profile area
            echo "Welcome, $fullname!"; // Customize this to your needs
            // echo '<a href="/logout.php">Logout</a>'; // Add a logout link/button if needed
            // echo '<img src="img/userlogo.svg" alt="userprofile" id="userprofile">';
        }
        else {
          echo '<a class="headerA" href="userlogin.php">Login</a> ';
          // echo '<a class="headerA" href="usersignup.php">Sign Up</a>';
        } 
       
        ?>
        
      </div>
      
      <?php
      if(isset($_SESSION['customerId']) && isset($_SESSION['username'])){
        $username =$_SESSION['username'];

     if(strcmp($username,"Admin")!=0){
      echo '
      <div>
      <a class="headerA" href="location.php">Location</a>
    </div>
      <div>
      <a class="headerA" href="bookLesson.php">Book Lesson</a>
    </div>
    <div>
      <a class="headerA" href="cancelUpdate.php">Cancel/Update Lesson</a>
    </div>
    <div>
      <a class="headerA" href="attendLesson.php">Attend Lesson</a>
    </div>';
     }
    } 
    if(isset($_SESSION['loggedIn']) || isset($_SESSION['username']) && $_SESSION['username']=="Admin") {
      echo '<div>
      <a class="headerA" href="logout.php">Logout</a>
      </div>';
     
    }
      ?>
      <div>
      <a class="headerA" href="aboutus.php">About Us</a>
    </div>
    <?php
        if(isset($_SESSION['username']) && $_SESSION['username']=="Admin"){
          
          echo '<div>
          <a class="headerA" href="admin.php">Admin Panel</a>
          </div>';
          echo '<div><a class="headerA" href="monthlyReport.php">Monthly Report</a></div>';
        }
        ?>
    </div>
  </header>