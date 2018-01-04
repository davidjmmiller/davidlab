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

function db_connect()
{
    try {
        global $config;
        global $database_connection;
        $database_connection = new PDO($config['db_dsn'], $config['db_user'], $config['db_pass']);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

function db_query($sql,$params = array()){
    global $database_connection;
    if (!is_object($database_connection)) {
        db_connect();
    }

    $query = $database_connection->prepare($sql);
    try
    {
        $database_connection->beginTransaction();

        if (count($params) > 0)
        {
            $result = $query->execute($params);
        }
        else {
            $result = $query->execute();

        }
        if (!$result)
        {
            echo '<pre>';
            $err = $query->errorInfo();
            print_r($err);
            echo '</pre>';
        }


        $_SESSION['db_last_insert_id'] = $database_connection->lastInsertId();
        $database_connection->commit();
    }
    catch(PDOExecption $e)
    {
        $database_connection->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }

    return $query->fetchAll(PDO::FETCH_ASSOC);
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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function new_email($from_email, $from_name, $to = array(), $subject, $body, $alt_body, $cc = array(), $bcc = array(), $reply_to_email = "", $reply_to_name = "")
{
    global $config;

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {

        //Server settings
        $mail->isSMTP();                                        // Set mailer to use SMTP
        $mail->SMTPDebug = $config['mail_smtpdebug'];           // Enable verbose debug output
        $mail->Host = $config['mail_host'];                     // Specify main and backup SMTP servers

        $mail->SMTPAuth = $config['mail_smtpauth'];             // Enable SMTP authentication
        $mail->Username = $config['mail_username'];             // SMTP username
        $mail->Password = $config['mail_password'];             // SMTP password
        $mail->SMTPSecure = $config['mail_smtpsecure'];         // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $config['mail_port'];                     // TCP port to connect to

        //Recipients
        $mail->setFrom($from_email, $from_name);

        for ($c = 0; $c < count($to); $c++)
        {
            $mail->addAddress($to[$c]);               // Name is optional
        }

        if ($reply_to_email != ''){
            $mail->addReplyTo($reply_to_email, $reply_to_name);
        }

        for ($c = 0; $c < count($cc); $c++)
        {
            $mail->addCC($cc[$c]);               // Name is optional
        }

        for ($c = 0; $c < count($bcc); $c++)
        {
            $mail->addBCC($bcc[$c]);               // Name is optional
        }

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(false);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $alt_body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        return false;
    }
}

function queue_email($from_email, $from_name, $user_id = '', $to = array(), $subject, $body, $alt_body, $cc = array(), $bcc = array(), $reply_to_email = "", $reply_to_name = "")
{
    // Parameters
    $to = implode(';',$to);
    $cc = implode(';',$cc);
    $bcc = implode(';',$bcc);


    $sql = 'INSERT INTO `email_queue` (status,request_time,user_id,from_email,from_name,`to`,subject,body,alt_body,cc,bcc,reply_to_email,reply_to_name)';
    $sql .= 'VALUES (?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $params = array(1,$user_id,$from_email,$from_name,$to,$subject,$body,$alt_body,$cc,$bcc,$reply_to_email,$reply_to_name);
    $result = db_query($sql, $params);

}