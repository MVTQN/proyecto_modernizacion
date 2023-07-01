<?php
$error_handling_included = true;

function redirect($URL=NULL){
    header("Location: ".$URL);
    exit();
}

?>