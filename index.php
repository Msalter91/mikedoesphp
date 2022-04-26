<?php

require 'includes/init.php';
$conn = require 'includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 4, Article::getTotal($conn)); // null coalessence operator
// if $_GET['page'] is null use 1, else use $_GET['page']

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset) // Calling on the static method (therefore no need 
// for to create a new Article object)

?>


<?php require('includes/header.php'); ?>
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

<?php require 'includes/pagination.php' ?>
        <?php endif; ?>
<?php require 'includes/footer.php'; ?>
