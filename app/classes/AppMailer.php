<?php
class AppMailer
{
    private $client;
    private $subject;
    private $recipients;
    private $body;
    private $from_name;
    private $from_email;
    private $reply_to;
    private $request_body;
    private $response;
    private $error;

    public function __construct()
    {
        $this->client = Aws\Ses\SesClient::factory([
            'version' => 'latest',
            'region' => 'eu-west-1',
            'credentials' => [
                'key' => Config::get('aws_access_key_id'),
                'secret' => Config::get('aws_secret_access_key'),
            ],
        ]);

        $this->request_body = [];
        $this->response = null;
        $this->error = null;
    }

    public function send(string $subject, $recipients, string $body, array $attachments = [], string $reply_to = null)
    {
        if (!is_array($recipients)) {
            $recipients = [$recipients];
        }

        $from_name = Config::get('mailing_from_name');
        $from_email = Config::get('mailing_from_email');
        $reply_to = $reply_to ?? Config::get('mailing_reply_to');

        $mail_mime = new Mail_mime();
        $mail_mime->setTxtBody($body);
        $mail_mime->setHTMLBody($body);

        foreach ($attachments as $attachment) {
            if (is_array($attachment)) {
                $mail_mime->addAttachment($attachment['tmp_name'], $attachment['type'], $attachment['name']);
            } else {
                $mail_mime->addAttachment($attachment);
            }
        }

        $body = $mail_mime->get([
            'head_encoding' => 'UTF-8',
            'text_encoding' => 'UTF-8',
            'html_encoding' => 'UTF-8',
            'head_charset' => 'UTF-8',
            'text_charset' => 'UTF-8',
            'html_charset' => 'UTF-8',
        ]);

        $headers = $mail_mime->txtHeaders([
            'To' => join(',', $recipients),
            'From' => $from_name . '<' . $from_email . '>',
            'Reply-To' => $reply_to,
            'Subject' => $subject,
            'Content-Type' => 'text/plain; charset=UTF-8; format=flowed',
        ]);

        try {
            $this->response = $this->client->sendRawEmail([
                'RawMessage' => [
                    'Data' => $headers . "\n\n" . $body,
                ],
            ]);
        } catch (Aws\Ses\Exception\SesException $e) {
            $this->error = $e->getAwsErrorMessage();
        }
    }

    public function renderBody(string $action, array $variables = [], string $layout = 'mail')
    {
        list($mailer, $method) = explode('#', $action);

        $params = [ 'mailer' => $mailer, 'action' => $method ];
        $options = [ 'layout' => $layout ];

        $view = new View($params, $variables, $options);

        return $view->render();
    }

    public function isRequestSuccess()
    {
        return (!empty($this->response) && empty($this->error)) ? true : false;
    }

    public function response()
    {
        return $this->response;
    }

    public function error()
    {
        return $this->error;
    }
}
