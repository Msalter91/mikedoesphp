<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

//$conn = getDB(); // Database connection replaced with method from newly created object

// $db = new Database();
// $conn = $db -> getConn();

$paginator = new Paginator($_GET['page'] ?? 1, 6, Article::getTotal($conn)); // null coalessence operator
// if $_GET['page'] is null use 1, else use $_GET['page']

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset); // Calling on the static method (therefore no need 
// for to create a new Article object)

?>


<?php require('../includes/header.php'); ?>
        <?php if(empty($articles)): ?>
            <p>No articles found</p>
        <?php else: ?>
            <h2>Administration</h2>
            <p><a href="new_article.php">New Article</a></p>
            <table>
                <thead>
                    <th>Title</th>
                </thead>
                <tbody>
                  <?php foreach ($articles as $article): ?>
                    <tr>
                        <td>
                            <a href="article.php?id=<?=$article['id']?>">
                            <?= htmlspecialchars($article['title']); ?></a>
                        </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
<?php include'../includes/pagination.php'; ?>
        <?php endif; ?>
<?php require('../includes/footer.php'); ?> 
