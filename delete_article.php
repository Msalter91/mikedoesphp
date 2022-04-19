<?php 

require 'includes/database.php';
require 'includes/article.php';
require 'includes/url.php';

$conn = getDB();

if(isset($_GET['id'])) {

    $article = getArticle($conn, $_GET['id'], 'id');

} else {

    die("id not supplied, article not found");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    
            $sql = "DELETE FROM article
                    WHERE id = ?"; 
    
             $stmt = mysqli_prepare($conn, $sql);
    
             if ($stmt === false) {
    
                echo mysqli_error($conn);
    
            } else {
    
                mysqli_stmt_bind_param($stmt, "i", $id);
    
                if (mysqli_stmt_execute($stmt)) {

                    redirect("/mikedoesphp/homepage.php");
                    
                } else {
    
                    echo mysqli_stmt_error($stmt);
    
                }
            }
        } 
?>

<?php require 'includes/header.php'; ?>

<h2>Delete Article</h2>

<form method="post">
    <button>Delete me</button>
    <a href="article.php?id=<?=$article['id']?>">Cancel</a>
</form>

