<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use stdClass;
use Tests\TestCase;

class Linh_UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;


    // ____________________________________________________________________________________________________
    // Test "Ok":
    public function testGetItemInCartOk()
    {
        // Insert new product to cart:
        $params = [
            'id_product' => 1,
            'quantity' => 99
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params);

        // Get cart:
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/cart');
        $result = json_decode($response->getContent(), true);

        $count = 0;
        foreach ($result as $key => $value) {
            if ($value['id'] == 1) {
                if ($value['pivot']['quantity'] = 99) {
                    $this->assertTrue(true);
                    $count++;
                    break;
                }
            }
        }
        if ($count == 0) {
            $this->assertTrue(false);
        }
    }

    // Check if count() can be used to count elements:
    public function testGetItemInCartOkCanBeCounted()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/cart');

        $result = json_decode($response->getContent(), true);

        if (gettype(count($result)) == 'integer' && count($result) >= 0) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    // Check if the result is an array:
    public function testGetItemInCartOkIsArray()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/cart');

        $result = json_decode($response->getContent(), true);

        $this->assertEquals(gettype($result), 'array');
    }


    // ____________________________________________________________________________________________________
    // Test "Ok":
    public function testAddProductToCartOk()
    {
        $params = [
            'id_product' => 1,
            'quantity' => 5
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params)->assertStatus(200);
    }

    // Check if response message is correct:
    public function testAddProductToCartOkCorrectResponseMsg()
    {
        $params = [
            'id_product' => 1,
            'quantity' => 5
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params);

        $this->assertEquals($response->getContent(), 'Add to cart successfully');
    }

    // Test "not good" (Negative test cases):
    public function testAddProductToCartNgNull()
    {
        $params = [
            'id_product' => null,
            'quantity' => null
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params)->assertStatus(302);
    }

    // Test "not good" (Negative test cases):
    public function testAddProductToCartNgNan()
    {
        $params = [
            'id_product' => 'e',
            'quantity' => 'e'
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params)->assertStatus(302);
    }

    // Test "not good" (Negative test cases):
    public function testAddProductToCartNgEmptyString()
    {
        $params = [
            'id_product' => '',
            'quantity' => ''
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params)->assertStatus(302);
    }

    // Test "not good" (Negative test cases):
    public function testAddProductToCartNgObject()
    {
        $obj = new stdClass();

        $params = [
            'id_product' => $obj,
            'quantity' => $obj
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params)->assertStatus(500);
    }

    // Test "not good" (Negative test cases):
    public function testAddProductToCartNgArray()
    {
        $params = [
            'id_product' => [1, 2, 3],
            'quantity' => [1, 2, 3]
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params)->assertStatus(302);
    }


    // ____________________________________________________________________________________________________
    // Test "Ok":
    public function testUpdateProductInCartOk()
    {
        // Insert product (id = 1) to cart:
        $params = [
            'id_product' => 1,
            'quantity' => 5
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params);

        // Then, update product (id = 1) in cart:
        $params = [
            'id_product' => 1,
            'quantity' => 10
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/update-cart', $params)->assertStatus(200);
    }

    // Test "not good" (Negative test cases):
    public function testUpdateProductInCartNgNull()
    {
        // Insert product (id = 1) to cart:
        $params = [
            'id_product' => 1,
            'quantity' => 5
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params);

        // Then, update product (id = 1) in cart:
        $params = [
            'id_product' => null,
            'quantity' => null
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/update-cart', $params)->assertStatus(302);
    }

    // Test "not good" (Negative test cases):
    public function testUpdateProductInCartNgNan()
    {
        // Insert product (id = 1) to cart:
        $params = [
            'id_product' => 1,
            'quantity' => 5
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params);

        // Then, update product (id = 1) in cart:
        $params = [
            'id_product' => 'e',
            'quantity' => 'e'
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/update-cart', $params)->assertStatus(302);
    }

    // Test "not good" (Negative test cases):
    public function testUpdateProductInCartNgEmptyString()
    {
        // Insert product (id = 1) to cart:
        $params = [
            'id_product' => 1,
            'quantity' => 5
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params);

        // Then, update product (id = 1) in cart:
        $params = [
            'id_product' => '',
            'quantity' => ''
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/update-cart', $params)->assertStatus(302);
    }

    // Test "not good" (Negative test cases):
    public function testUpdateProductInCartNgObject()
    {
        // Insert product (id = 1) to cart:
        $params = [
            'id_product' => 1,
            'quantity' => 5
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params);

        // Then, update product (id = 1) in cart:
        $obj = new stdClass();

        $params = [
            'id_product' => $obj,
            'quantity' => $obj
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/update-cart', $params)->assertStatus(500);
    }

    // Test "not good" (Negative test cases):
    public function testUpdateProductInCartNgArray()
    {
        // Insert product (id = 1) to cart:
        $params = [
            'id_product' => 1,
            'quantity' => 5
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/add-to-cart', $params);

        // Then, update product (id = 1) in cart:
        $params = [
            'id_product' => [1, 2, 3],
            'quantity' => [1, 2, 3]
        ];
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/update-cart', $params)->assertStatus(302);
    }
}
