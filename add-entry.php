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
        Add Entry Page
    </div>
</main>





<?php
require_once './footer.php';
?>