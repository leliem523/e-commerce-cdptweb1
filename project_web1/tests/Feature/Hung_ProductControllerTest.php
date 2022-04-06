<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Hung_ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    // FUNCTION SHOW
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowOk()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('api/product/a-1');

        $response->assertStatus(200);
    }

    /**
     * Show unauthenciated
     *
     * @return void
     */
    public function testShowUnauthenciated()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . '111',
        ])->get('api/product/a-1');

        $response->assertStatus(302);
    }

    /**
     * Show no token
     *
     * @return void
     */
    public function testShowNoToken()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ',
        ])->get('api/product/a-1');

        $response->assertStatus(302);
    }

    /**
     * Show no param in url
     *
     * @return void
     */
    public function testShowNoParam()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '  . $this->user(),
        ])->get('api/product/');

        $response->assertStatus(200);
    }

    /**
     * Show with url with ended character
     *
     * @return void
     */
    public function testShowEndWithString()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '  . $this->user(),
        ])->get('api/product/aaa');

        $response->assertStatus(404);
    }

    /**
     * Show with url with ended special character
     *
     * @return void
     */
    public function testShowEndWithSpecialChar()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '  . $this->user(),
        ])->get('api/product/aaa-%');

        $response->assertStatus(404);
    }

    /**
     * Show with url with ended integer but not exist in database
     *
     * @return void
     */
    public function testShowEndWithIntegerNotExist()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '  . $this->user(),
        ])->get('api/product/aaa-9999');

        $response->assertStatus(404);
    }

    /**
     * Show with url with ended double
     *
     * @return void
     */
    public function testShowEndWithDouble()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '  . $this->user(),
        ])->get('api/product/aaa-3.6');

        $response->assertStatus(404);
    }

    // //////////////////////////////////////////////////////////
    // Function getByCategory

    /**
     * getByCategory OK
     *
     * @return void
     */
    public function testgetByCategoryOK()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '  . $this->user(),
        ])->get('api/category/' .base64_encode(1 .'111'));

        $response->assertStatus(200);
    }

    /**
     * getByCategory unauthenciated
     *
     * @return void
     */
    public function testGetByCategoryUnauthenciated()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . '1111',
        ])->get('api/category/MQ==');

        $response->assertStatus(302);
    }

    /**
     * getByCategory no token
     *
     * @return void
     */
    public function testGetByCategoryNoToken()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ',
        ])->get('api/category/MQ==');

        $response->assertStatus(302);
    }

    /**
     * getByCategory no param in url
     *
     * @return void
     */
    public function testGetByCategoryNoParam()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '  . $this->user(),
        ])->get('api/category/');

        $response->assertStatus(200);
    }

    /**
     * getByCategory with url with random string
     *
     * @return void
     */
    public function testGetByCategoryStringRandom()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '  . $this->user(),
        ])->get('api/category/' . base64_encode('aaa'));

        $response->assertStatus(404);
    }

    /**
     * getByCategory with url with base 64 encode intger but not exist in database
     *
     * @return void
     */
    public function testGetByCategoryIntgerNotExist()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '  . $this->user(),
        ])->get('api/category/'. base64_encode('159'));

        $response->assertStatus(404);
    }

    /**
     * getByCategory with url with base 64 encode double
     *
     * @return void
     */
    public function testGetByCategoryDouble()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '  . $this->user(),
        ])->get('api/product/'. base64_encode('1.69'));

        $response->assertStatus(404);
    }
}
