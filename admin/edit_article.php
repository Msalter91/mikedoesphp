<?php 

require '../includes/init.php';
Auth::requireLogin();
$conn = require '../includes/db.php';

Auth::requireLogin();

if(isset($_GET['id'])) {
    $article = Article::getByID($conn, $_GET['id']);
    if(! $article) {
        die("article not found");
    } 
} else {

    die("id not suplied, article not found");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

       if($article->update($conn)) {
           Url::redirect("/mikedoesphp/admin/article.php?id={$article->id}");
       }
    }

?>

<h2>Edit Article</h2>

<?php require '../includes/header.php';?>

<?php require 'includes/article_form.php'; ?>

<?php require '../includes/footer.php'; ?>