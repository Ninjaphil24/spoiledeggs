<?php

// define constant variables
// define('DB_NAME', 'spoiledeggs');
// define('DB_USER', 'root');
// define('DB_PASSWORD', 'virtuoso');
// define('DB_HOST', 'localhost');

try{

    // connection variable
    $con = new mysqli('localhost', '253872', 'Virtuoso24', '253872');

    // encoded language
    mysqli_set_charset($con, 'utf8');


}catch (Exception $ex){
    print "An Exception occurred. Message: " . $ex->getMessage();
} catch (Error $e){
    print "The system is busy please try later";
}
