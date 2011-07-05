<?php

/* This script generates sql to create a table described by
 * a php class.
 *
 * The class has fields that represents columns on the table
 * and each data type is represented by a class that extends
 * the Field class.
 */

require_once("setup/init.php");

$models_dir = dir("lib/model/");

if ($argv[1]) {
    require_once($models_dir->path . $argv[1] . ".php");
    echo class2table($argv[1]);
    exit;
}

while ( ($file=$models_dir->read()) ) {
    if (preg_match("/([A-Za-z_0-9]+).php/",$file,$matches)) {;
        require_once($models_dir->path . $file);
        $class = $matches[1];
        if (class_exists($class)) {
            echo class2table($class) . "\n";
        }
    }	
}


// this function receives a class and tries to generete the SQL to 
// create a table represented by the class
function class2table($class) {
    $instance = new $class("control");
    $tableName = strtolower($class);
    $query = "create table '$tableName' (\n'id' int4 primary key,\n";
    $vars = get_object_vars($instance);
    foreach ( $vars as $fieldName => $dataType) {
        if (is_object($dataType) && isset($dataType->dbRep)) {
	    $query .= "'$fieldName' " . $dataType->dbRep;
	    foreach ( $dataType->fieldOpts as $optName => $opt ) {
                $query .= "$optName $opt ";
            }
            $query .= ",\n";
        }
    }
    $query .= ");";
    return $query;
}
     
?>
