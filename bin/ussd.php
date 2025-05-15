<?php

require_once __DIR__ . '/../menus/menus.php';;
require_once __DIR__ . '/../vendor/autoload.php';

use Harenafiantso\Prog5Ussd\Core\UssdSimulator;

$menus = getMenus();

$simulator = new UssdSimulator($menus);
$simulator->start();
