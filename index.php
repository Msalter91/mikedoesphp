<?php

session_start();

include('includes/database.php');
include 'includes/auth.php';

$conn = getDB();

$sql = "SELECT * 
        FROM article
        ORDER BY published_at;";

$results = mysqli_query($conn, $sql);

if($results === false) {
    echo mysqli_error($conn);
} else {
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
?>
<?php require('includes/header.php'); ?>
<?php if(isLoggedIn()): ?>
    <p>You are logged in </p><a href="logout.php">Logout</a>
    <p><a href="new_article.php">New Article</a></p>
<?php else: ?>
    <p>You are logged out</p>
    <a href="login.php">Login</a>
<?php endif; ?>
        <?php if(empty($articles)): ?>
            <p>No articles found</p>
        <?php else: ?>
            <ul>
                <?php foreach ($articles as $article): ?>
                    <li>
                        <article>
                            <a href="article.php?id=<?=$article['id']?>"><h2><?= htmlspecialchars($article['title']); ?></h2></a>
                            <p><?= htmlspecialchars($article['content']); ?></p>
                        </article>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
<?php require('includes/footer.php'); ?>
