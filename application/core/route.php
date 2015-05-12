<?php

class Route
{
    static $subfolder = ''; //имя подпапки сайта
    static $controller_name = 'news';
    static $action_name = 'index';

    static function get_addr() {

        // костыль для подпапки
        if(Route::$subfolder != '')
        {
            Route::$subfolder = (substr(Route::$subfolder,-1)=='/')?Route::$subfolder:Route::$subfolder.'/';
        }

        $uri_block = count(explode('/',Route::$subfolder))-1;
        $uri_controller = 1+$uri_block;
        $uri_action = 2+$uri_block;


        $no_mark = explode('?', $_SERVER['REQUEST_URI'])[0];
        $no_hash = explode('#', $no_mark)[0];

        $routes = explode('/', $no_hash);

        // получаем имя контроллера
        if ( !empty($routes[$uri_controller]) )
        {
            Route::$controller_name = $routes[$uri_controller];
        }

        // получаем имя экшена
        if ( !empty($routes[$uri_action]) )
        {
            Route::$action_name = $routes[$uri_action];
        }
    }

    static function start()
    {
        Route::$subfolder = GlobalStorage::get('folder');

        //получаем имя подкаталога, контроллер и action
        Route::get_addr();

        // контроллер и действие по умолчанию
        $controller_name = Route::$controller_name;
        $action_name = Route::$action_name;


        // добавляем префиксы
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;

        // подцепляем файл с классом модели (файла модели может и не быть)

        $model_file = strtolower($model_name).'.php';
        $model_path = "application/models/".$model_file;
        if(file_exists($model_path))
        {
            include "application/models/".$model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "application/controllers/".$controller_file;
        }
        else
        {
            if(strcmp($_SERVER['REQUEST_URI'], '/' . Route::$subfolder . 'index.php') == 0) {
                $host = 'http://'.$_SERVER['HTTP_HOST'].'/' . Route::$subfolder;
                header('Location:'.$host);
                exit();
            }

            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */

            Route::ErrorPage404();

        }

        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            $controller->$action();
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }

    }

    static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/' . Route::$subfolder;
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}

?>