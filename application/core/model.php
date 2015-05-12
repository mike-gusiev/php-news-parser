<?php

abstract class Model
{
    public function get_cms()
    {
        $cms_files = scandir('db/cms');

        $CMS = Array();

        foreach($cms_files as $filename) {
            if($filename == '.' || $filename == '..') continue;
            $CMS[] = strtoupper(str_replace('.php','',$filename));
        }

        return $CMS;
    }

    abstract public function get_data();

}

?>