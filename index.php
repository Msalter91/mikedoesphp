<?php

require 'includes/init.php';

//$conn = getDB(); // Database connection replaced with method from newly created object

$db = new Database();
$conn = $db -> getConn();

$articles = Article::getAll($conn) // Calling on the static method (therefore no need 
// for to create a new Article object)

?>


<?php require('includes/header.php'); ?>
<?php if(Auth::isLoggedIn()): ?>
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
