<?php
// Flush the output buffer
ob_start();

// Set Charset and content type
header('Content-Type: text/html; charset=UTF-8');

// Turn on showing errors
ini_set('display_errors', 1);

/*
  0                   -> Do not show any errors
  E_ALL               -> Show all errors
  E_ALL ^ E_NOTICE    -> Show errors without notices  
*/
error_reporting(E_ALL); 

// Check PHP version
if(phpversion() < '5.2.0')
{
 die('It is highly advisable to update your PHP Version. Currently you have version '.PHP_VERSION);
}

$files = ['lang.class.php', 'template/index.php'];

// Include lang class
if (file_exists($files[0])) {
    require_once $files[0];
}

// Create new instance of lang class
$lang = new Lang();
$cookieName = $lang -> config['cookieName'];

// If exists $_GET, set new languages
if(isset($_GET[$cookieName]))
{
 $lang -> setLang($_GET[$cookieName]);
}

// Include main file with HTML code
if (file_exists($files[1])) {
    require_once $files[1];
}
// Finish buffering
ob_end_flush();
