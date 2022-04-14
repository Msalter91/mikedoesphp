<?php

class Item {

private $name;
public $description = "This is the default description";

function __construct($name, $desc)
{
    $this->name = $name;
    $this->description = $desc;
}

function greeting() {
    return 'hello I am ';
}

function selfIntro() {
    return $this->greeting() . $this->name;
}

}

class GetSetItem {

    private $name;
    private $description = "This is the default description";
    
    function __construct($name, $desc)
    {
        $this->name = $name;
        $this->description = $desc;
    }
    
    function getName() {
        return $this->name;
    }
    
    function setName($name) {
        $this->name = $name;
    }

    function getDescription() {
        return $this->description;
    }

    function setDescription($desc) {
        $this->description = $desc;
    }
    
    }