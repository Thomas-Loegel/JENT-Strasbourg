<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class ParkingMapController extends AbstractController
{
    /**
     * @Route("/parking/map", name="parking_map")
     */
    public function index()
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
            $position = var_dump($fields['position']);

            /*
            while ($parkings) {
                $fields = $parkings['fields'];

                foreach ($fields as $key => $value) {

                    $infosParking = var_dump('clé : "' . $key . '" valeur : "' . $value . '"<br />');
                    
                $position = $fields['position'];
                $donneePosition = $position[$i];
                }
            }*/
        }



        //--ENVOI
        return $this->render('parking_map/index.html.twig', [
            'controller_name' => 'ParkingMapController',
            'content' => $content,
            '$position' => $position
        ]);
    }
}
