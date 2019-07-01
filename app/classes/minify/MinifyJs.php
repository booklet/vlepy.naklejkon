<?php
class MinifyJs
{
    use MinifyTrait;

    const MINIFY_TYPE = 'JS';
    const FILES_PATH = 'public/assets/js/';
    const OUTPUT_MINIFY_PATH = 'public/assets/js/minified/';
    const MINIFY_FILE_PREFIX = 'application-';
    const MINIFY_FILE_EXTENSION = '.js';
}
