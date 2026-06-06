<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use App\Services\JikanApiService;

class CatalogController extends Controller
{
    public function index()
    {
        $query = Request::input('q', '');
        $page = (int)Request::input('page', 1);
        $orderBy = Request::input('order_by', 'score');
        $sort = Request::input('sort', 'desc');

        $params = ['page' => $page, 'order_by' => $orderBy, 'sort' => $sort];
        if ($query !== '') {
            $params['q'] = $query;
        }

        $jikan = new JikanApiService();
        $animeResponse = $jikan->request('/anime', $params);
        
        return $this->render('catalog/index', [
            'animeList' => $animeResponse['data'] ?? [],
            'pagination' => $animeResponse['pagination'] ?? [],
            'query' => $query
        ]);
    }
}
