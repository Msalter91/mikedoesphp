<?php 

require 'includes/init.php';

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

    
            // $sql = "DELETE FROM article
            //         WHERE id = :id"; 
    
            //  $stmt = mysqli_prepare($conn, $sql);
    
            //  if ($stmt === false) {
    
            //     echo mysqli_error($conn);
            // } else     
            //     mysqli_stmt_bind_param($stmt, "i", $id); * Old Proceedural style for delete 

            
        $article->delete($conn);

        Url::redirect("/mikedoesphp/index.php");
                    
} 
?>

<?php require 'includes/header.php'; ?>

<h2>Delete Article</h2>

<form method="post">
    <button>Delete me</button>
    <a href="article.php?id=<?=$article->id ?>">Cancel</a>
</form>

