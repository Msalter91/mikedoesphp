<?php

    class Book extends Item
    {
        public string $author;

        public function getListingDescription() {
            return parent::getListingDescription() . " by {$this->author}";
        }
    }

    