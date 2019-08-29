<?php

namespace App\Programmation;

use DateTime;
use App\Entity\Event;

//class sert a verifier si une date est dans un interval donné
//si la date est dans le assé ou dans le futur
//

class Programmation
{
    /* private $testingDate;

    public function __construct(DateTime $testingDate)
    {
        $this->testingDate = $testingDate;
    } */


    public function isDateExistingInAnEventInterval($testingDate, $eventBegin, $eventEnd)
    {
        //$testingDate = strtotime($testingDate);
 
        /* $eventBegin =  $testingDate - strtotime($event->getDateDebut());
        $eventEnd = $testingDate - strtotime($event->getDateFin()); */

       /*  $eventBegin =  $testingDate - strtotime($eventBegin);
        $eventEnd = $testingDate - strtotime($eventEnd);
 */
        if( $eventBegin < $testingDate && $eventEnd > $testingDate )
        {
            return true;
        }

        return false;

    }

    public function isPast($d1)
    {
        $today = new DateTime('today');

        if($d1 < $today)
        {
            return true;
        }
        return false;
    }
}