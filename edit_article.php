<?php 

require 'includes/database.php';
require 'includes/article.php';
require 'includes/url.php';

$conn = getDB();

if(isset($_GET['id'])) {
    $article = getArticle($conn, $_GET['id']);
    if($article) {
        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
        $id = $article['id'];
    } else {
        die("article not found");
    }

} else {

    die("id not suplied, article not found");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    if(empty($errors)) {
        if(empty($errors)) {
    
            $sql = "UPDATE article
                    SET title = ?, 
                        content = ?, 
                        published_at = ? 
                    WHERE id = ?"; 
    
             $stmt = mysqli_prepare($conn, $sql);
    
             if ($stmt === false) {
    
                echo mysqli_error($conn);
    
            } else {
    
                if ($published_at == '') {
                    $published_at = null;
                }
    
                mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $id);
    
                if (mysqli_stmt_execute($stmt)) {
    
                    echo "Inserted record with ID: $id";

                    redirect("/mikedoesphp/article.php?id=$id");
                    
                } else {
    
                    echo mysqli_stmt_error($stmt);
    
                }
            }
        } 
    }
}

?>

<h2>Edit Article</h2>

<?php require 'includes/header.php';?>

<?php require 'includes/article_form.php'; ?>

<?php require 'includes/footer.php'; ?>