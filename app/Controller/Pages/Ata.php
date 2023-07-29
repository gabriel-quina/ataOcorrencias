<?php

namespace App\Controller\Pages;

use App\Utils\View;

class Home extends Page
{
    public static function getAta()
    {

        $content = View::render('ata', [
          'mensagemStatus' => ' ',
          'condominios' => '',
          'busca' => '',
          'paginacao' => ''
        ]);

        return parent::getPage('ATA - Castseg', $content);
    }

}
