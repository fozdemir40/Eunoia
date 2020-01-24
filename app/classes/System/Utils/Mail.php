<?php namespace System\Utils;

use System\Utils\Logger;


class Mail
{
    private $transport;

    private function init()
    {
        $this->transport = (new \Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername(TEST_MAIL)
            ->setPassword(TEST_PASS);

        return $this->transport;
    }

    static public function send_mail($to, $body, $subject): bool
    {
        $mailer = new \Swift_Mailer((new Mail)->init());

        if(filter_var($to, FILTER_VALIDATE_EMAIL)){
            $message = (new \Swift_Message($subject))
                ->setFrom([TEST_MAIL => 'Eunoia'])
                ->setTo($to)
                ->setBody($body);

            $result = $mailer->send($message);

            return $result;
        } else {
            $error = new Logger();
            $error->error(new \Exception("Email is not validated"));

            $result = false;

            return $result;
        }





    }

}