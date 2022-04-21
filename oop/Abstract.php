<?php 

abstract class BaseItem {
    public $name;
    public $id;
    public $price;

    public function echoName () {
        echo $this->name;
    }

}

class Book extends BaseItem {
    public $author;
    public $ISBN;
    public $department;
}

$willWork = new Book();
$willWork->name = 'Harry Potter';
$willWork->echoName(); // Harry Potter