<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;
use Tests\TestCase;
use Carbon\Carbon;

use function PHPUnit\Framework\assertTrue;

class Liem_ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testSearchByNameOk()
    {
        $key = 'Cây';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->user() ,
            ])->get("/api/search/$key")->assertStatus(200);
    }

    public function testSearchByNameNotFound()
    {
        $key = 'aaaaaaaa';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->user() ,
            ])->get("/api/search/$key")->assertStatus(404);
    }

    public function testSearchByNameCheckCountData()
    {
        $key = 'Cây';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->user() ,
            ])->get("/api/search/$key")->assertStatus(200);
    }

    public function testKeyParamsIsEmptySearchByName()
    {
        $key = '';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->user() ,
            ])->get("/api/search/$key")->assertStatus(200);
    }


    public function testFilterProductByRatingValue()
    {
        $params = [
            'start' => 1,
            'end' => 3
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->user() ,
            ])->post('/api/products/filter/rate', $params)->assertStatus(200);
    }

    public function testParamIsEmptyArrayForFilterProductByRatingValue()
    {
        $params = [];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->user() ,
            ])->post('/api/products/filter/rate', $params)->assertStatus(302);
    }

    public function testStartParamIsNullArrayForFilterProductByRatingValue()
    {
        $params = [
            'start' => null,
            'end' => 3
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->user() ,
            ])->post('/api/products/filter/rate', $params)->assertStatus(302);
    }

    public function testStartParamIsStringArrayForFilterProductByRatingValue()
    {
        $params = [
            'start' => 'aaa',
            'end' => 3
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->user() ,
            ])->post('/api/products/filter/rate', $params)->assertStatus(302);
    }

    public function testStartParamIsDoubleArrayForFilterProductByRatingValue()
    {
        $params = [
            'start' => 2.5,
            'end' => 3
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->user() ,
            ])->post('/api/products/filter/rate', $params)->assertStatus(302);
    }

    public function testStartParamIsNegativeArrayForFilterProductByRatingValue()
    {
        $params = [
            'start' => -2.5,
            'end' => 3
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->user() ,
            ])->post('/api/products/filter/rate', $params)->assertStatus(302);
    }

    public function testStartParamIsArrayArrayForFilterProductByRatingValue()
    {
        $params = [
            'start' => array(),
            'end' => 3
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->user() ,
            ])->post('/api/products/filter/rate', $params)->assertStatus(302);
    }

    public function testStartParamIsObjectArrayForFilterProductByRatingValue()
    {
        $params = [
            'start' => new stdClass,
            'end' => 3
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->user() ,
            ])->post('/api/products/filter/rate', $params)->assertStatus(500);
    }
}
