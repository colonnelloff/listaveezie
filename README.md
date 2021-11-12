
# Generatore e ottimizzatore liste per veezie

Questo generatore ti permette di unire più liste canali automatiche SOLO PASTEBIN in un'unica lista, eliminando link non funzionanti o chiusi e generando una lista autoaggiornante in modo diretto o tramite link pastebin.


# Installazione

Il codice è gia pronto per l'utilizzo, basta creare un server LAMP, apache2 o nginx, per semplificazione utilizzeremo nell'esempio XAMPP.

Installare xampp da questo link https://www.apachefriends.org/it/ 
* avviare il programma
* avviare apache
* inserire nella cartella /htdocs/ i file scaricati da github
* avviare tramite localhost o tramite dominio dell'hosting se hostato

# Utilizzo

# * pastebin.txt
Dove verranno inserite le liste canali autoaggiornanti prese dal web, ricordati solo di non mettere spazi e di andare a capo!

# * index.php
GUI con la possibilità di generare link pastebin diretto.
Da anche la possibilità di copiare e incollare i link direttamente attraverso l'app

# * direct.php
Lista autogenerata sul momento come testo, utilizzabile direttamente attraverso veezie

# * funzioni.php
Tutte le funzioni che permettono il perfetto funzionamento del codice pronte per essere modificate.

# * credenziali.php
Compilare tutte le credenziali necessarie se si vuole utilizzare la funzione di generazione di link pastebin





## Installazione raspberry pi

```bash
    sudo apt-get update && sudo apt-get upgrade
    sudo apt-get install apache2 -y
    sudo apt-get install php -y
    sudo service apache2 stop
    sudo rmdir /var/www/html
    sudo mkdir /var/www/html

    //inserire qua i file scaricati da github
    cd /var/www/html

    sudo service apache2 start

```

per connettersi usare l'ip della raspberry e la sua porta settata in apache2 (solitamente la porta 80)
    
## Demo GUI

https://veezielist.herokuapp.com/


## Demo direct.php

https://veezielist.herokuapp.com/direct.php


## Screenshots

![App Screenshot](https://iili.io/5Wfwkg.md.png)

# IMPORTANTE!
Creare un proprio server potrebbe essere utile per evitare ritardi, blocchi o altri problemi che ci potrebbero essere.
Il server demo funziona per un numero limitato di persone e una volta sovracaricato sarà inutilizzabile!
Il team glitch e i suoi sviluppatori e il capo del team non sono in alcun modo associati o collaboratori di Veezie.

# Tutto bello, ma perchè?
Volevo che ognuno potesse avere la possibilità di generare la propria lista sempre funzionante per il meraviglioso programma veezie.
