<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

$message = '';

// Implement role changing logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetEmail = $_POST['targetEmail'];
    $newRole = $_POST['newRole'];

    $users = file('data/users.txt');
    $updatedUsers = [];

    $userUpdated = false;

    foreach ($users as $user) {
        list($username, $storedEmail, $storedPassword, $role) = explode('|', trim($user));
        if ($storedEmail === $targetEmail) {
            $updatedUsers[] = "$username|$storedEmail|$storedPassword|$newRole<br>";
            $userUpdated = true;
        } else {
            $updatedUsers[] = $user;
        }
    }

    if ($userUpdated) {
        file_put_contents('data/users.txt', $updatedUsers);
        $message = 'User role updated successfully!';
    } else {
        $message = 'User not found!';
    }
}

$users = file('data/users.txt');
?>

<link rel="stylesheet" href="css/styles.css">
<div class="container">
    <h2>Role Management</h2>
    <form action="role_management.php" method="post">
        <div class="form-group">
            <label>Email of user to change role:</label>
            <input type="email" name="targetEmail" required>
        </div>
        <div class="form-group">
            <label>New Role:</label>
            <select name="newRole">
                <option value="user">User</option>
                <option value="manager">Manager</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Update Role">
        </div>
    </form>

    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <h3>Current Users and Roles</h3>
    <ul>
        <?php 
        foreach ($users as $user) {
            list($username, $email, , $role) = explode('|', trim($user));
            echo "<li>$username ($email) - Role: $role</li>";
        }
        ?>
    </ul>
	<a href="index.php">Deshboard</a>
</div>
