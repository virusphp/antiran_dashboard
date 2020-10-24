<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Client\Client;
use App\Transform\TransformClient;

class ClientController extends Controller
{
    protected $client;
    protected $transform;

    public function __construct()
    {
        $this->client = new Client;
        $this->transform = new TransformClient;
    }

    public function getList()
    {
        $client = $this->client->getClient();

        if(!$client->count()) {
            return response()->jsonApi(201, "Data client tidak ada!!");
        } 

        $transform = $this->transform->mapperClient($client);
        return response()->jsonApi(200, "Ok", $transform);
    }

    public function getDetail($kode)
    {
        $client = $this->client->getClientDetail($kode);

        if(!$client) {
            return response()->jsonApi(201, "Data tidak ditemukan!");
        }

        $transform = $this->transform->mapperDetail($client);
        return response()->jsonApi(200, "OK", $transform);
    } 
}
