<?php


function old($form_data, $db_data = null)
{
    if (isset($form_data)) {
        return $form_data;
    } 
    else {
        return $db_data;
    }
}
