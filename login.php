<?php
session_start();
require_once 'db.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
    if ($result && password_verify($password, $result['password'])) {
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="max-w-md mx-auto mt-20 p-6 bg-gray-800 rounded-lg">
        <h1 class="text-2xl mb-4">Login</h1>
        <?php if ($error): ?>
            <p class="text-red-500 mb-2"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" class="w-full mb-2 p-2 rounded bg-gray-700" required />
            <input type="password" name="password" placeholder="Password" class="w-full mb-2 p-2 rounded bg-gray-700" required />
            <button class="bg-blue-600 px-4 py-2 rounded w-full">Login</button>
        </form>
    </div>
</body>
</html>