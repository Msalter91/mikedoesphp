<?php

require '../includes/init.php';
Auth::requireLogin();
$conn = require '../includes/db.php';

if(isset($_GET['id'])) {

    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}


?>
<?php require('../includes/header.php'); ?>
        <?php if($article): ?>
            <article>
                <h2><?= htmlspecialchars($article[0]['title']); ?></h2>
                <?php if($article[0]['category_name']): ?>
                    <p> categories:
                        <?php foreach ($article as $a) : ?>
                            <?= $a['category_name'] ?>
                        <?php endforeach; ?>
                    </p>
                <?php endif; ?>
                <?php if($article[0]['image_file']): ?>
                    <img alt="Image for the article" src="uploads/<?=$article[0]['image_file']?>">
                <?php endif; ?>
                    <p><?= htmlspecialchars($article[0]['content']); ?></p>
                </article>

                <a href="edit_article.php?id=<?= $article[0]['id'] ?>"> Edit me </a>
                <br>
                <a href="edit_article_image.php?id=<?= $article[0]['id'] ?>"> Edit image</a>
                <br>
                <a href="delete_article.php?id=<?= $article[0]['id'] ?>"> Delete me </a>
        <?php else: ?>
            <p>Article not found</p>
        <?php endif; ?>
<?php require('../includes/footer.php'); ?>
