<?php

class ApplicationHelper
{
    public static function minifyCss()
    {
        $files = Config::get('css_files');
        $minify = new MinifyCss($files);
        $minify->minify();
        $url = $minify->getMinifyFilePath();

        return '<link rel="stylesheet" type="text/css" href="/' . $url . '">';
    }

    public static function minifyJs()
    {
        $files = Config::get('js_files');
        $minify = new MinifyJs($files);
        $minify->minify();
        $url = $minify->getMinifyFilePath();

        return '<script type="text/javascript" src="/' . $url . '?t=' . time() . '"></script>';
    }
}
