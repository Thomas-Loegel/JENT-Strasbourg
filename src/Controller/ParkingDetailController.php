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
        // RECUPERATION DES PARKINGS DE L'API
        $client1   = HttpClient::create();
        $response1 = $client1->request('GET', "https://data.strasbourg.eu/api/records/1.0/search/?dataset=occupation-parkings-temps-reel&facet=etat_descriptif&refine.idsurfs=$id");
        $content1  = $response1->toArray();
        $records1  = $content1["records"];
        $parking1  = $records1[0];
        $fields1   = $parking1["fields"];


        // RECUPERATION DES INFOS DE L'API
        $client2   = HttpClient::create();
        $response2 = $client2->request('GET', "https://data.strasbourg.eu/api/records/1.0/search/?dataset=parkings&refine.idsurfs=$id");
        $content2  = $response2->toArray();
        $records2  = $content2["records"];
        $parking2  = $records2[0];
        $fields2   = $parking2["fields"];


        // RECUPERATION DES DONNÉES PARKINGS
        $etat_descriptif = $fields1["etat_descriptif"];
        $name  = $fields1["nom_parking"];
        $etat  = $fields1["etat"];
        $libre = $fields1["libre"];
        $total = $fields1["total"];


        // RECUPERATION DES DONNÉES INFOS
        $accessforwheelchair = $fields2["accessforwheelchair"];
        $more        = $fields2["friendlyurl"];
        $address     = $fields2["address"];


        // ENVOI DES INFOS A LA VUE
        return $this->render('parking_detail/index.html.twig', [
            'controller_name'     => 'ParkingDetailController',
            'etat_descriptif'     => $etat_descriptif,
            'name'                => $name,
            'etat'                => $etat,
            'libre'               => $libre,
            'total'               => $total,
            'more'                => $more,
            'address'             => $address,
            'accessforwheelchair' => $accessforwheelchair,
        ]);
    }
}
