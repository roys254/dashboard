<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new SQLite3("includes/database.db");
    $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
    $stmt->bindValue(":email", $_POST["email"]);
    $stmt->bindValue(":password", $_POST["password"]);
    $stmt->execute();
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html class="bg-gray-900 text-white">
<head><title>Signup</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="flex items-center justify-center h-screen">
<div class="bg-gray-800 p-6 rounded shadow-md w-80">
<h2 class="text-2xl font-bold mb-4">Sign Up</h2>
<form method="POST">
<input name="email" placeholder="Email" class="w-full mb-2 p-2 bg-gray-700 rounded" />
<input type="password" name="password" placeholder="Password" class="w-full mb-4 p-2 bg-gray-700 rounded" />
<button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Sign Up</button>
</form>
</div></body></html>