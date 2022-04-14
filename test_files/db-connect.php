<?php

$db_host = "localhost";
$db_name = "cms";
$db_user = "msalter";
$db_pass = "MPcsU/olSZa@NO2M";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}

echo "You connected! Hooray\n";

$sql = "SELECT * 
        FROM article
        ORDER BY published_at;";

$results = mysqli_query($conn, $sql);

if($results === false) {
    echo mysqli_error($conn);
} else {
    $artciles = mysqli_fetch_all($results, MYSQLI_ASSOC);
    var_dump($artciles);
}