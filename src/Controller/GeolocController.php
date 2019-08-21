<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GeolocController extends AbstractController
{

    public function localize($request)
    {
        
        $url = "https://api-adresse.data.gouv.fr/search/?q=";
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL,  $url.$request);
        curl_setopt($c, CURLOPT_HEADER,  0);
        curl_setopt($c, CURLOPT_TIMEOUT,  4);
        curl_setopt($c, CURLOPT_RETURNTRANSFER,  1);
        $response = curl_exec($c);
        curl_close($c);

        $responseDecode = json_decode($response,true);
        
        //var_dump($response);
        return $responseDecode;
    }
}
