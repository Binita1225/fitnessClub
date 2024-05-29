<?php require'header.php'?>

<div class="background-image">
<div class="loginContainer">
<div id="loginsignupCard">
        <div id="sideCard">
            <p>Join Fitness Club today</p>
            <a href="usersignup.php">Sign Up</a>
        </div>
    <div id="fields">
        
    <form action="LoginProcess.php" method="post" class="form" id="login-form">
    <div>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
    </div><br>

    <button type="submit">Login</button><br>

</form>
</div>
</div>
</div>
</div>

<?php require 'footer.php'; ?>
<!-- class='signupA'  -->