<?php

namespace App\EventListener;

use App\Event\RegisterEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegisterSubscriber implements EventSubscriberInterface
{

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function displayRegistrationMessage()
    {
        $this->session->getFlashBag()->add('success', 'vous avez bien été enregistré!');
    }

    public function dumpResponse(KernelEvent $event)
    {
        //var_dump($event->getResponse()->getContent());
    }

    public static function getSubscribedEvents()
    {
        return [
            RegisterEvent::NAME => ['displayRegistrationMessage', -10],
            KernelEvents::RESPONSE => ['dumpResponse', -10]
        ];
    }
}