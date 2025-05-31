<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

require_once './db/db.php';

$entryId = $_GET['id'];

if (is_numeric($entryId)) {
    $stmt = $conn->prepare("DELETE FROM diary WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $entryId, $_SESSION['user_id']);
    if ($stmt->execute()) {
        header("Location: index.php");
    }
}




