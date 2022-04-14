<?php 

setcookie('sub-cookie', 'kermit', time() + 3600, '/');
echo 'sub cookie set';