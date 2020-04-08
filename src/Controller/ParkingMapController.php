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
        //-1-RECUPERATION DU NOMBRE DE PARKINGS
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://data.strasbourg.eu/api/records/1.0/search/?dataset=parkings&rows=0');
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        $nhits = $content['nhits'];
        // nhits = 29 (nbr de parkings)


        //-2-INSERTION DU NB DE PARKINGS DANS URL
        $response = $client->request('GET', "https://data.strasbourg.eu/api/records/1.0/search/?dataset=parkings&rows=$nhits");
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'


        //-3-RECUPERATION DES DONNÉES 
        $contentArray = $response->toArray();
        // $contentArray = ['id' => 521583, 'name' => 'symfony-docs', ...]
        $records = $contentArray["records"];

        for ($i = 0; $i < $nhits; $i++) {
            $parkings = $records[$i];
            $fields = $parkings['fields'];

            //nom du parking
            $name = $fields['name'];
            //var_dump($name);

            //adresse 
            $address = $fields['address'];

            //position géographique
            $position = $fields['position'];
            //$position retourne un tableau avec index 0 : axe hotizontal et index 1 axe vertical

            $idsurfs = $fields['idsurfs'];

            $infoParking[$i] = [
                'name' => $name,
                'address' => $address,
                'positionX' => $position[0],
                'positionY' => $position[1],
                'idsurfs' => $idsurfs
            ];
        }

        /*echo "<pre>";
        var_dump($infoParking);
        echo "</pre>";*/

        $response = new JsonResponse($infoParking);
        return $response;
    }
}
