<?php

namespace App\Controllers;

use Core\Controller;
use App\Services\JikanApiService;

class RandomController extends Controller
{
    public function index()
    {
        $jikan = new JikanApiService();
        $animeResponse = $jikan->getRandomAnime();

        if (isset($animeResponse['data']['mal_id'])) {
            header("Location: /details/" . $animeResponse['data']['mal_id']);
            exit;
        }

        header("Location: /catalog");
        exit;
    }
}
