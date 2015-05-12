<?php

require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'core/exceptions.php';

require_once 'vendors/DbSimple/Generic.php';

set_error_handler('handleError');

//подключаем smarty
define('SMARTY_DIR',str_replace("\\","/",getcwd()).'/vendors/smarty/');
require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir('application/views/');
$smarty->setCompileDir('vendors/smarty/compile');
$smarty->setConfigDir('vendors/smarty/config');
$smarty->setCacheDir('vendors/smarty/cache');


try
{
    Route::start(); // запускаем наше MVC-приложение
}

catch(dbException $e)
{
    echo $e->errorMessage();
}

catch(Exception $e)
{
    $errorMsg =
        "Unknown error!\nLine: " . $e->getLine() . "\nFile: " . $e->getFile() .
        "\n\nMessage:\n<b>" . $e->getMessage() . "</b>";

    echo $errorMsg;
}





?>