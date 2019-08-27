<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\ArtistRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(EventRepository $event, ArtistRepository $artist)
    {
    
        $result = $event->findArtistByEvent();//find créé dans le EventRepository
        
        //une autre requete plus poussée avec un choix par pays
        $request1 = $artist->findByArtist();//find crée dans le ArtistRepository

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'result' => $result,
            'request1' => $request1
        ]);
    }
}
