<?php
class MinifyCss
{
    use MinifyTrait;

    const MINIFY_TYPE = 'CSS';
    const FILES_PATH = 'public/assets/css/';
    const OUTPUT_MINIFY_PATH = 'public/assets/css/minified/';
    const MINIFY_FILE_PREFIX = 'application-';
    const MINIFY_FILE_EXTENSION = '.css';
}
