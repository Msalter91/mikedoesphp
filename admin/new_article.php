<?php 

require '../includes/init.php';
$conn = require '../includes/db.php';

$article = new Article();

Auth::requireLogin();

$category_ids = [];
$categories = Category::getAll($conn);

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    $category_ids = $_POST['category'] ?? [];

    if($article->create($conn)) {

        $article->setCategories($conn, $category_ids);

        Url::redirect("/mikedoesphp/admin/article.php?id={$article->id}");

    }
}
?>

<h2>New Article</h2>

<?php require '../includes/header.php';?>

<?php require 'includes/article_form.php'; ?>

<?php require '../includes/footer.php'; ?>