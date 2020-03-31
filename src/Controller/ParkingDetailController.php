<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ParkingDetailController extends AbstractController
{
    /**
     * @Route("/parking/detail", name="parking_detail")
     */
    public function index()
    {
        return $this->render('parking_detail/index.html.twig', [
            'controller_name' => 'ParkingDetailController',
        ]);
    }
}
