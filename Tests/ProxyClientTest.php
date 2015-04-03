<?php
namespace O3Co\Query\Bridge\GuzzleHttp\Tests;

use O3Co\Query\Bridge\GuzzleHttp\ProxyClient;
use GuzzleHttp\Client as GuzzleClient;

/**
 * ProxyClientTest 
 * 
 * @package \O3Co\Query
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license MIT
 */
class ProxyClientTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * testGetSet 
     * 
     * @access public
     * @return void
     */
    public function testGetterSetter()
    {
        $guzzleClient = new GuzzleClient();
        $client = new ProxyClient($guzzleClient, 'http://foo', 'get');
        
        $this->assertEquals($guzzleClient, $client->getClient());
        $this->assertEquals('http://foo', $client->getLookupUri());
        $this->assertEquals('get', $client->getLookupMethod());

        $client->setLookupUri('http://bar');
        $this->assertEquals('http://bar', $client->getLookupUri());

        $client->setLookupMethod('post');
        $this->assertEquals('post', $client->getLookupMethod());

        $client->setClient($guzzleClient);
        $this->assertEquals($guzzleClient, $client->getClient());
    }

    public function testLookup()
    {

        $guzzleClient = new GuzzleClient();
        $body = \GuzzleHttp\Stream\Stream::factory(json_encode(array(
                'foo' => 'Foo'
            )));
        $mock = new \GuzzleHttp\Subscriber\Mock([
                new \GuzzleHttp\Message\Response(200, ['Content-Type' => 'application/json'], $body),
            ]);

        $guzzleClient->getEmitter()->attach($mock);


        $client = new ProxyClient($guzzleClient, 'http://foo', 'get');

        $response = $client->lookup(array('q' => 'test', 'size' => 10));

        $this->assertEquals(array('foo' => 'Foo'), $response);
    }
}

