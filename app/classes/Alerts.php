<?php
class Alerts
{
    const TYPES = ['info', 'success', 'error', 'warning', 'danger'];

    public static function __callStatic($method, $arguments)
    {
        if (in_array($method, self::TYPES)) {
            $message = $arguments[0] ?? '';
            $options = $arguments[1] ?? [];

            self::addError($method, $message, $options);
        }
    }

    public static function display($options = [])
    {
        $module = $options['module'] ?? 'app';
        $alerts = $_SESSION['alerts'][$module] ?? [];

        $_SESSION['alerts'][$module] = [];

        if (empty($alerts)) {
            return null;
        }

        $html = '<div id="alerts" class="alerts--' . $module . '">';
        $html .= '<div class="alerts-wrapper">';

        foreach ($alerts as $alert) {
            $html .= self::renderAlert($alert['type'], $alert['message'], $options);
        }

        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    private static function addError($type, $message, $options = [])
    {
        $module = $options['module'] ?? 'app';

        $_SESSION['alerts'][$module][] = ['type' => $type, 'message' => $message];
    }

    private static function renderAlert($type, $message, $options = [])
    {
        $classes = [
            'alert', 'alert--' . $type,
        ];

        if (isset($options['dismissible'])) {
            $classes[] = 'alert--dismissible';
        }

        $alert = '<div class="' . join(' ', $classes) . '">';
        $alert .= $message;
        $alert .= '<div class="alert--dismiss"></div>';
        $alert .= '</div>';

        return  $alert;
    }
}
