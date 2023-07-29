<?php

require __DIR__. '/vendor/autoload.php';


if (!defined('URL')) {
    define('URL', 'http://ata.intranet:8888/dev/ataocorrencias');
}

use App\Http\Router;
use App\Utils\View;

// Definindo o valor padrão das variáveis
View::init(['URL' => URL]);

$router = new Router(URL);

include_once __DIR__ . '/app/routes/pages.php';

$router->runRoute()->sendResponse();
