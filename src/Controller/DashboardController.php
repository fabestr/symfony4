<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(EventRepository $event)
    {
        $result = $event->findArtistByEvent();
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'result' => $result
        ]);
    }
}
