<?php

set_time_limit(0);

function pastebin_in_array($array_p)
{
  $clean = array();
  foreach ($array_p as $value) {
    $handle = curl_init($value);
    curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($handle);
    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    if($httpCode != 404) {
        $presi = file_get_contents($value);
    }
    curl_close($handle);
    foreach(preg_split("/((\r?\n)|(\r\n?))/", $presi) as $line){
      if (strpos($line, 'https://') !== false) {
        $clean[] = $line;
      }
  }
}
$result = array_unique($clean);
return $result;
}

function verifica_link($array_l)
{
  $exported = array();
  foreach ($array_l as $value) {
    $handle = curl_init($value);
    curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($handle);
    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    if($httpCode == 200) {
      $exported[] = $value;
    }
    curl_close($handle);
  }
  return $exported;
}

function link_da_txt()
{
  $pastebin_l = array();
  $handle = fopen("pastebin.txt", "r");
  if ($handle) {
    while (($line = fgets($handle)) !== false) {
      $pastebin_l[] = preg_replace("/\r|\n/", "", $line);
    }
    fclose($handle);
  }
  return $pastebin_l;
}

function crea_link_pastebin($link_funzionanti)
{
      include_once "credenziali.php";
      $url 				= 'https://pastebin.com/api/api_post.php';
      $ch 				= curl_init($url);

      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, 'api_option=paste&api_user_key='.$api_user_key.'&api_paste_private='.$api_paste_private.'&api_paste_name='.$api_paste_name.'&api_paste_expire_date='.$api_paste_expire_date.'&api_paste_format='.$api_paste_format.'&api_dev_key='.$api_dev_key.'&api_paste_code='.$api_paste_code.'');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_VERBOSE, 1);
      curl_setopt($ch, CURLOPT_NOBODY, 0);

      $response  			= curl_exec($ch);
      $result = str_replace("https://pastebin.com/", "https://pastebin.com/raw/", $response);
      return $result;
}

function verifica_link_veloce($array_f)
{
  $check = array();
  foreach ($array_f as $value) {
    $passaggio_a = str_replace("https://","",$value);
    $host = str_replace("/","",$passaggio_a);
    if($socket =@ fsockopen($host, 80, $errno, $errstr, 30)) {
      $check[] = $value;
      fclose($socket);
    }
  }
  return $check;
}
