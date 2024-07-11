<?php

function secure_html($value) {
    if (is_array($value)) {
        return array_map('sanitize_post_data_recursive', $value);
    } else {
        return htmlspecialchars($value, ENT_QUOTES);
    }
}

function HASH_MD5($var){
    return md5($var);
}

function HASH_SHA256($var){
    return hash('sha256', $var);
}

function HASH_BCRYPT($var){
    return password_hash($var, PASSWORD_BCRYPT);
}

function HASH_CHECK_BCRYPT($var, $var2){
    return password_verify($var, $var2);
}
function DB_QUERY($query){
    $config = parse_ini_file('../config.ini', true);
    if ($config === false) {
        die('Error reading config file');
    }
    $driver = $config['database']['DRIVER'];
    if($driver == "mysql"){
        $result = mysqli_query(DB(), $query);
        $res = mysqli_fetch_assoc($result);
        $json = json_encode($res);
    }else{
        $result = pg_query(DB(), $query);
        if (!$result) {
            return false;
        }
        $res = pg_fetch_assoc($result);
        $json = json_encode($res);
    }
    return json_decode($json, true);
}


function DB_TABLE_getAll($table){
    $check_query = htmlspecialchars($table);
    $result = mysqli_query(DB(), "SELECT * FROM ".$check_query);
    $res = mysqli_fetch_assoc($result);
    return $res;
}

function DB_UPDATE($table, $where, $query){
    $result = mysqli_query(DB(), "UPDATE ".$table." SET ".$query." WHERE ".$where);
    return $result; 
}
?>