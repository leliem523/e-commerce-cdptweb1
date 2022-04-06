<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function user()
    {
        // below code is used for getting token
        $params = [
            'email' => 'hosihung@gmail.com',
            'password' => '123'
        ];

        $response = $this->post('/api/login', $params);

        $data = $response;
        $dataObj = json_decode($data->getContent(), true);

        return $dataObj['token'];
    }
}
