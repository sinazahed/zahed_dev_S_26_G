<?php

use App\Models\ShoppingList;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    const BASE_URL = 'http://localhost:8080/api/v1/';
    protected $client;

    protected function setUp(): void
    {
        $this->client =new Client([
            'base_uri'=>self::BASE_URL,
            'timeout'=>3.0
        ]);
    }
    
    public function testListIsReturnCorrectly()
    {
        $response = $this->client->request('GET', 'list');
        $responseData = json_decode($response->getBody(), true);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('data', $responseData);
        $this->assertArrayHasKey('lists', $responseData['data']);
    }   

    public function testAddToList()
    {
        $postData = [
            'title' => 'Speaker',
        ];
        $response = $this->client->request('POST', 'list/add',[
            'form_params' => $postData,
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $responseData = json_decode($response->getBody(), true);

        $item=ShoppingList::find($responseData['data']['id']);
        $this->assertEquals($item->title,'Speaker');
    }

    public function testUpdateItem()
    {
        $id=ShoppingList::create([
            'title'=>'test',
            'checked'=>1
        ]);
        $postData = ['checked'=>0];
        $response = $this->client->request('POST', "list/edit/$id",[
            'form_params' => $postData,
        ]);
        $responseData = json_decode($response->getBody(), true);
        $this->assertEquals('0', $responseData['data']['checked']);
    }

}