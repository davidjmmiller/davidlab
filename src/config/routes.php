<?php

switch ($_GET['q'])
{
    case 'cron/send_email':
        $block_content =  PATH_CONTROLLER.'cron/send_email.php';
        $load_template = false;
        break;
    case 'lang':
        $block_content =  PATH_CONTROLLER.'lang_selector/lang.php';
        $load_template = false;
        break;
    case 'tests':
        $block_content =  PATH_CONTROLLER.'tests.php';
        $load_template = false;
        break;
    case 'user/login':
        $block_content =  PATH_CONTROLLER.'user/login.php';
        break;
    case 'user/activate':
        $block_content =  PATH_CONTROLLER.'user/activate.php';
        break;
    case 'user/set_new_password':
        $block_content =  PATH_CONTROLLER.'user/reset_password.php';
        break;
    case 'user/logout':
        $block_content =  PATH_CONTROLLER.'user/logout.php';
        break;
    case 'user/signup':
        $block_content =  PATH_CONTROLLER.'user/register.php';
        break;
    case 'user/reset':
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
