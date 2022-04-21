<?php 

class User {

    /**
     * Unique identifier 
     * @var integer 
     */
    public $id;
        /**
     * Unique username
     * @var string 
     */
    public $username;

        /**
     * password
     * @var string 
     */
    public $password;


    public static function authenticate($conn, $username, $password) {

        $sql = "SELECT * from user where username = :username"; // SQL statement template for the prepared statement 

        $stmt = $conn->prepare($sql); // Preparing the statement using the connection object 

        $stmt->bindValue(':username', $username, PDO::PARAM_STR); // Binding the values using the prepared statement placeholder,
                                                                  // $username parameter and specifying the type

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User'); // Sets the fetch result so that it is an instance of our User class 

        $stmt->execute(); // executes the statement on the database 

            if($user = $stmt->fetch()) { // Assignes the $user to the fetch result (if no user found $user will be NULL)
                return password_verify($password, $user->password); // returns if the passwords match based on the hash
            }
}


}