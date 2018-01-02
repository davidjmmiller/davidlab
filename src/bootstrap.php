<?php

// Loading files
require '../src/config/global.php';
require '../src/config/database.php';
require '../src/config/email.php';
require '../src/lib/util.php';

// Loading email library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../src/external_lib/PHPMailer/src/Exception.php';
require '../src/external_lib/PHPMailer/src/PHPMailer.php';
require '../src/external_lib/PHPMailer/src/SMTP.php';
require '../src/external_lib/PHPMailer/src/OAuth.php';
require '../src/external_lib/PHPMailer/src/POP3.php';

// Paths
define('PATH_VIEW','../src/views/');
define('PATH_CONTROLLER','../src/controller/');
define('PATH_MODEL','../src/model/');

// Initializing session
session_start();

// Detecting language
if (!isset($_SESSION['lang'])){
    $_SESSION['lang'] = $config['default_lang'];
}

// Loading global language file
require '../src/lang/'.$_SESSION['lang'].'/global.php';


// Reading current path
if (!isset($_GET['q']))
{
    $block_content = PATH_CONTROLLER.'default.php';
    $current_path = '';
}
else {
    switch ($_GET['q'])
    {
        case 'lang':
            $block_content =  PATH_CONTROLLER.'lang_selector/lang.php';
            break;
        case 'user/login':
            $block_content =  PATH_CONTROLLER.'user/login.php';
            break;
        case 'user/logout':
            $block_content =  PATH_CONTROLLER.'user/logout.php';
            break;
        case 'user/register':
            $block_content =  PATH_CONTROLLER.'user/register.php';
            break;
        case 'user/recover':
            $block_content =  PATH_CONTROLLER.'user/recover.php';
            break;
        case 'user/registration_confirmation':
            $block_content =  PATH_CONTROLLER.'user/registration_confirmation.php';
            break;
        case 'user/cancel':
            $block_content =  PATH_CONTROLLER.'user/cancel.php';
            break;
        default:
            $block_content = PATH_CONTROLLER.'page_not_found.php';
            break;
    }
    $current_path = $_GET['q'];
}

// Loading additional blocks
$block_header = PATH_CONTROLLER.'partials/header.php';
$block_footer = PATH_CONTROLLER.'partials/footer.php';

// Loading layout
require PATH_CONTROLLER.'templates/default.php';