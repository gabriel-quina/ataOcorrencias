<?php

namespace App\Controller\Pages;

use App\Utils\View;
use App\Session\Login;

class Page
{
    private static function getHeader()
    {
        return View::render('header');

    }

    private static function getFooter()
    {
        return View::render('footer');
    }

    private static function getLoggedUser()
    {
        $logged = Login::getUsuarioLogado();
        return $logged['nome'];
    }


    /**
     * Método responsável por retornar a 'view' da página genérica
     *
     * @param  string $title Título da página
     * @param  string $content Conteúdo da página
     */
    public static function getPage($title, $content)
    {
        return View::render('page', [
          'title' => $title,
          'header' => self::getHeader(),
          'footer' => self::getFooter(),
          'content' => $content,
          'loggedUser' => self::getLoggedUser()
        ]);
    }
}
