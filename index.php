<html>
<head>
<link rel="stylesheet" href="css/styles.css">
</head>
<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['role'] === 'admin') {
    echo "<h2>Welcome, Admin!</h2><a href='role_management.php'>Manage Roles</a>";
} elseif ($_SESSION['role'] === 'manager') {
    echo "<h2>Welcome, Manager!</h2>";
} else {
    echo "<h2>Welcome, User!</h2>";
}
?>

<a href="logout.php">Logout</a>
</html>