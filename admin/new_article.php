<?php 

require '../includes/init.php';

$article = new Article();

Auth::requireLogin();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = require '../includes/db.php';

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    if($article->create($conn)) {

        Url::redirect("/mikedoesphp/admin/article.php?id={$article->id}");

    }
}
?>

<h2>New Article</h2>

<?php require '../includes/header.php';?>

<?php require 'includes/article_form.php'; ?>

<?php require '../includes/footer.php'; ?>