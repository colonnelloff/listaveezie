<?php
  // PER GENERATORE DI LINK PASTEBIN
  $api_dev_key 			= ''; // your api_developer_key
  $api_paste_code 		= implode("\n",$link_funzionanti); // your paste text
  $api_paste_private 		= '1'; // 0=public 1=unlisted 2=private
  $api_paste_name			= 'listaveezie12345'; // name or title of your paste
  $api_paste_expire_date 		= '10M';
  $api_paste_format 		= 'gettext';
  $api_user_key 			= ''; // if an invalid or expired api_user_key is used, an error will spawn. If no api_user_key is used, a guest paste will be created
  $api_paste_name			= urlencode($api_paste_name);
  $api_paste_code			= urlencode($api_paste_code);
