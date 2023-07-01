<?php
$initialize_included = true;
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'sysadmin');
defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'include');

// load config file first 
require_once(LIB_PATH.DS."config.php");
//load basic functions next so that everything after can use them
require_once(LIB_PATH.DS."function.php");
//later here where we are going to put our class session
require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."member.php");
require_once(LIB_PATH.DS."attendance.php");
require_once(LIB_PATH.DS."shift.php");
require_once(LIB_PATH.DS."attrition.php");
require_once(LIB_PATH.DS."attrition_r.php");
require_once(LIB_PATH.DS."leavetype.php");
require_once(LIB_PATH.DS."leave.php");
//Load Core objects
require_once(LIB_PATH.DS."database.php");
require_once(LIB_PATH.DS."databaseN.php");
require_once(LIB_PATH.DS."charts.php");
//load database-related classes
?>