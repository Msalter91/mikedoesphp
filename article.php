<?php

require 'classes/Article.php';
require 'classes/Database.php';

$db = new Database();
$conn = $db->getConn();

// if(isset($_GET['id'])) {
//     $article = getArticle($conn, $_GET['id']);
// } else {
//     $article = null;
// }

$article = Article::getByID($conn, $_GET['id'])


?>
<?php require('includes/header.php'); ?>
        <?php if($article): ?>
            <article>
                <h2><?= htmlspecialchars($article->title); ?></h2>
                    <p><?= htmlspecialchars($article->content); ?></p>
                </article>

                <a href="edit_article.php?id=<?= $article->id ?>"> Edit me </a>
                <br>
                <a href="delete_article.php?id=<?= $article->id ?>"> Delete me </a>
        <?php else: ?>
            <p>Article not found</p>
        <?php endif; ?>
<?php require('includes/footer.php'); ?>
