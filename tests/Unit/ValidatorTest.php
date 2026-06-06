<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Core\Validator;

class ValidatorTest extends TestCase
{
    public function test_it_validates_required_fields()
    {
        $rules = ['name' => 'required'];
        
        $dataPass = ['name' => 'John'];
        $this->assertEmpty(Validator::validate($dataPass, $rules));

        $dataFail = ['name' => ''];
        $errors = Validator::validate($dataFail, $rules);
        $this->assertArrayHasKey('name', $errors);
        $this->assertEquals('The name field is required.', $errors['name'][0]);

        $dataFailMissing = [];
        $errorsMissing = Validator::validate($dataFailMissing, $rules);
        $this->assertArrayHasKey('name', $errorsMissing);
    }

    public function test_it_validates_emails()
    {
        $rules = ['email' => 'required|email'];

        $dataPass = ['email' => 'test@example.com'];
        $this->assertEmpty(Validator::validate($dataPass, $rules));

        $dataFail = ['email' => 'invalid-email'];
        $errors = Validator::validate($dataFail, $rules);
        $this->assertArrayHasKey('email', $errors);
        $this->assertEquals('The email field must be a valid email address.', $errors['email'][0]);
    }

    public function test_it_validates_min_length()
    {
        $rules = ['password' => 'min:6'];

        $dataPass = ['password' => '123456'];
        $this->assertEmpty(Validator::validate($dataPass, $rules));

        $dataFail = ['password' => '12345'];
        $errors = Validator::validate($dataFail, $rules);
        $this->assertArrayHasKey('password', $errors);
        $this->assertEquals('The password field must be at least 6 characters.', $errors['password'][0]);
    }

    public function test_it_validates_max_length()
    {
        $rules = ['username' => 'max:10'];

        $dataPass = ['username' => '1234567890'];
        $this->assertEmpty(Validator::validate($dataPass, $rules));

        $dataFail = ['username' => '12345678901'];
        $errors = Validator::validate($dataFail, $rules);
        $this->assertArrayHasKey('username', $errors);
        $this->assertEquals('The username field must not exceed 10 characters.', $errors['username'][0]);
    }

    public function test_it_returns_multiple_errors_for_multiple_rules()
    {
        $rules = ['field' => 'required|email|min:10'];
        $dataFail = ['field' => 'bad'];

        $errors = Validator::validate($dataFail, $rules);
        $this->assertArrayHasKey('field', $errors);
        
        // It should fail both email and min:10
        $this->assertCount(2, $errors['field']);
    }

    public function test_it_throws_exception_on_unknown_rule()
    {
        $rules = ['field' => 'unknown_rule'];
        $data = ['field' => 'value'];

        $this->expectException(\InvalidArgumentException::class);
        Validator::validate($data, $rules);
    }
}
