<?php
class Routing
{
    public static function path(string $name, array $params = [], array $extra_params = [])
    {
        $router = Config::get('router');
        $path = $router->generate($name, $params);

        if (!empty($extra_params)) {
            $path .= '?' . http_build_query($extra_params);
        }

        return $path;
    }

    public static function url(string $path_name, array $params = [], array $extra_params = [])
    {
        return Config::get('web_address') . self::path($path_name, $params, $extra_params);
    }

    public static function previous()
    {
        return $_SERVER['HTTP_REFERER'] ?? null;
    }

    public static function redirect(string $destination)
    {
        @header('Location: ' . $destination);
        exit();
    }

    public static function generatePathAndRedirect(string $path_name, array $path_params = [], array $extra_params = [])
    {
        $path = self::path($path_name, $path_params, $extra_params);
        self::redirect($path);
    }

    public static function redirectPrevious(string $alternative_location = '/')
    {
        $location = self::previous() ?? $alternative_location;
        self::redirect($location);
    }

    public static function redirectPreviousOrGenerateAlternativePathAndRedirect(string $path_name, array $path_params = [], array $extra_params = [])
    {
        $location = self::previous() ?? self::path($path_name, $path_params, $extra_params);
        self::redirect($location);
    }
}
