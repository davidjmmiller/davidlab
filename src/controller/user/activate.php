<?php

if (isset($_GET['key']))
{
    // Looking into the database for the activation key
    $sql = 'SELECT * FROM user_activation WHERE activation_key = :key and status = 1';
    $params = array(':key' => $_GET['key']);
    $result = db_query($sql, $params);
    if (count($result) == 0) {
        require PATH_VIEW.'user/invalid_account_activation.php';
    }
    else
    {
        // Updating User status
        $result = $result[0];
        $sql = 'UPDATE `user` SET active = 2 WHERE user_id = :user_id and active = 1 ';
        $params = array(':user_id' => $result['user_id']);
        $result = db_query($sql, $params);

        // Updating the key status
        $sql = 'UPDATE user_activation SET status = 2 WHERE activation_key = :key and status = 1 ';
        $params = array(':key' => $_GET['key']);
        $result = db_query($sql, $params);
        require PATH_VIEW.'user/account_activation.php';
    }

}
