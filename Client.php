<?php
namespace O3Co\Query\Bridge\GuzzleHttp;

use GuzzleHttp\Client as GuzzleClient;
use O3Co\Query\Extensions\Client as HttpClient;

class Client extends GuzzleClient implements HttpClient 
{
    private $defaultLookupSize  = 10;

    private $lookupMethod = 'get';

    public function lookup(array $queris = array(), $size = null, $offset = 0)
    {
        $this->request($this->lookupMethod, $);
    }
}

