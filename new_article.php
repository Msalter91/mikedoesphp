<?php 

require 'includes/init.php';

$article = new Article();

if( !Auth::isLoggedIn()) {

    die('unauthorized');

}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $db = new Database();
    $conn = $db->getConn();

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    if($article->create($conn)) {

        Url::redirect("/mikedoesphp/article.php?id={$article->id}");

    }
}
?>

<h2>New Article</h2>

<?php require 'includes/header.php';?>

<?php require 'includes/article_form.php'; ?>

<?php require 'includes/footer.php'; ?>