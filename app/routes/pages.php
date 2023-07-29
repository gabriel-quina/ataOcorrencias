<?php

use App\Http\Response;
use App\Controller\Pages;

//Rota Home
$router->get('/', [
  function () {
      return new Response(200, Pages\Home::getHome());
  }
]);

//Rota sobre
$router->get('/sobre', [
  function () {
      return new Response(200, Pages\About::getAbout());
  }
]);

//Rota ata
$router->get('/ata', [
  function () {
      return new Response(200, Pages\Ata::getAta());
  }
]);
