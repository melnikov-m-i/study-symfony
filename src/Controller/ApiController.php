<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/catalog-locations", name="app_api_catalog_locations")
     */
    public function getCatalogLocations()
    {
        $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../test_data/catalog_locations.json');

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
        $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../test_data/catalog_goods.json');

        if ($file === false) {
            $file = json_encode([]);
        }

        $response = new Response();
        $response->setContent($file);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route(
     *     "/api/quantity-goods-location/{locationId}",
     *     name="app_api_quantity_goods_location",
     *     requirements={"locationId"="\d+"})
    */
    public function getQuantityGoodsInLocation($locationId)
    {
        $catalogLocations = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../test_data/catalog_locations.json');
        $locations = json_decode($catalogLocations, true);
        $catalogGoods = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../test_data/catalog_goods.json');
        $goods = json_decode($catalogGoods, true);
        $data = [];

        if(!empty($locations) && array_search($locationId, array_column($locations, 'id')) !== false) {
            foreach ($goods as $item) {
                $data[$item['id']] = random_int(0, 100);
            }
        }

        $data = json_encode($data);

        $response = new Response();
        $response->setContent($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}