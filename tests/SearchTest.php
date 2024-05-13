<?php

use App\Core\Database\Drivers\MysqlDriver;
use App\Models\ShoppingList;
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    // protected function setUp(): void
    // {
    //     define('BASE_PATH', __DIR__ . "/../");
    //     $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    //     $dotenv->load();
    //     App\Core\Database\Model::setDatabase(new App\Core\Database\Drivers\MysqlDriver());
    // }

    public function testSearchItem()
    {
        $random = rand(100,1000);
        ShoppingList::create([
            'title'=>$random,
        ]);
        $model = new ShoppingList();
        $result = $model->like(['title'],$random);
        $this->assertEquals($result[0]['title'], $random);
    }
}