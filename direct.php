<?php
  header('Content-type: text/plain');
  include_once 'funzioni.php';
  $pastebin_link = link_da_txt();
  $link_estratti = pastebin_in_array($pastebin_link);
  $link_funzionanti = verifica_link_veloce($link_estratti);
  foreach ($link_funzionanti as $value) {
    echo $value."\n";
  }
?>
