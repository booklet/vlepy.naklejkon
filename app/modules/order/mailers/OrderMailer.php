<?php
namespace Order;

use AppMailer;
use Config;

class OrderMailer extends AppMailer
{
    public function newOrder($order, $products, $files)
    {
        $subject = 'Nowe zamówienie ze strony vlepy.naklejkon.pl';
        $recipients = Config::get('mailing_address');
        $body = $this->renderBody(__CLASS__ . '#' . __FUNCTION__, [
            'customer_first_name' => $order['customer_first_name'],
            'customer_last_name' => $order['customer_last_name'],
            'customer_email' => $order['customer_email'],
            'customer_phone_number' => $order['customer_phone_number'],
            'street' => $order['street'],
            'house_number' => $order['house_number'],
            'zip_code' => $order['zip_code'],
            'city' => $order['city'],
            'products' => $products,
        ]);

        $this->send($subject, $recipients, $body, $files, $order['customer_email']);

        return $this;
    }
}
