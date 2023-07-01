<?php
    $ainit_included = true;
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'sysadmin');
    defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'include');  
?>