<?php
namespace App\Voters;

use DateTime;
use App\Entity\Commande;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


class DateVoter extends Voter
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
        $interval = new DateInterval('P7d');
        $datetime1 = new DateTime('today');
        
        
        

        if ($subject->getDateCommande() < $datetime1->sub($interval))
        {
            return false;
        }

        return true;


    }
}