<?php 

require 'classes/Database.php';
require 'classes/Article.php';
require 'includes/url.php';

$db = new Database();
$conn = $db->getConn();

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
           redirect("/mikedoesphp/article.php?id={$article->id}");
       }
    }

?>

<h2>Edit Article</h2>

<?php require 'includes/header.php';?>

<?php require 'includes/article_form.php'; ?>

<?php require 'includes/footer.php'; ?>