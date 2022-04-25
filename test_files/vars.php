<?php

function myException($exception) {
  echo "<b>Exception:</b> " . $exception->getMessage(); // set the user defined function
}

set_exception_handler('myException'); // set the user defined function as the error handler

throw new Exception('oh dear somethings gone terribly wrong!'); // Throw an error with a custom message

?>

