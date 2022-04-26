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

        $previousFile = $article->image_file;

            if($article->setImageField($conn, NULL)){

                if($previousFile){
                    unlink("../uploads/${previousFile}");
                }
                URL::redirect("/mikedoesphp/admin/edit_article_image.php?id={$article->id}");
            }

    }
    
?>

<h2>Delete Article Image</h2>

<?php require '../includes/header.php';?>

<?php if($article->image_file): ?>
    <img alt="Image for the article" src="../uploads/<?=$article->image_file?>">
<?php endif; ?>

<form method="post">
    <p>Are you sure you want to delete this image?</p>

    <button>Delete</button>
    <a href="/mikedoesphp/admin/edit_article_image.php?id=<?=$article->id?>">Cancel</a>

</form>

<?php require '../includes/footer.php'; ?>