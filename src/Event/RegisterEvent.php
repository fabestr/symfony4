<?php
namespace App\Event;



use Symfony\Contracts\EventDispatcher\Event;
use App\Entity\User;

final class RegisterEvent extends Event
{
    public const NAME = 'user.register';

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }
}