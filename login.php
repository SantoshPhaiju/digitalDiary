<?php require_once 'header.php'; ?>

<?php

require_once './db/db.php';
$errorMessage = "";

session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $errorMessage = "<div class='alert error'>Please fill in all fields.</div>";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                header("Location: index.php");
                exit();
            } else {
                $errorMessage = "<div class='alert error'>Invalid username or password.</div>";
            }
        } else {
            $errorMessage = "<div class='alert error'>Invalid username or password.</div>";
        }

        $stmt->close();
    }
}

?>



<main class="loginPage">
    <div class="loginContainer">

        <?php if (!empty($errorMessage))
            echo $errorMessage; ?>

        <h1>Login</h1>

        <form method="post" action="login.php">
            <div class="formGroup">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="formGroup">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>

    </div>

</main>




<?php require_once 'footer.php'; ?>