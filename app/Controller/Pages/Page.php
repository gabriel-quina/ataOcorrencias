<?php

namespace App\Controller\Pages;

use App\Utils\View;

/**
 * Class Page
 * @package App\Controller\Pages
 */
class Page
{
    /**
     * Método responsáel por retornar o conteúdo (view) da nossa página genérica
     * @param $title
     * @param $content
     * @return string
     */
    public static function getPage($title, $content)
    {
        return View::render('pages/page',[
            'title' => $title,            
            'content' => $content
        ]);
    }
}