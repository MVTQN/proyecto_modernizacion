<?php
$security_included = true;

class Secure {

    public static function sToken($long = false)
    {
        try{
            if($long == true){
                $sToken = md5(date(base64_encode("HsYdBim".time())));
            }else{
                $sToken = md5(date(base64_encode("HYdBim")));
                //$sToken = date("HYdBim");
            }
            return $sToken;
        }catch(Exception $e){
            $sToken = md5("0");
            return $sToken;
        }
    }

    public static function scriptRedirect($URL = "index.php")
    {
        try{
            echo '<script>window.location.href = "'.$URL.'";</script>';
            exit();
        }catch(Exception $e){
            @header("Location: ".$URL);
            exit();
        }
    }

    public static function session_verify($toRoot = "")
    {
        try{
            if(!isset($_SESSION)){
                session_start();
            }
            if (!isset($_SESSION['EMPID'])){Secure::scriptRedirect($toRoot."login.php");}
        }catch(Exception $e){
            @header("Location: ".$toRoot."login.php");
        }
    }

    public static function encrypt($string, $key) {
        $result = '';
        for($i=0; $i<strlen($string); $i++) {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)+ord($keychar));
           $result.=$char;
        }
        return base64_encode($result);
     }

     public static function decrypt($string, $key) {
        $result = '';
        $string = base64_decode($string);
        for($i=0; $i<strlen($string); $i++) {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)-ord($keychar));
           $result.=$char;
        }
        return $result;
     }

    public static function headerRedirect($URL = "index.php")
    {
        try{
            @header("Location: ".$URL);
            exit();
        }catch(Exception $e){
            echo '<script>window.location.href = "'.$URL.'";</script>';
            exit();
        }
    }

    public static function cleanInput($input) {
 
        $search = array(
          '@<script[^>]*?>.*?</script>@si',
          '@<[\/\!]*?[^<>]*?>@si',         
          '@<style[^>]*?>.*?</style>@siU',
          '@<![\s\S]*?--[ \t\n\r]*>@' 
        );
       
          $output = preg_replace($search, '', $input);
          return $output;
        }
       
        public static function characters_rollback(){

        }

        public static function sanitize($input) {
          if (is_array($input)) {
              foreach($input as $var=>$val) {
                  $output[$var] = sanitize($val);
              }
          }else{
              
                  $input = stripslashes($input);

              $input  = Secure::cleanInput($input);
              $patts = array(";" => "", "'" => "", "\"" => "", "/" => "", "\\" => "", "`" => "", ";" => "");
              $input = strtr($input, $patts);
              $patts2 = array("DELETE" => "", "INSERT" => "", "UPDATE" => "", "CREATE" => "", "DROP" => "", "ALTER" => "");
              $output = strtr($input, $patts2);
              $output = htmlspecialchars($output);
              $output = strip_tags($output);
              $output = addslashes($output);
              $output = str_replace("&amp;", "&", $output);
          }
          return $output;
      }
}