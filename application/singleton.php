<?php

class GlobalStorage {

    protected $data;
    protected static $instance;

    public static function singleton() {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }

    public static function set($key, $data) {
        $ins = self::singleton();
        $ins->data[$key] = $data;
    }

    public static function get($key) {
        $ins = self::singleton();
        if (isset($ins->data[$key]))
            return $ins->data[$key];
        return null;
    }

    protected function __construct() {
        $this->data = array();
    }

    protected function __wakeup() {

    }

    protected function __clone() {

    }

}

?>