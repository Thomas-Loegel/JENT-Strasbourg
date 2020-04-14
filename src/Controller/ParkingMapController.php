<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;

class ParkingMapController extends AbstractController
{
    /**
     * @Route("/parking/map", name="parking_map")
     */
    public function index()
    {
        return $this->render('parking_map/index.html.twig', [
            'controller_name' => 'ParkingMapController'
        ]);
    }

    
    /**
     * @Route("/parking/mapData", name="parking_mapData")
     */
    public function getData()
    {
        // RECUPERATION DU NOMBRE DE PARKINGS
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://data.strasbourg.eu/api/records/1.0/search/?dataset=parkings&rows=0');
        $content = $response->toArray();

        $nhits = $content['nhits']; // nbr de parkings

        // INSERTION DU NB DE PARKINGS DANS URL
        $response = $client->request('GET', "https://data.strasbourg.eu/api/records/1.0/search/?dataset=parkings&rows=$nhits");
        $content = $response->getContent();


        // RECUPERATION DES DONNÉES 
        $contentArray = $response->toArray();
        $records = $contentArray["records"];


        for ($i = 0; $i < $nhits; $i++) {
            $parkings = $records[$i];
            $fields = $parkings['fields'];

            $name = $fields['name'];
            $address = $fields['address'];
            $position = $fields['position']; // retourne un tableau avec index 0 : axe hotizontal et index 1 axe vertical
            $idsurfs = $fields['idsurfs'];

            $infoParking[$i] = [
                'name' => $name,
                'address' => $address,
                'positionX' => $position[0],
                'positionY' => $position[1],
                'idsurfs' => $idsurfs
            ];
        }

        $response = new JsonResponse($infoParking);
        return $response; 
    }
}
