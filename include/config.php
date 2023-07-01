<?php
$config_included = true;
$debug_mode = true;
if($debug_mode==true){error_reporting(E_ALL);}else{error_reporting(0);}
defined('server') ? null : define("server", "localhost");
defined('user') ? null : define ("user", "root");
defined('pass') ? null : define("pass","abc123");//abc123
defined('database_name') ? null : define("database_name", "leavedb") ;

$AppTitle = "sysadmin";
$this_file = str_replace('\\', '/', __File__) ;
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$webRoot =  str_replace (array($doc_root, "include/config.php") , '' , $this_file);
$srvRoot = str_replace ('config/config.php' ,'', $this_file);

date_default_timezone_set('America/New_York');
$CurrentDate = date("yy-m-d");
$TomorrowDate = date('yy-m-d', strtotime($CurrentDate. ' + 1 day'));

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'].'/';
$URLBase = $protocol.$domainName.'sysadmin/';

define('WEB_ROOT', $webRoot);
define('SRV_ROOT', $srvRoot);
?>