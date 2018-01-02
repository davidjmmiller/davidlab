<?php

if (isset($_SESSION['active']) && $_SESSION['active'] == 1)
{
    header('Location: /');
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validations
    $errors = array();
    $identification = $_POST['identification'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $mobile_phone = $_POST['mobile_phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Identification
    if (empty($identification)) {
        $errors['identification'][] = 'This field is required';
    } else if (strlen($identification) < 9) {
        $errors['identification'][] = 'The Identification length needs to have 9 digits';
    } else {
        $sql = 'SELECT * FROM user as u JOIN user_profile as up ON u.user_id = up.user_id WHERE up.identification = :identification';
        $params = array(':identification' => $identification);
        $result = db_query($sql, $params);
        if (count($result) > 0) {
            $errors['identification'][] = 'Identification already exists in the system';
        }
    }

    // First name
    $field = 'first_name';
    $label = 'First name';
    if (empty($$field)) {
        $errors[$field][] = 'This field is required';
    } else if (strlen($$field) < 2) {
        $errors[$field][] = 'The ' . $label . ' length needs to have 2 digits';
    }

    // Last name
    $field = 'last_name';
    $label = 'Last name';
    if (empty($$field)) {
        $errors[$field][] = 'This field is required';
    } else if (strlen($$field) < 2) {
        $errors[$field][] = 'The ' . $label . ' length needs to have 2 digits';
    }

    // Country
    $field = 'country';
    $label = 'Country';
    if (empty($$field)) {
        $errors[$field][] = 'This field is required';
    } else if (strlen($$field) < 2) {
        $errors[$field][] = 'The ' . $label . ' length needs to have 2 digits';
    }

    // City
    $field = 'city';
    $label = 'City';
    if (empty($$field)) {
        $errors[$field][] = 'This field is required';
    } else if (strlen($$field) < 2) {
        $errors[$field][] = 'The ' . $label . ' length needs to have 2 digits';
    }

    // Address
    $field = 'address';
    $label = 'Address';
    if (empty($$field)) {
        $errors[$field][] = 'This field is required';
    } else if (strlen($$field) < 10) {
        $errors[$field][] = 'The ' . $label . ' length needs to have 10 letters';
    }

    // Mobile phone
    $field = 'mobile_phone';
    $label = 'Mobile Phone';
    if (empty($$field)) {
        $errors[$field][] = 'This field is required';
    } else if (strlen($$field) < 8) {
        $errors[$field][] = 'The ' . $label . ' length needs to have at least 8 digits';
    }

    // Username
    if (empty($username)) {
        $errors['username'][] = 'This field is required';
    } else if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $errors['username'][] = 'The field should be a valid email';
    } else {
        $sql = 'SELECT * FROM user WHERE username = :username';
        $params = array(':username' => $username);
        $result = db_query($sql, $params);
        if (count($result) > 0) {
            $errors['username'][] = 'The email account already exists in the system';
        }
    }

    // Password
    if (empty($password)) {
        $errors['password'][] = 'This field is required';
    } else if (strlen($password) < 5) {
        $errors['password'][] = 'The password length should be at least 5 characters';
    } else if ($password != $password_confirm) {
        $errors['password'][] = 'Please confirm your password';
    }

    // Password confirmation
    $field = 'password_confirm';
    $label = 'Password confirmation';
    if (empty($$field)) {
        $errors[$field][] = 'This field is required';
    }

    if (count($errors) == 0) {
        $sql = 'INSERT INTO user (username,password,active) VALUES (?,MD5(?),?)';
        $params = array($username, $password, 1);
        $result = db_query($sql, $params);

        $sql = 'INSERT INTO user_profile 
              (user_id,identification,first_name,last_name,country,city,address,mobile_phone) VALUES (?,?,?,?,?,?,?,?)';
        $params = array($_SESSION['db_last_insert_id'], identification, first_name, last_name, country, city, address, mobile_phone);
        $result = db_query($sql, $params);

        header('Location: /user/registration_confirmation');
    }


    //global $db_last_insert_id;
    // echo '<pre>';
    // echo $_SESSION['db_last_insert_id'];
    // echo '</pre>';


}

require PATH_VIEW.'user/register.php';
