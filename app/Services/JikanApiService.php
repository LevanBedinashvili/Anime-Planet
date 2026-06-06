<?php

namespace App\Services;

class JikanApiService
{
    protected string $baseUrl = 'https://api.jikan.moe/v4';

    public function request(string $endpoint, array $params = [])
    {
        $url = $this->baseUrl . $endpoint;
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        // Cache mechanism
        $cacheDir = BASE_PATH . 'storage/cache/';
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }

        $cacheFile = $cacheDir . md5($url) . '.json';
        $cacheTime = 3600;

        if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTime) {
            return json_decode(file_get_contents($cacheFile), true);
        }

        usleep(340000);

        $context = stream_context_create([
            'http' => ['ignore_errors' => true]
        ]);

        $response = file_get_contents($url, false, $context);

        if ($response !== false) {
            $data = json_decode($response, true);
            if (isset($data['data'])) {
                file_put_contents($cacheFile, $response);
            }
            return $data;
        }

        return null;
    }

    public function getTopAnime()
    {
        return $this->request('/top/anime');
    }

    public function getAnimeSearch(string $query, int $page = 1)
    {
        return $this->request('/anime', ['q' => $query, 'page' => $page]);
    }

    public function getAnimeById(int $id)
    {
        return $this->request("/anime/{$id}");
    }

    public function getAnimeCharacters(int $id)
    {
        return $this->request("/anime/{$id}/characters");
    }

    public function getAiringAnime()
    {
        return $this->request('/seasons/now');
    }

    public function getUpcomingAnime()
    {
        return $this->request('/seasons/upcoming');
    }

    public function getRandomAnime()
    {
        return $this->request('/random/anime', ['bypass_cache' => time()]);
    }

    public function getSchedule(string $day = '')
    {
        $params = [];
        if (!empty($day)) {
            $params['filter'] = $day;
        }
        return $this->request('/schedules', $params);
    }
}
