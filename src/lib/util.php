<?php


function db_connect(){
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
            $query->execute($params);
        }
        else
        {
            $query->execute();
        }
        $_SESSION['db_last_insert_id'] = $database_connection->lastInsertId();
        $database_connection->commit();
    }
    catch(PDOExecption $e)
    {
        $database_connection->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }

    return $query->fetchAll();
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

        echo '<pre>'.$mail->Host.'</pre>';

        $mail->SMTPAuth = $config['mail_smtpauth'];             // Enable SMTP authentication
        $mail->Username = $config['mail_username'];             // SMTP username
        $mail->Password = $config['mail_password'];             // SMTP password
        $mail->SMTPSecure = $config['mail_smtpsecure'];         // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $config['mail_port'];                     // TCP port to connect to

        echo '<pre>'.$mail->Port.'</pre>';

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
            $mail->addCC($to[$cc]);               // Name is optional
        }

        for ($c = 0; $c < count($bcc); $c++)
        {
            $mail->addBCC($to[$bcc]);               // Name is optional
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
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}