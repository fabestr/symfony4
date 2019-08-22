<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class HtmlExtension extends AbstractExtension
{
    public function getFilters()
    {
        return[
            new TwigFilter('figure',[$this,'figureFilter'])
        ];
    }

    public function figureFilter($eventImg, $eventDesc="gros test")
    {
        $firstBalise = '<figure><img style="max-width:200px" src="/image/';
        $secondBalise = ' "><figcaption>';
        $lastBalise = '</figcaption></figure>';

        $eventDesc = substr($eventDesc, 0,50);

        return $firstBalise.$eventImg.$secondBalise.$eventDesc.$lastBalise;
        
    }
}