<?php require_once 'header.php'; ?>
<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once './db/db.php';

$stmt = $conn->prepare("SELECT * FROM diary WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    $errorMessage = "<div class='alert error'> No diary entries found. </div>";
} else {
    $entries = $result->fetch_all(MYSQLI_ASSOC);
}
if (isset($errorMessage)) {
    echo $errorMessage;
}


?>

<main>

    <div class="mainHeading">
        <h1>
            Welcome to My Digital Diary!
        </h1>
        <button onclick="location.href='add-entry.php'">
            + Add New Entry
        </button>
    </div>

    <div class="myContents">

        <?php if (isset($errorMessage))
            echo $errorMessage; ?>
        <?php if (isset($entries) && count($entries) > 0): ?>
            <?php foreach ($entries as $entry): ?>
                <div class="diaryEntry">
                    <div>
                        <?php echo date("l, d F Y", strtotime($entry['created_at'])); ?>
                    </div>
                    <h2>
                        <?php echo htmlspecialchars($entry['title']); ?>
                    </h2>
                    <div class="content">
                        <?php echo htmlspecialchars(substr($entry['content'], 0, 100)) . '...'; ?>
                    </div>
                    <button>
                        <a href="view-entry.php?id=<?php echo $entry['id']; ?>">See More</a>
                    </button>
                    <button>
                        <a href="edit-entry.php?id=<?php echo $entry['id']; ?>">Edit</a>
                    </button>
                    <button>
                        <a href="delete-entry.php?id=<?php echo $entry['id']; ?>">Delete</a>
                    </button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert info">
                No diary entries found. Start by adding a new entry!
            </div>
        <?php endif; ?>

    </div>


</main>


<?php require_once 'footer.php'; ?>