<?php

function t($key)
{
    global $lang;
    if (isset($lang[$_SESSION['lang']][$key]))
    {
        return $lang[$_SESSION['lang']][$key];
    }
    return '*'.$key.'*';
}


/*
 * Allow to read to value in the $_POST variable for the forms
 */
function post($name)
{
    if (isset($_POST[$name]))
    {
        return $_POST[$name];
    }
    return '';
}

