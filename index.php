
<?php

include_once 'mvc/trackList-controller.php';

// abilitare il mod_rewrite con
// sudo a2enmod rewrite
// 
// 
// gksudo gedit /etc/apache2/sites-available/development &
// cambiare il valore della directory development da AllowOverride none a all
// sudo service apache2 restart
// redirigiamo la richiesta con un switch
FrontController::dispatch($_REQUEST);

class FrontController {

    public static function dispatch(&$request) {
        if (isset($request["page"])) {
            switch ($request["page"]) {
                case "trackList":
                    $controller = new TrackListController();
                    $controller->handleInput($request);
                    break;
            }
        } else {
            write404();
        }
    }

    public static function write404() {
        // impostiamo il codice della risposta http a 404 (file not found)
        header('HTTP/1.0 404 Not Found');
        echo '<h1>404 Not Found </h1>';
        echo "La pagina che hai richiesto non &egrave; disponibile";
        exit();
    }

}
?>

