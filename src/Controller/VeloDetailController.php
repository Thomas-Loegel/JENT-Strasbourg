<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VeloDetailController extends AbstractController
{
    /**
     * @Route("/velo/detail", name="velo_detail")
     */
    public function index()
    {
        return $this->render('velo_detail/index.html.twig', [
            'controller_name' => 'VeloDetailController',
        ]);
    }
}
