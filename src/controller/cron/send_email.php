<?php
// Sending email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Selecting the records pending to send email
$sql = 'SELECT * FROM email_queue WHERE status = :status';
$params = array(':status' => 1);
$result = db_query($sql, $params);
for ($i = 0; $i < count($result); $i++)
{

    if (is_array($result[$i]) && count($result[$i]) > 0)
    {
        foreach($result[$i] as $item => $value)
        {
            $$item = $value;
        }

        $to = explode(';',$to);
        $cc = explode(';',$cc);
        $bcc = explode(';',$bcc);

        if (count($to) == 1 && $to[0] == '') { $to = array(); }
        if (count($cc) == 1 && $cc[0] == '') { $cc = array(); }
        if (count($bcc) == 1 && $bcc[0] == '') { $bcc = array(); }

        $result = new_email($from_email, $from_name, $to, $subject, $body, $alt_body, $cc, $bcc, $reply_to_email, $reply_to_name);

        // Updating status in the queue
        if ($result) {
            $sql = 'UPDATE email_queue SET status = :status, delivery_time = NOW() WHERE email_queue_id = :email_queue_id';
            $params = array(':status' => 2, ':email_queue_id' => $email_queue_id);
            $result = db_query($sql, $params);
            echo 'OK';
        }
    }

}

