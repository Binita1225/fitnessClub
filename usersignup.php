<?php require'header.php'?>

<div class="background-image">
<div class="loginContainer">
  <div id="loginsignupCard">
        <div id="sideCard">
            <p>Have an account</p>
            <a href="userlogin.php">Login</a>
        </div>

    <div id="fields">
    <div class="form">
        <div>
            <label for="fname">Full Name:</label>
            <input type="text" name="fname" id="fname">
        </div>
        <div>
            <label for="address">Address:</label>
            <input type="text" name="address" id="address">
        </div>
        <div>
            <label for="email">Email / Username:</label>
            <input type="text" name="email" id="email">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" name="confirmPassword" id="confirmPassword">
        </div>
    <br>
    <button onclick="SignUp()">Sign Up</button>
</div>
</div>
</div>
</div>
</div>

<?php require 'footer.php'; ?>