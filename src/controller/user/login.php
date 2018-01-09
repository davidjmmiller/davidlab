<?php

if (isset($_SESSION['active']) && $_SESSION['active'] == 1)
{
    header('Location: /');
}



if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    // Validations
    $errors = array();
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Username
    if (empty($username))
    {
        $errors['username'][] = 'This field is required';
    }
    else if (!filter_var($username, FILTER_VALIDATE_EMAIL))
    {
        $errors['username'][] = 'The field should be a valid email';
    }

    // Password
    if (empty($password))
    {
        $errors['password'][] = 'This field is required';
    }
    else if (strlen($password) < 5){
        $errors['password'][] = 'The password length should be at least 5 characters';
    }

    // Database validation
    if (is_array($errors) && count($errors) == 0)
    {
        $sql = 'SELECT * FROM user WHERE username = :username AND password = MD5(:password) AND active = 2';
        $params = array(':username' => $username, ':password' => $password);
        $result = db_query($sql,$params);
        if (count($result)>0){
            $_SESSION['active'] = 1;
            set_session_message('You have log in successfully');
            header('Location: /');
        }
        else
        {
            $errors['username'][] = 'Username or Password are incorrect or your account is pending of activation';
        }
    }

}

require PATH_VIEW.'user/login.php';
