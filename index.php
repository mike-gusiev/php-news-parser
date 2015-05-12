<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('open_basedir','');

require_once 'application/singleton.php';

GlobalStorage::set('folder','parser');
GlobalStorage::set('parse_limit', 50);

require_once 'application/bootstrap.php';

?>