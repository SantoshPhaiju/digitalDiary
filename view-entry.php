<?php require_once 'header.php'; ?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once './db/db.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $entryId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM diary WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $entryId, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $errorMessage = "<div class='alert error'> No diary entry found. </div>";
    } else {
        $entry = $result->fetch_assoc();
    }
} else {
    $errorMessage = "<div class='alert error'> Invalid entry ID. </div>";
}
if (isset($errorMessage)) {
    echo $errorMessage;
} else {
    ?>
    <main>
        <div class="mainHeading">
            <h1><?php echo htmlspecialchars($entry['title']); ?></h1>
            <p><?php echo date("l, d F Y", strtotime($entry['timestamp'])); ?></p>
        </div>

        <div class="entryContent">
            <p><?php echo nl2br(htmlspecialchars($entry['content'])); ?></p>
        </div>

        <div class="entryActions">
            <button
                style="border: 1px solid black; margin-top: 80px; font-size: 16px; padding: 8px 16px; border-radius: 8px; text-decoration: none;"><a
                    href="index.php" style="text-decoration: none;">Back to Entries</a></button>
        </div>
    </main>

    <?php
}

?>

<?php require_once 'footer.php'; ?>