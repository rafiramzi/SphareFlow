<?php
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    if (error_reporting() === 0) {
        return;
    }
    if (in_array($errno, [E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING, E_WARNING, PSFS_ERR_FATAL, E_ALL])) {
        ErrorPage(['errno' => $errno, 'errstr' => $errstr, 'errfile' => $errfile, 'errline' => $errline]); // Pass an array with the error number and error message
        exit;
    }
    return false;
}


function ErrorPage($error){
    extract($error);
    include('err.php');
}

set_error_handler("customErrorHandler");
?>
