<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';  // default role for new registration
    
    $userData = "$username|$email|$password|$role\n";
    
    file_put_contents('data/users.txt', $userData, FILE_APPEND);
    header('Location: login.php');
}
?>

<link rel="stylesheet" href="css/styles.css">
<div class="container">
    <form action="register.php" method="post">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Register">
        </div>
    </form>
</div>
