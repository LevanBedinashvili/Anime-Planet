<?php

namespace App\Controllers;

use Core\Controller;
use App\Services\JikanApiService;

class DetailsController extends Controller
{
    public function show(int $id)
    {
        $jikan = new JikanApiService();
        $anime = $jikan->getAnimeById($id);
        $characters = $jikan->getAnimeCharacters($id);
        
        return $this->render('details/index', [
            'anime' => $anime['data'] ?? null,
            'characters' => $characters['data'] ?? []
        ]);
    }
}
