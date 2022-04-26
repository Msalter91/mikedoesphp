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

    $image = new ImageUpload();

    try {
        // if(empty($_FILES)){
        //     throw new Exception('Invalid upload');
        // }
        // switch($_FILES['file']['error']) {
        //     case UPLOAD_ERR_OK:
        //         break;
        //     case UPLOAD_ERR_NO_FILE:
        //         throw new Exception('No file uploaded');
        //         break;
        //     case UPLOAD_ERR_INI_SIZE:
        //         throw new Exception('File is too large');
        //     default: 
        //         throw new Exception('An error occured');
        // }
        // if($_FILES['file']['size'] > 1000000) {
        //     throw new Exception('File is too large');
        // }

        $image->validateUpload();
        $image->checkMimeType();
        $image->createFilePath();
        $image->moveFile($article, $conn);
        
        // $mime_types = ['image/gif', 'image/png', 'image/jpeg'];
        // // Just an array of acceptable MIME types

        // $finfo = finfo_open(FILEINFO_MIME_TYPE);
        // //Creates a new finfo file and flags that we are looking for the MIME type

        // $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);
        // // Pass finfo the file (by it's temporary path) and the finfo file we have just opened to return the MIME type

        // if(! in_array($mime_type, $mime_types)) {
        //     throw new Exception('Invalid file type');
        //     // checks if the returned MIME type is not in the array and throws an exception if needs be
        // }

        // $pathinfo = pathinfo($_FILES['file']['name']);
        // //Use pathinfo to splut the file up into the file and extension
        
        // $base = $pathinfo['filename'];
        // //save the name of the file in a variable called base
       
        // $base = preg_replace('/^[a-zA-Z0-9-_]/', '_', $base);
        // // Replace anything that isn't alphanumeric, _ or - with _ in the name

        // $base = mb_substr($base, 0, 255); // make sure the string will fit into our database

        // $filename = $base . "." . $pathinfo['extension'];
        // //Recreate the filename by adding the newly sanitised base 

        // $destination = "../uploads/${filename}";
        // // Make the destination 

        // $i = '1';

        // while (file_exists("../uploads/${filename}")) {
        //     $filename = $base . "-{$i}." . $pathinfo['extension'];
        //     var_dump($filename);
        //     $destination = "../uploads/${filename}";
        //     $i++;
        // }

        

        // if(move_uploaded_file($_FILES['file']['tmp_name'], $image->destination)){

        //     $previousFile = $article->image_file;

        //     if($article->setImageField($conn, $image->filename)){

        //         if($previousFile){
        //             unlink("../uploads/${previousFile}");
        //         }

        //         URL::redirect("/mikedoesphp/admin/edit_article_image.php?id={$article->id}");
        //     }

        // } else {
        //     throw new Exception('Unable to move uploaded file');
        //     // throw an error if it fails
        // }



    } catch(Exception $e){
        echo $e->getMessage();
        $uploadError = $e->getMessage();
    }

    

    }
    
?>

<h2>Edit Article Image</h2>

<?php require '../includes/header.php';?>

<?php if($article->image_file): ?>
    <img alt="Image for the article" src="../uploads/<?=$article->image_file?>">
    <a href="/mikedoesphp/admin/delete_article_image.php?id=<?=$article->id?>">Delete image</a>
<?php endif; ?>

<?php if(isset($uploadError)) : ?>
    <?=$uploadError;?>
<?php endif; ?>

<form enctype="multipart/form-data" method="post">
    <div>
        <label for="file">Insert file here</label>
    </div>
    <div>
        <input type="file" name="file" id="file">   
    </div>
    <button>Submit</button>

</form>

<?php require '../includes/footer.php'; ?>