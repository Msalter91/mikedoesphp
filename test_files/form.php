<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    var_dump($_GET);

}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Forms</title>
    <meta charset="utf-8">
</head>
<body>

<form method="get">

    <div>
        text: <input type="text">
    </div>

    <div>
        password: <input type="password">
    </div>

    <div>
        tel: <input type="tel">
    </div>

    <div>
        url: <input type="url">
    </div>

    <div>
        date: <input type="date">
    </div>

    <div>
        time: <input type="time">
    </div>

    <div>
        week: <input type="week">
    </div>

    <div>
        color: <input type="color">
    </div>

    <div>
        email: <input type="email">
    </div>

    <div>
        month: <input type="month">
    </div>

    <div>
        range: <input type="range">
    </div>

    <div>
        hidden: <input type="hidden">
    </div>

    <div>
        number: <input type="number">
    </div>

    <div>
        search: <input type="search">
    </div>

    <div>
        datetime-local: <input type="datetime-local">
    </div>

    <button type="submit">Send</button>

</form>

</body>
</html>
