<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;
use Tests\TestCase;
use Carbon\Carbon;

class Liem_CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testGetProductOkForCategoryIndexFunc()
    {
        $token = $this->user();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token ,
            ])->get('/api/categories')->assertStatus(200);
    }

    public function testTokenIsEmptyForCategoryIndexFunc()
    {
        $token = '';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token ,
            ])->get('/api/categories')->assertStatus(302);
    }

    // public function testTokenIsArrayForCategoryIndexFunc()
    // {
    //     $token = array();
    //     $response = $this->withHeaders([
    //         'Authorization' => 'Bearer '.$token ,
    //         ])->get('/api/categories');
    //         dd($response);
    // }

    // public function testTokenIsObjectForCategoryIndexFunc()
    // {
    //     $token = new stdClass;
    //     $response = $this->withHeaders([
    //         'Authorization' => 'Bearer '.$token ,
    //         ])->get('/api/categories');
    //         dd($response);
    // }
}
