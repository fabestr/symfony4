<?php

namespace App\EventListener;

use App\Event\RegisterEvent;


class RegisterListener
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMailToUser(RegisterEvent $e )
    {
        var_dump('coucou');
        // Create the message
        $message = (new \Swift_Message())
        // Add subject
        ->setSubject('Here should be a subject')

        //Put the From address 
        ->setFrom(['support@mailtrap.io'])

        // Include several To addresses
        ->setTo(['f.estrabaud@gmail.com' => 'New Mailtrap user'])
        ->setCc([
        'support@mailtrap.io',
        'product@mailtrap.io' => 'Product manager'
        ])
        ->setBody('My <em>amazing</em> body', 'text/html');

        $this->mailer->send($message);
    }
}