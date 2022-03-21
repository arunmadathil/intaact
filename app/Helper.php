<?php


function old($form_data, $db_data = null)
{
    if (isset($form_data)) {
        return $form_data;
    } else {
        return $db_data;
    }
}


function file_path()
{
    $path = explode('/', $_SERVER['REQUEST_URI']);
    if (isset($path[1]) && trim($path[1]) != '') {
        $path =  trim($path[1]);
    }
    $position = strpos($path, '?');
    if ($position !== false) {
        $path = substr($path, 0, $position);
    }

    return $path;
}

function csrf_token(){
    $csrf = \App\Core\CsrfTokenVerification::getInstance();
    $token = $csrf::getToken();
    return "<input type='hidden' name='_csrf_token' value ='$token'>";
}