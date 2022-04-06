<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use stdClass;
use Tests\TestCase;

class Linh_ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;


    // ____________________________________________________________________________________________________
    // Test "Ok":
    public function testFilterProductByPriceOk()
    {
        $params = [
            'start' => 50000,
            'end' => 100000
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/products/filter/price', $params)->assertStatus(200);
    }

    // Check if response data is correct:
    public function testFilterProductByPriceOkCorrectResponse()
    {
        $params = [
            'start' => 50000,
            'end' => 100000
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/products/filter/price', $params);

        $result = json_decode($response->getContent(), true);

        $count = 0;
        foreach ($result as $key => $value) {
            if ($value['price'] < 50000 || $value['price'] > 100000) {
                $this->assertTrue(false);
                $count++;
                break;
            }
        }
        if ($count == 0) {
            $this->assertTrue(true);
        }
    }

    // Test "not good" (Negative test cases):
    public function testFilterProductByPriceNgNull()
    {
        $params = [
            'start' => null,
            'end' => null
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/products/filter/price', $params)->assertStatus(302);
    }

    // Test "not good" (Negative test cases):
    public function testFilterProductByPriceNgNan()
    {
        $params = [
            'start' => 'e',
            'end' => 'e'
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/products/filter/price', $params)->assertStatus(302);
    }

    // Test "not good" (Negative test cases):
    public function testFilterProductByPriceNgEmptyString()
    {
        $params = [
            'start' => '',
            'end' => ''
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/products/filter/price', $params)->assertStatus(302);
    }

    // Test "not good" (Negative test cases):
    public function testFilterProductByPriceNgObject()
    {
        $obj = new stdClass();
        $params = [
            'start' => $obj,
            'end' => $obj
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/products/filter/price', $params)->assertStatus(500);
    }

    // Test "not good" (Negative test cases):
    public function testFilterProductByPriceNgArray()
    {
        $params = [
            'start' => [1, 2, 3],
            'end' => [1, 2, 3]
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/products/filter/price', $params)->assertStatus(302);
    }

    // ____________________________________________________________________________________________________
    // Test "Ok":
    public function testIndexOk()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('/api/products')->assertStatus(200);
    }

    // Check if count() can be used to count elements:
    public function testIndexCanBeCounted()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('/api/products')->assertStatus(200);

        $products = json_decode($response->getContent(), true);

        if (gettype(count($products)) == 'integer' && count($products) >= 0) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    // Check if the result is an array:
    public function testIndexIsArray()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('/api/products')->assertStatus(200);

        $products = json_decode($response->getContent(), true);

        $this->assertEquals(gettype($products), 'array');
    }


    // ____________________________________________________________________________________________________
    // Test "Ok":
    public function testRatingProductsOk()
    {
        // Get all products and select a product to be tested:
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('/api/products');

        $products = json_decode($response->getContent(), true);

        // Rate the first product:
        if (count($products) > 0) {
            $params = [
                'value' => 3
            ];

            $this->withHeaders([
                'Authorization' => 'Bearer ' . $this->user(),
            ])->post('/api/rating/' . $products[0]['id'], $params)->assertStatus(200);

        } else {
            $this->assertTrue(false);
            print_r('There are no products to be tested!');
        }
    }

    // Check if response message is correct:
    public function testRatingProductsCorrectResponseMsg()
    {
        // Get all products and select a product to be tested:
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('/api/products');

        $products = json_decode($response->getContent(), true);

        // Rate the first product:
        if (count($products) > 0) {
            $params = [
                'value' => 3
            ];

            $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $this->user(),
            ])->post('/api/rating/' . $products[0]['id'], $params);

            $this->assertEquals($response->getContent(), 'Rating successfully');

        } else {
            $this->assertTrue(false);
            print_r('There are no products to be tested!');
        }
    }

    // Test "not good" (Negative test cases):
    public function testRatingProductsNgNull()
    {
        // Get all products and select a product to be tested:
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('/api/products');

        $products = json_decode($response->getContent(), true);

        // Rate the first product:
        if (count($products) > 0) {
            $params = [
                'value' => null
            ];

            $this->withHeaders([
                'Authorization' => 'Bearer ' . $this->user(),
            ])->post('/api/rating/' . $products[0]['id'], $params)->assertStatus(302);

        } else {
            $this->assertTrue(false);
            print_r('There are no products to be tested!');
        }
    }

    // Test "not good" (Negative test cases):
    public function testRatingProductsNgNan()
    {
        // Get all products and select a product to be tested:
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('/api/products');

        $products = json_decode($response->getContent(), true);

        // Rate the first product:
        if (count($products) > 0) {
            $params = [
                'value' => 'e'
            ];

            $this->withHeaders([
                'Authorization' => 'Bearer ' . $this->user(),
            ])->post('/api/rating/' . $products[0]['id'], $params)->assertStatus(302);

        } else {
            $this->assertTrue(false);
            print_r('There are no products to be tested!');
        }
    }

    // Test "not good" (Negative test cases):
    public function testRatingProductsNgEmptyString()
    {
        // Get all products and select a product to be tested:
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('/api/products');

        $products = json_decode($response->getContent(), true);

        // Rate the first product:
        if (count($products) > 0) {
            $params = [
                'value' => ''
            ];

            $this->withHeaders([
                'Authorization' => 'Bearer ' . $this->user(),
            ])->post('/api/rating/' . $products[0]['id'], $params)->assertStatus(302);

        } else {
            $this->assertTrue(false);
            print_r('There are no products to be tested!');
        }
    }

    // Test "not good" (Negative test cases):
    public function testRatingProductsNgObject()
    {
        // Get all products and select a product to be tested:
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('/api/products');

        $products = json_decode($response->getContent(), true);

        $obj = new stdClass();

        // Rate the first product:
        if (count($products) > 0) {
            $params = [
                'value' => $obj
            ];

            $this->withHeaders([
                'Authorization' => 'Bearer ' . $this->user(),
            ])->post('/api/rating/' . $products[0]['id'], $params)->assertStatus(500);

        } else {
            $this->assertTrue(false);
            print_r('There are no products to be tested!');
        }
    }

    // Test "not good" (Negative test cases):
    public function testRatingProductsNgArray()
    {
        // Get all products and select a product to be tested:
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('/api/products');

        $products = json_decode($response->getContent(), true);

        // Rate the first product:
        if (count($products) > 0) {
            $params = [
                'value' => [1, 2, 3]
            ];

            $this->withHeaders([
                'Authorization' => 'Bearer ' . $this->user(),
            ])->post('/api/rating/' . $products[0]['id'], $params)->assertStatus(302);

        } else {
            $this->assertTrue(false);
            print_r('There are no products to be tested!');
        }
    }

    // Test "not good" (Negative test cases):
    public function testRatingProductsNgNegativeNumber()
    {
        // Get all products and select a product to be tested:
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('/api/products');

        $products = json_decode($response->getContent(), true);

        // Rate the first product:
        if (count($products) > 0) {
            $params = [
                'value' => -9
            ];

            $this->withHeaders([
                'Authorization' => 'Bearer ' . $this->user(),
            ])->post('/api/rating/' . $products[0]['id'], $params)->assertStatus(302);

        } else {
            $this->assertTrue(false);
            print_r('There are no products to be tested!');
        }
    }

    // Test "not good" (Negative test cases):
    public function testRatingProductsNgOutOfBoundValue()
    {
        // Get all products and select a product to be tested:
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->get('/api/products');

        $products = json_decode($response->getContent(), true);

        // Rate the first product:
        if (count($products) > 0) {
            $params = [
                'value' => 9
            ];

            $this->withHeaders([
                'Authorization' => 'Bearer ' . $this->user(),
            ])->post('/api/rating/' . $products[0]['id'], $params)->assertStatus(302);

        } else {
            $this->assertTrue(false);
            print_r('There are no products to be tested!');
        }
    }
}
