<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use App\Services\JikanApiService;

class ScheduleController extends Controller
{
    protected JikanApiService $apiService;

    public function __construct()
    {
        $this->apiService = new JikanApiService();
    }

    public function index()
    {
        $validDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        $day = strtolower(Request::input('day') ?? '');

        if (!in_array($day, $validDays)) {
            $day = strtolower(date('l'));
        }

        $scheduleData = $this->apiService->getSchedule($day);
        $animeList = $scheduleData['data'] ?? [];

        return $this->render('schedule/index', [
            'animeList' => $animeList,
            'currentDay' => $day,
            'days' => [
                'monday' => 'ორშაბათი',
                'tuesday' => 'სამშაბათი',
                'wednesday' => 'ოთხშაბათი',
                'thursday' => 'ხუთშაბათი',
                'friday' => 'პარასკევი',
                'saturday' => 'შაბათი',
                'sunday' => 'კვირა'
            ]
        ]);
    }
}
