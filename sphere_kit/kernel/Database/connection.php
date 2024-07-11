<?php
require_once('../sphere_kit/kernel/error_handler.php');

$config = parse_ini_file('../config.ini', true);
if ($config === false) {
    die('Error reading config file');
}

$driver = $config['database']['DRIVER'];
$db_host = $config['database']['HOST'];
$db_username = $config['database']['USERNAME'];
$db_password = $config['database']['PASSWORD'];
$db_name = $config['database']['DB_NAME'];
$db_port = $config['database']['PORT'];
$debug = $config['settings']['DEBUG'];
$log_file = $config['settings']['LOG_FILE'];


if($driver == "mysql"){
    $DB = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    if (!$DB) {
        $error_message = "[Database] - MySQL connection error: " . mysqli_connect_error();
        error_log($error_message, 3, $log_file);
        die($error_message);
    }
    
    if ($debug) {
        error_log("[Database] - Connected successfully to the database.\n", 3, $log_file);
    }
}else{
    $DB = pg_connect("host=$db_host port=$db_port dbname=$db_name user=$db_username password=$db_password sslmode=require");
    if (!$DB) {
        $error_message = "[Database] - MySQL connection error: " . pg_last_error();
        error_log($error_message, 3, $log_file);
        die($error_message);
    }
    
    if ($debug) {
        error_log("[Database] - Connected successfully to the database.\n", 3, $log_file);
    }
}

function DB(){
    $config = parse_ini_file('../config.ini', true);
    if ($config === false) {
        die('Error reading config file');
    }

    $driver = $config['database']['DRIVER'];
    $db_host = $config['database']['HOST'];
    $db_username = $config['database']['USERNAME'];
    $db_password = $config['database']['PASSWORD'];
    $db_name = $config['database']['DB_NAME'];
    $db_port = $config['database']['PORT'];

    if($driver == "mysql"){
        $DB = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    }else{
        $DB = pg_connect("host=$db_host port=$db_port dbname=$db_name user=$db_username password=$db_password sslmode=require");
    }
    return $DB;
}
?>
