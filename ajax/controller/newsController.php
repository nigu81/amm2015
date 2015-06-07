<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once basename(__DIR__) . '/../model/News.php';
include_once basename(__DIR__) . '/../model/NewsFactory.php';

/**
 * Description of newsController
 *
 * @author amm
 */
class NewsController {

    //put your code here
    public function __construct() {
        
    }

    public function handleInput(&$request) {
        $newsList = NewsFactory::getNewsList();
        $ajaxMode = false;

        if (isset($request["cmd"])) {
            // abbiamo ricevuto un comando
            switch ($request["cmd"]) {
                case 'next':
                    $intVal = filter_var($request["id"], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                    if (!isset($intVal)) {
                        $intVal = 0;
                    }
                    $intVal++;
                    if ($intVal >= 0 && $intVal < count($newsList)) {
                        $news = $newsList[$intVal];
                    }
                    $ajaxMode = true;
                    break;
                case 'prev':
                    $intVal = filter_var($request["id"], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                    if (!isset($intVal)) {
                        $intVal = 0;
                    }
                    $intVal--;
                    if ($intVal >= 0 && $intVal < count($newsList)) {
                        $news = $newsList[$intVal];
                    }
                    $ajaxMode = true;
                    break;
            }
        } else {
            $news = $newsList[0];
        }

        if ($ajaxMode) {
            include_once 'view/ajax-news.php';
        } else {
            include_once 'view/view-news.php';
        }
    }

}

?>
