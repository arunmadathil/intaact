<?php


function old($form_data, $db_data = null)
{
    if (isset($db_data)) {
        return $db_data;
    } 
    else {
        return $form_data;
    }
}
