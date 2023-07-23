<?php

namespace App\Controller\Pages;

use App\Utils\View;

class Home extends Page
{
    public static function getHome()
    {

        $content = View::render('/home', [
          'modal' => '',
        ]);

        return parent::getPage('Intranet - Castseg', $content);
    }
}
