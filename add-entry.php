<?php
require_once 'header.php';
require_once './db/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>


<main>
    <div class="mainHeading">
        <h1>Add New Diary Entry</h1>
    </div>

    <div class="formContainer">
        <form method="POST" action="save_entry.php">
            <div class="formGroup">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Today's Mood" required>
            </div>

            <div class="formGroup">
                <label for="content">Content</label>
                <textarea id="content" name="content" rows="8" placeholder="Write your diary entry..."
                    required></textarea>
            </div>

            <button class="saveEntryButton" type="submit">Save Entry</button>
        </form>
    </div>
</main>





<?php
require_once './footer.php';
?>