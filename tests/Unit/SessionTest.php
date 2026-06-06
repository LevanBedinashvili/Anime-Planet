<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Session;

class SessionTest extends TestCase
{
    protected function setUp(): void
    {
        // Reset $_SESSION
        $_SESSION = [];
    }

    public function test_it_sets_and_gets_values()
    {
        Session::set('user_id', 123);
        $this->assertEquals(123, Session::get('user_id'));
    }

    public function test_it_returns_default_when_key_missing()
    {
        $this->assertNull(Session::get('missing_key'));
        $this->assertEquals('fallback', Session::get('missing_key', 'fallback'));
    }

    public function test_it_checks_if_key_exists()
    {
        Session::set('role', 'admin');
        
        $this->assertTrue(Session::has('role'));
        $this->assertFalse(Session::has('permissions'));
    }

    public function test_it_removes_keys()
    {
        Session::set('temp', 'value');
        $this->assertTrue(Session::has('temp'));
        
        Session::remove('temp');
        $this->assertFalse(Session::has('temp'));
    }

    public function test_flash_messages_logic()
    {
        // Simulate a flash message being set during the current request
        Session::flash('success', 'Profile updated');
        
        $this->assertTrue(Session::hasFlash('success'));
        $this->assertEquals('Profile updated', Session::getFlash('success'));

        // Simulate advancing to the next request (which Session::start() does)
        $_SESSION['_flash_old'] = $_SESSION['_flash_new'] ?? [];
        $_SESSION['_flash_new'] = [];

        // The message should still be available in the next request
        $this->assertTrue(Session::hasFlash('success'));
        $this->assertEquals('Profile updated', Session::getFlash('success'));

        // Simulate advancing to a third request
        $_SESSION['_flash_old'] = $_SESSION['_flash_new'] ?? [];
        $_SESSION['_flash_new'] = [];

        // The message should be gone now
        $this->assertFalse(Session::hasFlash('success'));
        $this->assertNull(Session::getFlash('success'));
    }
}
