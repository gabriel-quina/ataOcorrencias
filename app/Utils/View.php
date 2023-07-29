<?php

namespace App\Utils;

class View
{
    /**
     * Variáveis padrões da View
     */
    private static $vars = [];

    /**
     * Definir dados padrões da classe
     *
     * @param  array $vars
     * @return void
     */
    public static function init($vars = [])
    {
        self::$vars = $vars;

        echo '<pre>';
        print_r($vars);
        echo '</pre>';

    }

    /**
     * Retorna o conteudo de uma view
     * @param  string $view
     * @return string
     */
    public static function getContentView($view)
    {
        $file = __DIR__. '/../../views/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : "";
    }

    public static function render($view, $vars = [])
    {
        // Conteúdo não tratado
        $contentView = self::getContentView($view);

        // União de variáveis da View
        $vars = array_merge(self::$vars, $vars);

        // Chaves do array de variáveis
        $keys = array_keys($vars);
        $keys = array_map(function ($item) {
            return '{{'.$item.'}}';
        }, $keys);

        return str_replace($keys, array_values($vars), $contentView);
    }
}
