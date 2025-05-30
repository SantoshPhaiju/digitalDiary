<?php require_once 'header.php'; ?>
<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
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
        <div class="diaryEntry">
            <div>
                Wednesday, 18 October 2023
            </div>
            <h2>
                Today was a good day!
            </h2>
            <div class="content">
                Today I learned about PHP and how to create a simple web application. I also went for a walk in the park
                and enjoyed the beautiful weather. It was a refreshing da...
            </div>
            <button>
                <a href="#">See More</a>
            </button>
            <button>
                <a href="#">Edit</a>
            </button>
            <button>
                <a href="#">Delete</a>
            </button>

        </div>
        <div class="diaryEntry">
            <div>
                Wednesday, 18 October 2023
            </div>
            <h2>
                Today was a good day!
            </h2>
            <div class="content">
                Today I learned about PHP and how to create a simple web application. I also went for a walk in the park
                and enjoyed the beautiful weather. It was a refreshing da...
            </div>
            <button>
                <a href="#">See More</a>
            </button>
            <button>
                <a href="#">Edit</a>
            </button>
            <button>
                <a href="#">Delete</a>
            </button>

        </div>
    </div>


</main>


<?php require_once 'footer.php'; ?>