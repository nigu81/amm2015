
<?php

include_once 'controller/newsController.php';

FrontController::dispatch($_REQUEST);

class FrontController {

    public static function dispatch(&$request) {
        // niente switch in questo caso, 
        // la pagina e' davvero una sola
        $controller = new NewsController();
        $controller->handleInput($request);
    }

}
?>
