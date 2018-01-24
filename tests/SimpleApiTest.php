<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SimpleApiTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testEchoApi()
    {
        $response = $this->call('GET', '/api/echo');

        $this->assertEquals(200, $response->getStatusCode());

        $obj = $response->getData();
        //response->getContent()もある
        //$decode = $response->getData(true);とするとarrayで返る
//        var_dump($obj);

        $this->assertEquals("OK",$obj->status);
        $this->assertEquals("No problem",$obj->message);
    }
}
