<?php 

class Article {

    public $id;
    public $title;
    public $content;
    public $published_at;
    public $image_file;

    public $errors = [];
    
    /**
     * Get all the articles
     * 
     * @param object $conn Connection to the database
     * 
     * @return array An associative array of the article records 
     */
    public static function getAll(object $conn) {
        $sql = "SELECT * 
        FROM article
        ORDER BY published_at;";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC); 
    }

    public static function getPage(object $conn, int $limit, int $offset) {
        $sql = "SELECT *
        FROM article 
        ORDER BY published_at
        LIMIT :limit
        OFFSET :offset";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Gets the article record from the id provided
     * 
     * @param object $conn Connection to the database 
     * @param integer $id the article id 
     * @param mixed columns to select from
     * 
     * @return mixed An Article object containing the article with that id. Null if not found
     */
    public static function getByID(object $conn, int $id, string $columns = "*") {
    $sql = "SELECT $columns
            FROM article
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    // Using the prepare method on the connection object 
    // to prepare the statment above

   
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      // binding the values and declaring the type using a PDO constant

      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');
      // Makes sure that the PDO returns an object from the Article class

        if($stmt->execute()) {
            return $stmt->fetch();
            // Can use the parenthesis to add a flag specifying assoc array for return 
        }
        // executing the function
}
    public function update(object $conn) {
        // This function isn't static because it will be acting on an individual instance
        // of a function. 

        if($this->validate()) {
            $sql = "UPDATE article
        SET title = :title, 
            content = :content, 
            published_at = :published_at 
        WHERE id = :id"; 

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
        
        if ($this->published_at == '') {
            $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
        }
        

        return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
 * Function to validate the data coming into the db
 * @param string title the article title 
 * @param string the articles content 
 * @param string the time that the article was written 
 * @return Boolean an array of errors 
 */

    protected function validate() {

        if($this->title == '') {
            $this->errors[] = 'Title is required';
        }

        if($this->content == '') {
            $this->errors[] = 'Content is required';
        }

        if($this->published_at != '') {
            $date_time = date_create_from_format('Y-m-d H:i', $this->published_at);
            
            if($date_time === false) {
                $this->errors[] = "Invalid date and time";
            } else {
                $date_errors = date_get_last_errors();
                if($date_errors['warning_count'] > 0) {
                    $this->error[] = 'Invalid date and time';
                }
            }
        } 

        return empty($this->errors);
    }

    public function delete (object $conn) {
        /**
         * Delete the current article 
         * 
         * @param object $conn connection to the DB
         * 
         * @return Boolean true is delete was successful
         */
        $sql = "DELETE FROM article
                WHERE id = :id"; 

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function create(object $conn) {
        /**
         * Creates a new record 
         * 
         * @param object connection to the database 
         * 
         * @return Boolean true if successful
         */
        if($this->validate()) {
            $sql = "INSERT INTO article (title, content, published_at) 
                    VALUES (:title, :content, :published_at)"; // template for the sql

        $stmt = $conn->prepare($sql); // Preparing the statement 

        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $this->content, PDO::PARAM_STR); // Binding the values
        
        if ($this->published_at == '') {
            $stmt->bindValue(':published_at', null, PDO::PARAM_NULL); 
        } else {
            $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
        } // allowing for a field that is nullable 

        if ($stmt->execute()){
            $this->id = $conn->lastInsertId(); // Giving the object and id 
            return true;
        }
        } else {
            return false;
        }
    }

    public static function getTotal (object $conn) {
        return 
        $conn->query('SELECT COUNT(*) FROM article')->fetchColumn();

    }

    public function setImageField(object $conn, string $filename){
        $sql = "UPDATE article 
                SET image_file = :image_file
                WHERE id = :id";
        
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':image_file', $filename, $filename == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();   
    }

}