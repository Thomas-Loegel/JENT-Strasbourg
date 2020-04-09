<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class ParkingDetailController extends AbstractController
{
    /**
     * @Route("/parking/detail/{id}", name="parking_detail",  methods={"GET","HEAD"})
     */
    public function index($id)
    {
        // RECUPERATION DES INFOS DE L'API
        $client   = HttpClient::create();
        $response = $client->request('GET', "https://data.strasbourg.eu/api/records/1.0/search/?dataset=occupation-parkings-temps-reel&facet=etat_descriptif&refine.idsurfs=$id");
        $content  = $response->toArray();
        $records  = $content["records"];
        $parking  = $records[0];
        $fields   = $parking["fields"];


        // RECUPERATION DES DONNÉES
        $etat_descriptif = $fields["etat_descriptif"];
        $name  = $fields["nom_parking"];
        $etat  = $fields["etat"];
        $libre = $fields["libre"];
        $total = $fields["total"];

        // ENVOI DES INFOS A LA VUE
        return $this->render('parking_detail/index.html.twig', [
            'controller_name' => 'ParkingDetailController',
            'etat_descriptif' => $etat_descriptif,
            'name'            => $name,
            'etat'            => $etat,
            'libre'           => $libre,
            'total'           => $total,
        ]);
    }
}
