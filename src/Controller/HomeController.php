<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Artist;
use App\Hello\HelloWorld;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(HelloWorld $h)
    {

        

            //var_dump($artists);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'messageTestService'=> $h->yoUpper(),
        ]);
    }


    public function showArtists(){

        $artists = $this->getDoctrine()
            ->getRepository(Artist::class)
            ->findAll();

            return $this->render('home/asideArtist.html.twig', [
                'controller_name' => 'HomeController',
                'artists' => $artists
            ]);
    }

    public function showEvents()
    {
        $events = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findAll();

            return $this->render('home/asideEvent.html.twig', [
                'events' => $events
            ]);
    }

    
}



