<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        var_dump($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <fieldset>
            <legend>Data</legend>
            <div>
                <label for="name">Name</label> 
                <input type="text" id="name" name="name">
                <label for="name">Age</label> 
                <input type="number" id="age" name="age">
            </div>
        </fieldset>
        <fieldset>
            <label><input type="radio" name="sandwich" value="ham">Ham</label><br>
            <label><input type="radio" name="sandwich" value="egg">Egg</label><br>
            <label><input type="radio" name="sandwich" value="cheese">Cheese</label>
        </fieldset>
        <input type="submit">
    </form>
</body>
</html>


