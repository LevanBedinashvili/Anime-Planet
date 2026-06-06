<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Config;

class ConfigTest extends TestCase
{
    private string $envPath;

    protected function setUp(): void
    {
        // Create a temporary .env file for testing
        $this->envPath = sys_get_temp_dir() . '/.env.test.' . uniqid();
        $content = <<<ENV
# This is a comment
APP_NAME=TestApp
APP_ENV=testing
DB_HOST="127.0.0.1"
DB_PASS='secret'

EMPTY_VAL=
ENV;
        file_put_contents($this->envPath, $content);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->envPath)) {
            unlink($this->envPath);
        }
    }

    public function test_it_loads_env_file_correctly()
    {
        Config::load($this->envPath);

        $this->assertEquals('TestApp', Config::get('APP_NAME'));
        $this->assertEquals('testing', Config::get('APP_ENV'));
    }

    public function test_it_strips_quotes_from_values()
    {
        Config::load($this->envPath);

        $this->assertEquals('127.0.0.1', Config::get('DB_HOST'));
        $this->assertEquals('secret', Config::get('DB_PASS'));
    }

    public function test_it_returns_default_when_key_is_missing()
    {
        Config::load($this->envPath);

        $this->assertNull(Config::get('NON_EXISTENT'));
        $this->assertEquals('default_value', Config::get('NON_EXISTENT', 'default_value'));
    }

    public function test_it_throws_exception_if_file_not_found()
    {
        $this->expectException(\RuntimeException::class);
        Config::load('/path/that/does/not/exist/.env');
    }
}
