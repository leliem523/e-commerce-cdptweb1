<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;
use Tests\TestCase;

class Hung_UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    /**
     * RemoveProductFromCart OK
     *
     * @return void
     */
    public function testRemoveProductFromCartOK()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/delete-item-in-cart', ['id_product' => 1]);

        $response->assertStatus(200);
    }

    /**
     * RemoveProductFromCart no token
     *
     * @return void
     */
    public function testRemoveProductUnauthenciated()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ',
        ])->post('/api/delete-item-in-cart', ['id_product' => 1]);

        $response->assertStatus(302);
    }

    /**
     * RemoveProductFromCart id not found
     *
     * @return void
     */
    public function testRemoveProductFromCart_IdNotFound()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/delete-item-in-cart', ['id_product' => 100000]);

        $response->assertStatus(404);
    }

    /**
     * RemoveProductFromCart id not exist in table carts
     *
     * @return void
     */
    public function testRemoveProductFromCart_IdNotExist()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/delete-item-in-cart', ['id_product' => 10]);

        $response->assertStatus(401);
    }

    /**
     * RemoveProductFromCart no param
     *
     * @return void
     */
    public function testRemoveProductFromCart_NoParams()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/delete-item-in-cart', []);

        $response->assertInvalid(['id_product']);
    }

    /**
     * RemoveProductFromCart with empty string
     *
     * @return void
     */
    public function testRemoveProductFromCart_EmptyString()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/delete-item-in-cart', ['id_product' => '']);

        $response->assertInvalid(['id_product']);
    }

    /**
     * RemoveProductFromCart with string
     *
     * @return void
     */
    public function testRemoveProductFromCart_String()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/delete-item-in-cart', ['id_product' => 'abc']);

        $response->assertInvalid(['id_product']);
    }

    /**
     * RemoveProductFromCart with special chars
     *
     * @return void
     */
    public function testRemoveProductFromCart_SpeicalChars()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/delete-item-in-cart', ['id_product' => '$']);

        $response->assertInvalid(['id_product']);
    }

    /**
     * RemoveProductFromCart with null
     *
     * @return void
     */
    public function testRemoveProductFromCart_Null()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/delete-item-in-cart', ['id_product' => null]);

        $response->assertInvalid(['id_product']);
    }

    /**
     * RemoveProductFromCart with array
     *
     * @return void
     */
    public function testRemoveProductFromCart_Array()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/delete-item-in-cart', ['id_product' => []]);

        $response->assertInvalid(['id_product']);
    }

    /**
     * RemoveProductFromCart with object
     *
     * @return void
     */
    public function testRemoveProductFromCart_Object()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/delete-item-in-cart', ['id_product' => new stdClass()]);

        $response->assertInvalid(['id_product']);
    }

    /**
     * RemoveProductFromCart with bool
     *
     * @return void
     */
    public function testRemoveProductFromCart_Bool()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/delete-item-in-cart', ['id_product' => false]);

        $response->assertInvalid(['id_product']);
    }

    /**
     * RemoveProductFromCart with bool
     *
     * @return void
     */
    public function testRemoveProductFromCart_Double()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/delete-item-in-cart', ['id_product' => 1.6]);

        $response->assertInvalid(['id_product']);
    }

    ///////////////////////////////////////////////////////////////////
    // FUNCTION EMPTY CART
    /**
     * Empty cart ok
     *
     * @return void
     */
    public function testEmptyCartOk()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/empty-cart');

        $response->assertStatus(200);
    }

    /**
     * Empty cart ok
     *
     * @return void
     */
    public function testEmptyCartOkCheckData()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/empty-cart');

        $this->assertDatabaseMissing('carts', ['id_product' => 1]);
    }

    /**
     * Empty cart wrong token
     *
     * @return void
     */
    public function testEmptyCartUnauthenciated()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . '1111',
        ])->post('/api/empty-cart');

        $response->assertStatus(302);
    }

    /**
     * Empty cart no token
     *
     * @return void
     */
    public function testEmptyCartNoTokens()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ',
        ])->post('/api/empty-cart');

        $response->assertStatus(302);
    }
}
