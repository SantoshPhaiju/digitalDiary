<?php require_once 'header.php'; ?>

<?php

require_once './db/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$entryId = $_GET['id'] ?? null;
$errorMessage;
if ($_GET['error']) {
    $errorMessage = "<div class='alert error'>" . htmlspecialchars($_GET['error']) . "</div>";
}

$entry;

if ($entryId && is_numeric($entryId)) {
    $stmt = $conn->prepare("SELECT * FROM diary WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $entryId, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $errorMessage = "<div class='alert error'> No entry found with this id! </div>";
    } else {
        $entry = $result->fetch_assoc();
    }
} else {
    $errorMessage = "<div class='alert error'> Invalid entry id! </div>";
}




?>





<main>
    <div class="mainHeading">
        <h1>Update your diary entry</h1>
    </div>


    <?php if ($result->num_rows > 0): ?>
        <div class="formContainer">
            <?php if (isset($errorMessage) && !empty($errorMessage))
                echo $errorMessage; ?>
            <form method="POST" action="save-updated-entry.php?id=<?php echo $entryId; ?>">
                <div class="formGroup">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" placeholder="Update your title"
                        value="<?php echo $entry['title'] ?>" required>
                </div>

                <div class="formGroup">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" rows="8" placeholder="Write your diary entry..."
                        required><?php echo $entry['content'] ?></textarea>
                </div>

                <button class="saveEntryButton" type="submit">Save Entry</button>
            </form>
        </div>
    <?php else: ?>
        <div class="errorContainer">
            <?php if (isset($errorMessage))
                echo $errorMessage; ?>
        </div>
    <?php endif; ?>
</main>







<?php require_once './footer.php'; ?>