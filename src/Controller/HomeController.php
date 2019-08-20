<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Artist;
use App\Entity\Event;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {

        

            //var_dump($artists);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
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



