<?php require_once('config.php');

// Include seperate function files
include('functions_user.php');

// Attempt to connect to the database
function db_connect($select_db = true) {
    global $db_config, $dbcon;

    try {
        // Connect to database as defined in config
        $dbcon = new PDO("mysql:host=".$db_config['host'].";", $db_config['user'], $db_config['pass']);

        // Set error mode
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Select the correct database for us to use
        if ($select_db) {
            try {
                $dbcon->exec("USE `".$db_config['name']."`;");
            } catch(PDOException $e) {
                return false;
            }
        }
    } catch(PDOException $e) {
        return false;
    }

    // If we made it this far we were successful
    return true;
}

// Process string to make it safe for use (use for input)
function make_safe($string) {
    $string = htmlentities($string, ENT_QUOTES);
    if (get_magic_quotes_gpc()) {
       $string = stripslashes($string);
    }
    $string = strip_tags($string);

    return $string;
}

?>