<?php 

require '../includes/init.php';

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
            
        $article->delete($conn);

        Url::redirect("/mikedoesphp/admin/index.php");
                    
} 
?>

<?php require '../includes/header.php'; ?>

<h2>Delete Article</h2>

<form method="post">
    <button class="deleteButton">Delete me</button>
    <a href="article.php?id=<?=$article->id ?>">Cancel</a>
</form>

