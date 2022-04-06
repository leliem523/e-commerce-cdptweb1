<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use stdClass;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    // FUNCTION Register
    /**
     * Register Ok
     *
     * @return void
     */
    public function testRegisterOk()
    {
        $params = [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'test'
        ];

        $this->post('/api/register', $params)->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'name' => 'test'
        ]);
    }

    /**
     * Register Ok check returned data
     *
     * @return void
     */
    public function testRegisterOkCheckData()
    {
        $params = [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'test'
        ];

        $response = $this->post('/api/register', $params);

        // Use this code for testing response data
        $data = $response;
        $dataObj = json_decode($data->getContent(), true);

        $this->assertEquals($dataObj['user']['name'], 'test');
    }

    /**
     * Register return 201 status
     *
     * @return void
     */
    public function testRegisterReturn201()
    {
        // You can use var_dump to see data
        // var_dump(User::all());

        $params = [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'test'
        ];

        $response = $this->post('/api/register', $params);

        $response->assertStatus(201);
    }

    /**
     * Register without paramater
     *
     * @return void
     */
    public function testRegisterFailedNoParams()
    {
        $params = [];

        $response = $this->post('/api/register', $params);

        // Use this way to catch when in redirect situation
        $response->assertStatus(302);

        // Use this code for testing valiation returned message 
        $error = session('errors')->getMessages();

        $response->assertInvalid(['name', 'email', 'password']);
    }

    /**
     * Register with empty string paramater
     *
     * @return void
     */
    public function testRegisterFailedWithParamsEmptyString()
    {
        $params = [
            'name' => '',
            'email' => '',
            'password' => ''
        ];

        $response = $this->post('/api/register', $params);

        // Use this way to catch when in redirect situation
        $response->assertStatus(302);

        // Use this code for testing valiation returned message 
        $error = session('errors')->getMessages();

        $this->assertEquals($error['name'][0], 'The name field is required.');
        $this->assertEquals($error['email'][0], 'The email field is required.');
        $this->assertEquals($error['password'][0], 'The password field is required.');
    }

    /**
     * Register with null paramater
     *
     * @return void
     */
    public function testRegisterFailedWithParamsNull()
    {
        $params = [
            'name' => null,
            'email' => null,
            'password' => null
        ];

        $response = $this->post('/api/register', $params);

        // Use this way to catch when in redirect situation
        $response->assertStatus(302);

        // Use this code for testing valiation returned message 
        $error = session('errors')->getMessages();

        $this->assertEquals($error['name'][0], 'The name field is required.');
        $this->assertEquals($error['email'][0], 'The email field is required.');
        $this->assertEquals($error['password'][0], 'The password field is required.');
    }

    /**
     * Register without paramater
     *
     * @return void
     */
    public function testRegisterFailedWithParamsArray()
    {
        $params = [
            'name' => [],
            'email' => [],
            'password' => []
        ];

        $response = $this->post('/api/register', $params);

        // Use this way to catch when in redirect situation
        $response->assertStatus(302);
        // Use this code for testing valiation returned message 
        $error = session('errors')->getMessages();

        $this->assertEquals($error['name'][0], 'The name field is required.');
        $this->assertEquals($error['email'][0], 'The email field is required.');
        $this->assertEquals($error['password'][0], 'The password field is required.');
    }

    /**
     * Register with object paramater
     *
     * @return void
     */
    public function testRegisterFailedWithParamsObject()
    {
        $obj = new stdClass();
        $params = [
            'name' => $obj,
            'email' => $obj,
            'password' => $obj
        ];

        $response = $this->post('/api/register', $params);

        // Use this way to catch when in redirect situation
        $response->assertStatus(302);
    }

    /**
     * Register with bool paramater
     *
     * @return void
     */
    public function testRegisterFailedWithParamsBool()
    {
        $params = [
            'name' => true,
            'email' => true,
            'password' => true
        ];

        $response = $this->post('/api/register', $params);

        // Use this way to catch when in redirect situation
        $response->assertStatus(302);

        // Use this code for testing valiation returned message 
        $error = session('errors')->getMessages();

        $this->assertEquals($error['name'][0], 'The name must be a string.');
        $this->assertEquals($error['email'][0], 'The email must be a string.');
        $this->assertEquals($error['password'][0], 'The password must be a string.');
    }

    /**
     * Register with integer paramater
     *
     * @return void
     */
    public function testRegisterFailedWithParamsInteger()
    {
        $params = [
            'name' => 1,
            'email' => 1,
            'password' => 1
        ];

        $response = $this->post('/api/register', $params);

        // Use this way to catch when in redirect situation
        $response->assertStatus(302);

        // Use this code for testing valiation returned message 
        $error = session('errors')->getMessages();

        $this->assertEquals($error['name'][0], 'The name must be a string.');
        $this->assertEquals($error['email'][0], 'The email must be a string.');
        $this->assertEquals($error['password'][0], 'The password must be a string.');
    }

    /**
     * Register with double paramater
     *
     * @return void
     */
    public function testRegisterFailedWithParamsDouble()
    {
        $params = [
            'name' => 1.1,
            'email' => 1.1,
            'password' => 1.1
        ];

        $response = $this->post('/api/register', $params);

        // Use this way to catch when in redirect situation
        $response->assertStatus(302);

        // Use this code for testing valiation returned message 
        $error = session('errors')->getMessages();

        $this->assertEquals($error['name'][0], 'The name must be a string.');
        $this->assertEquals($error['email'][0], 'The email must be a string.');
        $this->assertEquals($error['password'][0], 'The password must be a string.');
    }

    /**
     * Register with invalid email
     *
     * @return void
     */
    public function testRegisterFailedWithInvalidEmail()
    {
        $params = [
            'name' => 'a',
            'email' => 'a',
            'password' => 'a'
        ];

        $response = $this->post('/api/register', $params);

        // Use this way to catch when in redirect situation
        $response->assertStatus(302);

        $response->assertInvalid(['email']);
    }

    /**
     * Register with duplicated email
     *
     * @return void
     */
    public function testRegisterFailedWithDuplicatedEmail()
    {
        $params = [
            'name' => 'a',
            'email' => 'hosihung@gmail.com',
            'password' => 'a'
        ];

        $response = $this->post('/api/register', $params);

        // Use this way to catch when in redirect situation
        $response->assertStatus(302);

        $response->assertInvalid(['email']);
    }

    /**
     * Register with special characters
     *
     * @return void
     */
    public function testRegisterFailedWithSpecialChars()
    {
        $params = [
            'name' => '%',
            'email' => '%',
            'password' => '%'
        ];

        $response = $this->post('/api/register', $params);

        // Use this way to catch when in redirect situation
        $response->assertStatus(302);

        $response->assertInvalid(['email']);
    }

    // Function Log out
    /**
     * Log out OK
     *
     * @return void
     */
    public function testLogoutOk()
    {
        // Api with token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/logout');

        $feedback = json_decode($response->getContent(), true);

        $this->assertEquals($feedback['message'], 'Log out.');
    }

    /**
     * Log out OK CHECK DATABASE
     *
     * @return void
     */
    public function testLogoutOkCheckDatabase()
    {
        // Api with token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/logout');

        $this->assertDatabaseMissing('personal_access_tokens', ['tokenable_id' => 1]);
    }

    /**
     * Log out OK CHECK status
     *
     * @return void
     */
    public function testLogoutOkReturn201()
    {
        // Api with token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user(),
        ])->post('/api/logout');

        $response->assertStatus(200);
    }

    /**
     * Log out Unahenciated
     *
     * @return void
     */
    public function testLogoutUnauthenciated()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 11',
        ])->post('/api/logout');

        $response->assertStatus(302);
    }

    /**
     * Log out Unahenciated no token
     *
     * @return void
     */
    public function testLogoutNoTokens()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ',
        ])->post('/api/logout');

        $response->assertStatus(302);
    }
}
