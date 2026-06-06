<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Request;

class RequestTest extends TestCase
{
    protected function setUp(): void
    {
        // Reset globals before each test
        $_GET = [];
        $_POST = [];
        $_SERVER = [];
    }

    public function test_uri_returns_correct_path()
    {
        $_SERVER['REQUEST_URI'] = '/test/path?query=1';
        $this->assertEquals('/test/path', Request::uri());

        $_SERVER['REQUEST_URI'] = '/';
        $this->assertEquals('/', Request::uri());
    }

    public function test_method_returns_correct_http_method()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $this->assertEquals('POST', Request::method());

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $this->assertEquals('GET', Request::method());
    }

    public function test_isMethod_helper()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $this->assertTrue(Request::isMethod('POST'));
        $this->assertFalse(Request::isMethod('GET'));

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $this->assertTrue(Request::isMethod('GET'));
        $this->assertFalse(Request::isMethod('POST'));
    }

    public function test_input_retrieves_query_and_form_parameters()
    {
        $_GET['name'] = 'John';
        $_POST['email'] = 'test@example.com';
        
        $this->assertEquals('John', Request::input('name'));
        $this->assertEquals('test@example.com', Request::input('email'));
        $this->assertNull(Request::input('age'));
        $this->assertEquals(25, Request::input('age', 25)); // Test default
    }

    public function test_input_retrieves_from_both_get_and_post()
    {
        $_GET['from_get'] = 'get_val';
        $_POST['from_post'] = 'post_val';
        $_POST['conflict'] = 'post_wins';
        $_GET['conflict'] = 'get_loses';

        $this->assertEquals('get_val', Request::input('from_get'));
        $this->assertEquals('post_val', Request::input('from_post'));
        
        // POST should override GET in input()
        $this->assertEquals('post_wins', Request::input('conflict'));
        
        // Test default
        $this->assertEquals('fallback', Request::input('missing', 'fallback'));
    }

    public function test_all_returns_merged_array()
    {
        $_GET = ['a' => 1, 'b' => 2];
        $_POST = ['b' => 3, 'c' => 4];

        $all = Request::all();

        $this->assertEquals(1, $all['a']);
        $this->assertEquals(3, $all['b']); // POST overrides GET
        $this->assertEquals(4, $all['c']);
    }
}
