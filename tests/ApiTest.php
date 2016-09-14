<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\Hash;

class ApiTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(App\Models\User::class)->make(['password' => Hash::make('toto')]);
        $this->user->save();

    }

    public function testHouses()
    {
        $this->get('/api/v1/houses')->seeJson(['name'=> 'gryffindor']);
    }

    public function testAuth()
    {
        $this->post('/api/v1/auth')->assertResponseStatus(401);

        $this->post('/api/v1/auth', ['email' => $this->user->email, 'password' => 'toto'])->assertResponseStatus(200);
        $this->seeJsonEquals(['key' => $this->user->api_token]);
    }

    public function testHousesPut()
    {
        $this->put('/api/v1/houses/gryffindor')->assertResponseStatus(401);

        $this->actingAs($this->user);
        $this->put('/api/v1/houses/gryffindor', [
            'key' => $this->user->api_token,
            'action' => 'set',
            'amount' => 0
        ])->assertResponseStatus(200);
        $this->seeJson([
            'name' => 'gryffindor',
            'score' => 0
        ]);

        $this->put('/api/v1/houses/gryffindor', [
            'key' => $this->user->api_token,
            'action' => 'remove',
            'amount' => 43
        ])->assertResponseStatus(200);
        $this->seeJson([
            'name' => 'gryffindor',
            'score' => 0
        ]);

        $this->put('/api/v1/houses/gryffindor', [
            'key' => $this->user->api_token,
            'action' => 'add',
            'amount' => -1
        ])->assertResponseStatus(400);
    }

    public function testOperations()
    {
        $this->get('/api/v1/operations')->assertResponseStatus(401);

        $this->actingAs($this->user);

        $this->put('/api/v1/houses/slytherin', [
            'key' => $this->user->api_token,
            'action' => 'set',
            'amount' => 666,
            'reason' => 'TEST'
        ])->assertResponseStatus(200);

        $this->get('/api/v1/operations')->assertResponseStatus(200);
        $this->seeJson([
            'amount'=> 666,
            'action'=> 'set',
            'reason' => 'TEST']);
        $this->seeJson([
            'name'=> $this->user->name,
            'email'=> $this->user->email
        ]);
        $this->seeJson([
            'name'=> 'slytherin',
            'score'=> 666
        ]);
    }
}
