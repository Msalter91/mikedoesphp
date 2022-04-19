<?php 

require 'item.php';
require 'book.php';

$book = new Book();

$book->name = 'Lord of the rings';
$book->author = 'JRR Tolkien';

echo $book->getListingDescription();



