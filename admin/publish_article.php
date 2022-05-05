<?php

require '../includes/init.php';

AUTH::requireLogin();

$conn = require '../includes/db.php';

$article = Article::getByID($conn, $_POST['id']);

$published_at = $article->publishArticle($conn);

?>

<time><?= $published_at ?></time>