<?php
/**
 * Gets the article record from the id provided
 * 
 * @param object $conn Connection to the database 
 * @param integer $id the article id 
 * @param mixed columns to select from
 * 
 * @return mixed An associative array containing the article with that id. Null if not found
 */
function getArticle($conn, $id, $columns = "*") {
    $sql = "SELECT $columns
            FROM article
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            return mysqli_fetch_assoc($result);
        }
    }
}

/**
 * Function to validate the data coming into the db
 * @param string title the article title 
 * @param string the articles content 
 * @param string the time that the article was written 
 * @return array an array of errors 
 */

function validateArticle($title, $content, $published_at) {

    $errors = [];

    if($title == '') {
        $errors[] = 'Title is required';
    }

    if($content == '') {
        $errors[] = 'Content is required';
    }

    if($published_at != '') {
        $date_time = date_create_from_format('Y-m-d H:i', $published_at);
        
        if($date_time === false) {
            $errors[] = "Invalid date and time";
        } else {
            $date_errors = date_get_last_errors();
            if($date_errors['warning_count'] > 0) {
                $error[] = 'Invalid date and time';
            }
        }
    } 

    return $errors;
}