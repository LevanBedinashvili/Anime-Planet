<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function test_it_can_be_instantiated_with_attributes()
    {
        $user = new User();
        $user->fill([
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 'guest'
        ]);

        $this->assertEquals('testuser', $user->username);
        $this->assertEquals('test@example.com', $user->email);
        $this->assertEquals('guest', $user->role);
    }

    public function test_it_guards_non_fillable_attributes_mass_assignment()
    {
        $user = new User();
        // Assuming Model's fill() method respects $fillable array
        $user->fill([
            'username' => 'hacker',
            'is_admin' => 1 // Should be ignored
        ]);

        $this->assertEquals('hacker', $user->username);
        $this->assertNull($user->is_admin);
    }
}
