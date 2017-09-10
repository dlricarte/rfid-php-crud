<?php
/**
 * Created by JetBrains PhpStorm.
 * User: halo
 * Date: 6/30/13
 * Time: 3:26 PM
 *
 */
// Admin Functions
include __DIR__.'/vendor/autoload.php';
include __DIR__.'/config/config.php';

use App\Crud;
use App\Crypto;
use App\MemberController;

session_start();
if (isset($_POST['pin']))
{
    $key = filter_var($_POST['pin'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['password']))
{
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
}
if (isset($_GET['action']))
{
    $action = filter_var($_GET['action'], FILTER_SANITIZE_STRING);
}
if (isset($_GET['key']))
{
    $key = filter_var($_GET['key'], FILTER_SANITIZE_STRING);
}
if (isset($_GET['rowid']))
{
    $rowid = filter_var($_GET['rowid'], FILTER_SANITIZE_STRING);
}
if (!isset($action))
{
    $action = 'default';
}
if ($debug)
{
    var_dump($_SESSION);
}
if (isset($_SESSION['logged_in']) && ($_SESSION['logged_in']))
{

    $crud = new Crud();
    $crypto = new Crypto();
    //    $log_reader = new LogReader($config);

    switch ($action)
    {
        case "viewlogs":
            require_once 'resources/includes/header.php';
            require_once 'resources/includes/actions/viewlogs.php';
            require_once 'resources/includes/footer.php';
            break;
        case "add":
            require_once 'resources/includes/header.php';
            require_once 'resources/includes/actions/add.php';
            require_once 'resources/includes/footer.php';
            break;
        case "doadd":
            require_once 'resources/includes/header.php';
            require_once 'resources/includes/actions/doadd.php';
            require_once 'resources/includes/footer.php';
            break;
        case "edit":
            require_once 'resources/includes/actions/edit.php';
            break;
        case "doedit":
            require_once 'resources/includes/header.php';
            require_once 'admin-menu.php';
            require_once 'resources/includes/actions/doedit.php';
            require_once 'resources/includes/footer.php';
            break;
        case "doedituser":
            $member_controller = new MemberController();
            $member_controller->doEditUser();
            break;
        case "delete":
            $member_controller = new MemberController();
            $member_controller->delete();
            break;
        case "pullusers":
            $member_controller = new MemberController();
            $member_controller->pollMembers();
            break;
        default:
            require_once 'resources/includes/header.php';
            require_once 'admin-menu.php';
            require_once 'resources/includes/actions/default.php';
            require_once 'resources/includes/footer.php';
            break;
    }

}
else
{
    //login failed
    $msg = urldecode("Please Log In");
    //header('Location: /login.php?msg=' . $msg);
}
?>
