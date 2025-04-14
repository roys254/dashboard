<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_user'])) {
    $newUser = $_POST['new_username'];
    $newPass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindValue(':username', $newUser, SQLITE3_TEXT);
    $stmt->bindValue(':password', $newPass, SQLITE3_TEXT);
    $stmt->execute();
}
$users = $db->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-gray-800 rounded-lg">
        <h1 class="text-xl mb-4">User Management</h1>
        <form method="POST" class="mb-4">
            <div class="flex space-x-2">
                <input type="text" name="new_username" placeholder="Username" class="p-2 rounded bg-gray-700" required />
                <input type="password" name="new_password" placeholder="Password" class="p-2 rounded bg-gray-700" required />
                <button name="new_user" class="bg-green-600 px-4 py-2 rounded">Add User</button>
            </div>
        </form>
        <h2 class="text-lg mb-2">Existing Users:</h2>
        <ul class="space-y-2">
        <?php while ($row = $users->fetchArray(SQLITE3_ASSOC)): ?>
            <li class="bg-gray-700 p-2 rounded"><?= htmlspecialchars($row['username']) ?></li>
        <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>