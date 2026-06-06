<?php

namespace App\Controllers;

use Core\Controller;
use App\Services\JikanApiService;

class HomeController extends Controller
{
    public function index()
    {
        $jikan = new JikanApiService();
        $topAnime = $jikan->getTopAnime();
        $airingAnime = $jikan->getAiringAnime();
        $upcomingAnime = $jikan->getUpcomingAnime();
        
        return $this->render('home/index', [
            'topAnime' => $topAnime['data'] ?? [],
            'airingAnime' => $airingAnime['data'] ?? [],
            'upcomingAnime' => $upcomingAnime['data'] ?? [],
        ]);
    }
}
