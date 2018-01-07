<?php

if (isset($_GET['key']))
{
    // Looking into the database for the activation key
    $sql = 'SELECT * FROM user_reset WHERE reset_key = :key and status = 1';
    $params = array(':key' => $_GET['key']);
    $result = db_query($sql, $params);
    if (count($result) == 0) {
        require PATH_VIEW.'user/invalid_account_activation.php';
    }
    else
    {
        require PATH_VIEW.'user/reset_password.php';

    }

}

if (isset($_POST['key'])) {

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    // New Password Validation
    $errors = array();
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    // Password
    if (empty($password)) {
        $errors['password'][] = 'This field is required';
    } else if (strlen($password) < 5) {
        $errors['password'][] = 'The password length should be at least 5 characters';
    } else if ($password != $password_confirmation) {
        $errors['password'][] = 'Please confirm your password';
    }

    // Password confirmation
    $field = 'password_confirmation';
    $label = 'Password confirm';
    if (empty($$field)) {
        $errors[$field][] = 'This field is required';
    }

    if (count($errors) == 0) {

        // Looking into the database for the activation key
        $sql = 'SELECT * FROM user_reset WHERE reset_key = :key and status = 1';
        $params = array(':key' => $_POST['key']);
        $result = db_query($sql, $params);
        if (count($result) > 0) {

            // Updating password
            $result = $result[0];
            $sql = 'UPDATE user SET `password` = MD5(:password) WHERE user_id = :user_id';
            $params = array(':password'=> $_POST['password'] ,':user_id' => $result['user_id']);
            $result = db_query($sql, $params);

            // Updating the key status
            $sql = 'UPDATE user_reset SET status = 2 WHERE reset_key = :key and status = 1 ';
            $params = array(':key' => $_POST['key']);
            $result = db_query($sql, $params);

        }

        // header('Location: /user/login ');
    }
    else
    {
        require PATH_VIEW.'user/reset_password.php';

    }
}