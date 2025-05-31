<?php
require_once 'header.php';
require_once './db/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $userId = $_SESSION['user_id'];

    if (empty($title) || empty($content)) {
        $errorMessage = "<div class='alert error'> Please fill all the required details </div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO diary (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userId, $title, $content);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $errorMessage = "<div class='alert error'> Error saving entry. Please try again. </div>";
        }
    }
}

?>


<main>
    <div class="mainHeading">
        <h1>Add New Diary Entry</h1>
    </div>

    <div class="formContainer">
        <?php if (isset($errorMessage))
            echo $errorMessage; ?>
        <form method="POST" action="add-entry.php">
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