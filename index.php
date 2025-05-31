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


    <?php if (isset($errorMessage))
        echo $errorMessage; ?>
    <div class="myContents">
        <?php foreach ($entries as $entry): ?>
            <div class="diaryEntry">
                <div>
                    <?php echo date("l, d F Y", strtotime($entry['timestamp'])); ?>
                </div>
                <h2>
                    <?php echo htmlspecialchars($entry['title']); ?>
                </h2>
                <div class="content">
                    <?php
                    $content = $entry['content'];
                    echo htmlspecialchars(substr($content, 0, 200));
                    if (strlen($content) > 200) {
                        echo '...';
                    }
                    ?>
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
    </div>


</main>


<?php require_once 'footer.php'; ?>