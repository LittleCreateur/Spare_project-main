<?php
// header.php - Boilerplate Header Template
echo "/* Boilerplate Header Template */\n";
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set default timezone
date_default_timezone_set('UTC');

// Set content type
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'My PHP Site'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add your CSS files here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><?php echo isset($siteName) ? htmlspecialchars($siteName) : 'Welcome to My Site'; ?></h1>
        <!-- Navigation bar example -->
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about.php">About</a></li>
                <li><a href="/contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
<!-- Page content starts here -->