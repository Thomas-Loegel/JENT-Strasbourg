<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ParkingMapController extends AbstractController
{
    /**
     * @Route("/parking/map", name="parking_map")
     */
    public function index()
    {
        return $this->render('parking_map/index.html.twig', [
            'controller_name' => 'ParkingMapController',
        ]);
    }
}
