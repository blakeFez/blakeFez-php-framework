<?php
require('frame/BlakeFez.php');
require('config.php');
define('ROOTPATH', dirname(__FILE__));
$blakeFez = new BlakeFez();
$blakeFez->run();