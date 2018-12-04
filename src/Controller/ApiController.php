<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/catalog-locations", name="app_api_catalog_locations")
     */
    public function getCatalogLocations()
    {
        $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/test_data/catalog_locations.json');

        if ($file === false) {
            $file = json_encode([]);
        }

        $response = new Response();
        $response->setContent($file);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/catalog-goods", name="app_api_catalog_goods")
    */
    public function getCatalogGoods()
    {
        $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/test_data/catalog_goods.json');

        if ($file === false) {
            $file = json_encode([]);
        }

        $response = new Response();
        $response->setContent($file);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/quantity-goods-location/{locationId</d+>}", name="app_api_quantity_goods_location")
    */
    public function getQuntityGoodsInLocation($locationId)
    {
        $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/test_data/catalog_goods.json');
        $goods = json_encode($file, true);
        $data = [];

        foreach ($goods as $item) {
            $data[$item['id']] = random_int(0, 100);
        }

        $data = json_encode($data);
        $response = new Response();
        $response->setContent($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}