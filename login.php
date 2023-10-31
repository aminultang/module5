<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $users = file('data/users.txt');
    foreach ($users as $user) {
        list($username, $storedEmail, $storedPassword, $role) = explode('|', trim($user));
        
        if ($email === $storedEmail && password_verify($password, $storedPassword)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            header('Location: index.php');
            exit;
        }
    }
    
    $message = 'Invalid credentials!';
}
?>

<link rel="stylesheet" href="css/styles.css">
<div class="container">
    <form action="login.php" method="post">
        <?php if ($message): ?>
            <p style="color: red;"><?php echo $message; ?></p>
        <?php endif; ?>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Login">
        </div>
    </form>
	<a href="register.php">Create an Account</a>
	<p>User: admin@example.com
	passwor: 123456</p>
</div>
