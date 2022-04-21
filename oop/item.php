<?php

class Item {

    public string $name;

    public function getListingDescription() {
        return $this -> name;
    }

    private function cantAccessThis() {
        echo "Can only get this from inside me";
    }

    protected function canAccessThisKindof() {
        echo "Can access this in me or my child";
    }

}


// $item = new Item();
// echo $item->cantAccessThis(); //fatal error 
// echo $item->canAccessThisKindof(); //fatal error

class betterItem extends Item {
    public function getProtectedMethod() {
        $this->canAccessThisKindof();
    }
}

$betterItem = new betterItem();
$betterItem->getProtectedMethod();




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










