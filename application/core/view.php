<?php

class View
{
    function generate($content_view, $data = null, $cms_list = null, $view_type = null)
    {
        global $smarty;
        $smarty->assign('subfolder',Route::$subfolder);
        $smarty->assign('content_view',$content_view);
        $smarty->assign('data',$data);
        $smarty->assign('cms_list',$cms_list);
        $smarty->assign('view_type',$view_type);

        $smarty->display('index.tpl');
    }
}

?>