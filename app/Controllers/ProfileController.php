<?php

namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Request;
use App\Models\UserAnimeList;
use App\Services\JikanApiService;

class ProfileController extends Controller
{
    protected function checkAuth()
    {
        if (!Session::has('user_id')) {
            header("Location: /login");
            exit;
        }
    }

    public function index()
    {
        $this->checkAuth();
        $userId = Session::get('user_id');

        $lists = UserAnimeList::query("SELECT * FROM user_anime_lists WHERE user_id = :uid", ['uid' => $userId]);

        $jikan = new JikanApiService();
        $watchlist = [];
        foreach ($lists as $list) {
            $anime = $jikan->getAnimeById($list->jikan_anime_id);
            if (isset($anime['data'])) {
                $anime['data']['user_list_id'] = $list->id;
                $watchlist[] = $anime['data'];
            }
        }

        return $this->render('profile/index', [
            'watchlist' => $watchlist,
            'username' => Session::get('username')
        ]);
    }

    public function addToWatchlist()
    {
        $this->checkAuth();
        $animeId = Request::input('anime_id');
        $userId = Session::get('user_id');

        if (!$animeId) {
            $json = json_decode(file_get_contents('php://input'), true);
            $animeId = $json['anime_id'] ?? null;
        }

        if (!$animeId) {
            echo json_encode(['error' => 'Missing anime ID']);
            return;
        }

        $existing = UserAnimeList::query("SELECT * FROM user_anime_lists WHERE user_id = :uid AND jikan_anime_id = :aid", [
            'uid' => $userId,
            'aid' => $animeId
        ]);

        if (empty($existing)) {
            $entry = new UserAnimeList();
            $entry->user_id = $userId;
            $entry->jikan_anime_id = $animeId;
            $entry->status = 'plan_to_watch';
            $entry->save();
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }

    public function removeFromWatchlist()
    {
        $this->checkAuth();
        $animeId = Request::input('anime_id');
        if (!$animeId) {
            $json = json_decode(file_get_contents('php://input'), true);
            $animeId = $json['anime_id'] ?? null;
        }
        $userId = Session::get('user_id');

        $existing = UserAnimeList::query("SELECT * FROM user_anime_lists WHERE user_id = :uid AND jikan_anime_id = :aid", [
            'uid' => $userId,
            'aid' => $animeId
        ]);

        if (!empty($existing)) {
            $existing[0]->delete();
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }
}
