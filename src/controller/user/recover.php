<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = $_POST['username'];

    // Username
    if (empty($username)) {
        $errors['username'][] = 'This field is required';
    } else if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $errors['username'][] = 'The field should be a valid email';
    } else {
        $sql = 'SELECT * FROM user WHERE username = :username AND active = 2';
        $params = array(':username' => $username);
        $result = db_query($sql, $params);
        if (count($result) == 0) {
            $errors['username'][] = 'The account doesn\'t exists in the system or account is inactive';
        }
        else
        {

            $result = $result[0];

            // Saving the reset password key
            $key = authentication_key();
            $sql = 'INSERT INTO user_reset 
              (user_id,request_time,reset_key, status) VALUES (?,now(),?,?)';
            $params = array($result['user_id'], $key, 1);
            db_query($sql, $params);


            // Sending email with the information
            $body = require PATH_VIEW.'email_templates/user/recover.php';
            $alt_body = strip_tags($body);

            $from_email = $config['mail_from_email_recover'];
            $from_name = $config['mail_from_name_recover'];
            queue_email($from_email, $from_name, $result['user_id'],
                array($result['username']), 'Password Reset', $body, $alt_body, array(),
                array('daxdoxsi@gmail.com'), "", "");

            header('Location: /');

        }

    }
}
require PATH_VIEW.'user/recover.php';
