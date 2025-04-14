<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';
echo "<h1 class='text-center mt-10 text-2xl'>Welcome, " . htmlspecialchars($_SESSION['username']) . "</h1>";
echo "<a href='logout.php' class='mt-4 inline-block text-blue-600 underline'>Logout</a>";
?>