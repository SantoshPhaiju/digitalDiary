<?php require_once 'header.php'; ?>



<main class="loginPage">
    <div class="loginContainer">

        <h1>Login to My Digital Diary</h1>

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