<?php
namespace O3Co\Query\Bridge\GuzzleHttp\Tests;

use O3Co\Query\Bridge\GuzzleHttp\Client;

/**
 * ClientTest 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ClientTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * testConstruct 
     * 
     * @access public
     * @return void
     */
    public function testConstruct()
    {
        $client = new Client();

        $this->assertTrue(true);
    }
}

