<?php 

/**
 * Database
 * 
 * A connection to the database 
 */

class Database {

    /**
     * Get the database connection
     * 
     * @return PDO object Connection to the database server
     */

     protected string $db_host;
     protected string $db_name;
     protected string $db_user;
     protected string $db_pass;

    public function getConn () {

        $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name. ';charset=utf8';
        
        try {
            $db = new PDO($dsn, $this->db_user, $this->db_pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            var_dump($e);
            die();
        }
    }
    public function __construct(string $host, string $name, string $user, string $password){
        $this->db_host = $host;
        $this->db_name = $name;
        $this->db_user = $user;
        $this->db_pass = $password;
   }
}
