<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;
use Tests\TestCase;
use Carbon\Carbon;

class Liem_UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testSoftDeleteCart()
    {
        $params = [
            'id_product' => 1,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/soft-delete-item-in-cart', $params);
        $actual = $response->getContent();
        $expected = 'Remove item from cart successfully! You can recover it';
        $this->assertEquals($expected, $actual);
    }

    public function testIdProductParamIsDoubleForSoftDeleteCart()
    {
        $params = [
            'id_product' => 2.5,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/soft-delete-item-in-cart', $params)->assertStatus(302);
    }

    public function testIdProductParamIsNegativeForSoftDeleteCart()
    {
        $params = [
            'id_product' => -2.5,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/soft-delete-item-in-cart', $params)->assertStatus(302);
    }

    public function testIdProductParamIsStringForSoftDeleteCart()
    {
        $params = [
            'id_product' => "aaa",
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/soft-delete-item-in-cart', $params)->assertStatus(302);
    }

    public function testIdProductParamIsNullForSoftDeleteCart()
    {
        $params = [
            'id_product' => null,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/soft-delete-item-in-cart', $params)->assertStatus(302);
    }

    public function testIdProductParamIsBoolForSoftDeleteCart()
    {
        $params = [
            'id_product' => true,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/soft-delete-item-in-cart', $params)->assertStatus(200);
    }

    public function testIdProductParamIsArrayForSoftDeleteCart()
    {
        $params = [
            'id_product' => array(),
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/soft-delete-item-in-cart', $params)->assertStatus(302);
    }
    public function testIdProductParamIsObjectForSoftDeleteCart()
    {
        $params = [
            'id_product' => new stdClass(),
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/soft-delete-item-in-cart', $params)->assertStatus(500);
    }

    # recoverItemInCart
    public function testRecoverItemInCart()
    {
        $params = [
            'id_product' => 1,
        ];

        $res = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/recover-item-in-cart', $params);
        if ($res->getContent() == 'Recover Item Successfully') {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    public function testIdProductParamIsDoubleForRecoverItemInCart()
    {
        $params = [
            'id_product' => 2.5,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/recover-item-in-cart', $params)->assertStatus(302);
    }

    public function testIdProductParamIsNegativeForRecoverItemInCart()
    {
        $params = [
            'id_product' => -2.5,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/recover-item-in-cart', $params)->assertStatus(302);
    }

    public function testIdProductParamIsStringForRecoverItemInCart()
    {
        $params = [
            'id_product' => "aaa",
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/recover-item-in-cart', $params)->assertStatus(302);
    }

    public function testIdProductParamIsNullForRecoverItemInCart()
    {
        $params = [
            'id_product' => null,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/recover-item-in-cart', $params)->assertStatus(302);
    }

    public function testIdProductParamIsBoolForRecoverItemInCart()
    {
        $params = [
            'id_product' => true,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/recover-item-in-cart', $params)->assertStatus(200);
    }

    public function testIdProductParamIsArrayForRecoverItemInCart()
    {
        $params = [
            'id_product' => array(),
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/recover-item-in-cart', $params)->assertStatus(302);
    }

    public function testIdProductParamIsObjectForRecoverItemInCart()
    {
        $params = [
            'id_product' => new stdClass(),
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/recover-item-in-cart', $params)->assertStatus(500);
    }
}
