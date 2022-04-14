<?php 

setcookie('test-cookie', 'Yam cookie', time() + 60 * 60 * 24 * 2);

echo 'Cookie monster';