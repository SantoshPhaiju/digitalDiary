<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Digital Diary</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/register.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <div class="buttons">
                <button>
                    <a href="login.php">Login</a>
                </button>
                <button>
                    <a href="register.php">Register</a>
                </button>
            </div>
        <?php else: ?>
            <div class="contentsDiv">
                <div class="welcomeMessage">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</div>
                <div class="buttons">
                    <button>
                        <a href="logout.php">Logout</a>
                    </button>
                </div>
            </div>
        <?php endif; ?>

    </header>