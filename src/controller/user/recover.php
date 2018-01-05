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
        $sql = 'SELECT * FROM user WHERE username = :username';
        $params = array(':username' => $username);
        $result = db_query($sql, $params);
        if (count($result) == 0) {
            $errors['username'][] = 'The account doesn\'t exists in the system';
        }
        else
        {

            $result = $result[0];

            // Sending email with the information
            $body = "Hello,<br><br>Please click on the following link in order to reset your password account.<br><br>- <a href='http://www.z506.com'>http://www.z506.com</a>";
            $alt_body = "Hello,\n\nPlease click on the following link in order to reset your password account.\n\n- http://www.z506.com \n\nCheers!\n\n";

            queue_email('davidm@z506.com', 'Z506.com', $result['user_id'],
                array($result['username']), 'Password Reset', $body, $alt_body, array(), $bcc = array('daxdoxsi@gmail.com'), "", "");

            header('Location: /user/login');

        }

    }
}
require PATH_VIEW.'user/recover.php';
