<?php 

class ImageUpload {

        /**
     *  Thoughts on following Single Responsibility 
     * This should be split up into two objects
     * 1. UploadValidator 
     *      which would have the validateUpload() and checkMimeType() functions 
     * 2. Uploader which would create the path and move the image 
     */

    public string $filename;
    public string $destination;
    
    public function validateUpload () {
        if(empty($_FILES)){
            throw new Exception('Invalid upload');
        }
        switch($_FILES['file']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uploaded');
                break;
            case UPLOAD_ERR_INI_SIZE:
                throw new Exception('File is too large');
            default: 
                throw new Exception('An error occured');
        }
        if($_FILES['file']['size'] > 1000000) {
            throw new Exception('File is too large');
        }
    }

    public function checkMimeType () {
        $mime_types = ['image/gif', 'image/png', 'image/jpeg'];
        // Just an array of acceptable MIME types

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        //Creates a new finfo file and flags that we are looking for the MIME type

        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);
        // Pass finfo the file (by it's temporary path) and the finfo file we have just opened to return the MIME type

        if(! in_array($mime_type, $mime_types)) {
            throw new Exception('Invalid file type');
            // checks if the returned MIME type is not in the array and throws an exception if needs be
        }
    }

    public function createFilePath() {
        $pathinfo = pathinfo($_FILES['file']['name']);
        //Use pathinfo to splut the file up into the file and extension
        
        $base = $pathinfo['filename'];
        //save the name of the file in a variable called base
       
        $base = preg_replace('/^[a-zA-Z0-9-_]/', '_', $base);
        // Replace anything that isn't alphanumeric, _ or - with _ in the name

        $base = mb_substr($base, 0, 255); // make sure the string will fit into our database

        $this->filename = $base . "." . $pathinfo['extension'];
        //Recreate the filename by adding the newly sanitised base 

        $this->destination = "../uploads/{$this->filename}";
        // Make the destination 

        $i = '1';

        while (file_exists("../uploads/{$this->filename}")) {
            $this->filename = $base . "-{$i}." . $pathinfo['extension'];
            $this->destination = "../uploads/{$this->filename}";
            $i++;
        }
    }

    public function moveFile (object $article, object $conn) {

        var_dump($this->destination);
        
        if(move_uploaded_file($_FILES['file']['tmp_name'], $this->destination)){

            $previousFile = $article->image_file;

            if($article->setImageField($conn, $this->filename)){

                if($previousFile){
                    unlink("../uploads/${previousFile}");
                }

                URL::redirect("/mikedoesphp/admin/edit_article_image.php?id={$article->id}");
            }

        } else {
            throw new Exception('Unable to move uploaded file');
            // throw an error if it fails
        }
    } 

}