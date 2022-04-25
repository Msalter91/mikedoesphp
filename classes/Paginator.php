<?php 

class Paginator {

    public $limit; // limit passed in during the constructor
    public $offset; // offset passed in during the constructor 

    public $previous; 
    public $next; 

    public function __construct($page, $records_per_page, $totalRecords) {
        $this->limit = $records_per_page;
        $page = filter_var($page, FILTER_VALIDATE_INT, [
            'options' => [
                'default' => 1, // This stops anything that is not a number causing an error
                'min_range' => 1 // this stops negative numbers being passed in
            ]
        ]); // validates the query string to only have int 

        $totalPages = ceil($totalRecords / $records_per_page);

        if($page < $totalPages) {
            $this->next = $page + 1; // this allows the page to be increased using a next button but will become null 
                                     // it gets to the final page 
        }

        if($page > 1) {
            $this->previous = $page - 1;  // this allows the page to be decreased using a previous button but will become null 
                                          // it gets to the first page 
        }

        $this->offset = $records_per_page * ($page - 1);
    }
        
    }
