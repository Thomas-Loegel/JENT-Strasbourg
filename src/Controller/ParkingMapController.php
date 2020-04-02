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
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://data.strasbourg.eu/api/records/1.0/search/?dataset=parkings');

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content1 = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content2 = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        $startTime = $response->getInfo('start_time');

        return $this->render('parking_map/index.html.twig', [
            'controller_name' => 'ParkingMapController',
            'statusCode' => $statusCode,
            'contentType' => $contentType,
            'content1' => $content1,
            'startTime' => $startTime
        ]);
    }
}
