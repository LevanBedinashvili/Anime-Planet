<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\JikanApiService;

class JikanApiServiceTest extends TestCase
{
    public function test_getTopAnime_calls_correct_endpoint()
    {
        $mock = $this->getMockBuilder(JikanApiService::class)
                     ->onlyMethods(['request'])
                     ->getMock();

        $mock->expects($this->once())
             ->method('request')
             ->with('/top/anime')
             ->willReturn(['data' => []]);

        $result = $mock->getTopAnime();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
    }

    public function test_getAnimeSearch_passes_correct_params()
    {
        $mock = $this->getMockBuilder(JikanApiService::class)
                     ->onlyMethods(['request'])
                     ->getMock();

        $mock->expects($this->once())
             ->method('request')
             ->with('/anime', ['q' => 'naruto', 'page' => 2])
             ->willReturn(['data' => []]);

        $result = $mock->getAnimeSearch('naruto', 2);
        $this->assertIsArray($result);
    }

    public function test_getSchedule_passes_correct_filter()
    {
        $mock = $this->getMockBuilder(JikanApiService::class)
                     ->onlyMethods(['request'])
                     ->getMock();

        $mock->expects($this->once())
             ->method('request')
             ->with('/schedules', ['filter' => 'monday'])
             ->willReturn(['data' => []]);

        $result = $mock->getSchedule('monday');
        $this->assertIsArray($result);
    }

    public function test_getAnimeById_constructs_correct_url()
    {
        $mock = $this->getMockBuilder(JikanApiService::class)
                     ->onlyMethods(['request'])
                     ->getMock();

        $mock->expects($this->once())
             ->method('request')
             ->with('/anime/1')
             ->willReturn(['data' => ['mal_id' => 1]]);

        $result = $mock->getAnimeById(1);
        $this->assertEquals(1, $result['data']['mal_id']);
    }
}
