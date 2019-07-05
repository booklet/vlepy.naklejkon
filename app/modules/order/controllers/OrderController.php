<?php
namespace Order;

use ApplicationController;
use ArrayUntils;
use StringUntils;
use Alerts;
use Config;
use Routing;

class OrderController extends ApplicationController
{
    public function new()
    {
        if (empty($this->params['products'])) {
            Routing::generatePathAndRedirect('root_path');
        }

        return $this->render();
    }

    public function create()
    {
        $order = $this->params['order'];
        $products = $this->params['products'];
        $files = ArrayUntils::normalizeFilesArray($_FILES)['projects'];

        foreach ($products as $product) {
            $uid = $product['uid'];
            $file = $files[$uid];

            $extension = pathinfo($files[$uid]['name'], PATHINFO_EXTENSION);
            $number_of_stickers = $product['quantity'] * Config::get('package_size');

            $filename  = $order['customer_first_name'] . '_';
            $filename .= $order['customer_last_name'] . '_';
            $filename .= $product['dimensions'] . '_';
            $filename .= $number_of_stickers . '_szt_';
            $filename .= $uid . '.' . $extension;

            $filename = StringUntils::sanitizeFileName($filename);
            $files[$uid]['name'] = $filename;

            $products[$uid]['file'] = $files[$uid];
        }

        $mailer = new OrderMailer();

        if ($mailer->newOrder($order, $products, $files)) {
            Alerts::success('Dziękujemy za złożenie zamówienia');
        } else {
            Alerts::error('Wystąpił błąd podczas składania zamówienia');
        }

        Routing::generatePathAndRedirect('root_path');
    }
}
