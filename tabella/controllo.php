<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
      <h1 style="text-align: center;font-size: 6em;">Controllo liste</h1>
      <h1 style="text-align: center;font-size: 6em;color: orange;">veezie</h1>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Link</th>
        </tr>
      </thead>
      <tbody>

        <?php
          // legge il contenuto dei link pastebin
          $link_pastebin = $_POST['link_pastebin'];
          $values = preg_split('/\r\n|\r|\n/', $link_pastebin);
          $values = array_filter($values);

          $clean = array();
          foreach ($values as $value) {
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
          // elimina i doppioni
          $clean = array_unique($clean);

          $counter = 1;
          $counter_success = 0;
          $counter_danger = 0;
          foreach ($clean as $value) {
            $passaggio_a = str_replace("https://","",$value);
            $host = str_replace("/","",$passaggio_a);
            if($socket =@ fsockopen($host, 80, $errno, $errstr, 30)) {
              echo '<tr class="table-success">
                      <th scope="row">'.$counter.'</th>
                      <td>'.$value.'</td>
                    </tr>';
                    fclose($socket);
                    $counter_success++;
            } else {
              echo '<tr class="table-danger">
                      <th scope="row">'.$counter.'</th>
                      <td>'.$value.'</td>
                    </tr>';
                    $counter_danger++;
            }
            ob_flush();
            flush();
            $counter++;
          }
          ob_end_flush();
        ?>
      </tbody>
    </table>

    <div class="row">
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title">Link totali</h1>
            <h2 class="card-text"><?php echo $counter_success+$counter_danger; ?></h2>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div style="background-color: green;color: white;" class="card">
          <div class="card-body">
            <h1 class="card-title">Link funzionanti</h1>
            <h2 class="card-text"><?php echo $counter_success; ?></h2>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div style="background-color: red;color: white;" class="card">
          <div class="card-body">
            <h1 class="card-title">Link corrotti</h1>
            <h2 class="card-text"><?php echo $counter_danger; ?></h2>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <img style="width: 12em;margin-top: 2em;" src="/content/logo.png" />
      <p>Creata da Glitch con tanto tanto tantissimo amore</p>
      <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">
        <img alt="Licenza Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" />
      </a><br />
      Quest'opera è distribuita con Licenza <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribuzione - Non commerciale - Condividi allo stesso modo 4.0 Internazionale</a>.
      <p style="margin-top: 2em;font-size: 0.5em;">Questa app scritta in php ha il solo scopo educativo e di dimostrazione, il creatore dell'app e il team glitch non si assumono la responsabilità di quello che può accadere al dispositivo.<br>
      Utilizzando e/o avviando questa applicazione accetti di esonerare da ogni responsabilità il creatore dell'app e il team di sviluppo Glitch. Veezie non è un marchio di nostra proprietà tanto meno il suo codice, tutti i diritti riservati ai relativi propritari</p>
      <p style="color: white;">Leggere attentamente il foglietto illustrativo, tenere lontano dalla portata dei bambini.</p>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
