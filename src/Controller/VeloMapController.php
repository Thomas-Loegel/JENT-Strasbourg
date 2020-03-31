<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VeloMapController extends AbstractController
{
    /**
     * @Route("/velo/map", name="velo_map")
     */
    public function index()
    {
        return $this->render('velo_map/index.html.twig', [
            'controller_name' => 'VeloMapController',
        ]);
    }
}
