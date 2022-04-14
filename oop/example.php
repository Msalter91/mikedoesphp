<?php 

require 'item.php';

$my_item = new Item('item name', 'a very lovely item'); 

// $my_item -> name = 'Example'; 
// print_r($my_item);

//Item Object ( [name] => Example [description] => a very lovely item )

$myGetter = new GetSetItem('fun name', 'fun description');

print_r($myGetter);
// GetSetItem Object ( [name:GetSetItem:private] => fun name [description:GetSetItem:private] => fun description ) 

$myGetter->setName('a funner newer name');

print_r($myGetter);
// GetSetItem Object ( [name:GetSetItem:private] => a funner newer name [description:GetSetItem:private] => fun description )