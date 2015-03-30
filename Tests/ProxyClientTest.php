<?php
namespace O3Co\Query\Bridge\GuzzleHttp\Tests;

use O3Co\Query\Bridge\GuzzleHttp\ProxyClient;
use GuzzleHttp\Client as GuzzleClient;

/**
 * ProxyClientTest 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ProxyClientTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * testConstruct 
     * 
     * @access public
     * @return void
     */
    public function testConstruct()
    {
        $guzzleClient = new GuzzleClient();
        $client = new ProxyClient($guzzleClient, 'http://foo', 'get');
        
        $this->assertEquals($guzzleClient, $client->getClient());
        $this->assertEquals('http://foo', $client->getLookupUri());
        $this->assertEquals('get', $client->getLookupMethod());
    }
}

