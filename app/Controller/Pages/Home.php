<?php

namespace App\Controller\Pages;

use App\Utils\View;

class Home extends Page
{
    public static function getHome()
    {

        $content = View::render('home', [
          'title' => 'Título Home',
          'modal' => ' '
        ]);

        // Retorna a view da página
        return parent::getPage('Intranet - Castseg', $content);
    }
}
