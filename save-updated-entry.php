<?php

require_once './db/db.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $entryId = $_GET['id'] ?? null;
    $userId = $_SESSION['user_id'];

    if ($entryId && is_numeric($entryId)) {
        if (empty($title) || empty($content)) {
            header("Location: edit-entry.php?id=$entryId&error=Please fill all the required details");
        } else {
            $stmt = $conn->prepare("UPDATE diary SET title = ?, content = ? WHERE id = ? AND user_id = ?");
            $stmt->bind_param("ssii", $title, $content, $entryId, $userId);
            if ($stmt->execute()) {
                header("Location: view-entry.php?id=$entryId");
                exit();
            } else {
                header("Location: edit-entry.php?id=$entryId&error=Error updating entry. Please try again.");
            }
        }

    } else {
        header("Location: index.php");
    }

}