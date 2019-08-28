<?php

namespace App\Voters;

use App\Entity\User;
use App\Entity\Commande;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


class UserVoter extends Voter
{
    const EDIT = 'edit';

    public function supports($attribute, $subject)
    {
        if (in_array($attribute, [self::EDIT]))
        {
            return false;
        }

        if(!$subject instanceof Commande)
        {
            return false;
        }

        return true;
    }

    public function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User)
        {
            return false;
        }

        return true;


    }
}