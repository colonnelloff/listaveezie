
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
      <h1 style="text-align: center;font-size: 6em;">Lista veezie checker</h1>

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
          $api_dev_key 			= 'gUlF_M78PpseCI8CgeHvBg2nvt3d4MNu'; // your api_developer_key
          $api_paste_code 		= implode("\n",$link_funzionanti); // your paste text
          $api_paste_private 		= '1'; // 0=public 1=unlisted 2=private
          $api_paste_name			= 'listaveezie12345'; // name or title of your paste
          $api_paste_expire_date 		= '10M';
          $api_paste_format 		= 'gettext';
          $api_user_key 			= ''; // if an invalid or expired api_user_key is used, an error will spawn. If no api_user_key is used, a guest paste will be created
          $api_paste_name			= urlencode($api_paste_name);
          $api_paste_code			= urlencode($api_paste_code);

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

    $pastebin_link = link_da_txt();
    $link_estratti = pastebin_in_array($pastebin_link);
    $link_funzionanti = verifica_link($link_estratti);
    ?>

      <textarea style="width: 100%;height: 40em;"><?php echo implode("\n",$link_funzionanti); ?></textarea><br>
      <button style="font-size: 3em;" class="btn btn-primary">Copia</button>
    <h2 style="margin-top: 3em;">Pastebin link</h2>
    <?php echo crea_link_pastebin($link_funzionanti); ?>
    </div>

    <div class="container">
      <h1>Creata da Alessandro Congiu</h1>
      <h3>Porcodisco</h3>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    document.querySelector("button").onclick = function(){
    document.querySelector("textarea").select();
    document.execCommand('copy');
  }
  </script>
  </body>
</html>
