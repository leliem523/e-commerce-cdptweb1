<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;
use Tests\TestCase;
use Carbon\Carbon;

class Liem_AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testLoginOk()
    {
        $params = [
            'email' => 'hosihung@gmail.com',
            'password' => '123',
        ];
        $response = $this->get('/api/login')->assertStatus(200);

    }

    public function testParamIsEmptyForLogin()
    {
        $params = [];
        $response = $this->get('/api/login')->assertStatus(200);

    }


    public function testEmailParamIsArrayForLogin()
    {
        $params = [
            'email' => array(),
            'password' => '123',
        ];
        $response = $this->get('/api/login')->assertStatus(200);

    }

    public function testEmailParamIsObjectForLogin()
    {
        $params = [
            'email' => new stdClass,
            'password' => '123',
        ];
        $response = $this->get('/api/login')->assertStatus(200);

    }

    public function testEmailParamIsNullForLogin()
    {
        $params = [
            'email' => null,
            'password' => '123',
        ];
        $response = $this->get('/api/login')->assertStatus(200);

    }
    public function testPasswordParamIsArrayForLogin()
    {
        $params = [
            'email' => 'hosihung@gmail.com',
            'password' => array(),
        ];
        $response = $this->get('/api/login')->assertStatus(200);

    }

    public function testPasswordParamIsObjectForLogin()
    {
        $params = [
            'email' => 'hosihung@gmail.com',
            'password' => new stdClass,
        ];
        $response = $this->get('/api/login')->assertStatus(200);

    }

    public function testPasswordParamIsNullForLogin()
    {
        $params = [
            'email' => 'hosihung@gmail.com',
            'password' => null,
        ];
        $response = $this->get('/api/login')->assertStatus(200);

    }
}
