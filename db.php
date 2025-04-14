<?php
try {
    $db = new SQLite3(__DIR__ . '/database.sqlite');
} catch (Exception $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>