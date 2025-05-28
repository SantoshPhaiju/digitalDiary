<?php require_once 'header.php'; ?>



<main class="registerPage">
    <div class="registerContainer">

        <h1>Create an Account</h1>

        <form method="post" action="register.php">
            <div class="formGroup">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="formGroup">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="formGroup">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="formGroup">
                <label for="password">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <button type="submit">Login</button>
        </form>

    </div>

</main>




<?php require_once 'footer.php'; ?>