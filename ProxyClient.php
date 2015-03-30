<?php
namespace O3Co\Query\Bridge\GuzzleHttp;

use GuzzleHttp\Client as GuzzleClient;
use O3Co\Query\Extension\Http\Client as HttpClient;

/**
 * ProxyClient 
 * 
 * @uses HttpClient
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ProxyClient implements HttpClient 
{
    /**
     * client 
     * 
     * @var mixed
     * @access private
     */
    private $client;

    /**
     * lookupMethod 
     * 
     * @var string
     * @access private
     */
    private $lookupMethod = 'get';

    private $lookupUri;

    public function __construct(GuzzleClient $client = null, $lookupUri = null, $lookupMethod = 'get')
    {
        $this->client = $client;
        $this->lookupUri = $lookupUri;
        $this->lookupMethod = $lookupMethod;
    }

    /**
     * lookup 
     * 
     * @param array $queris 
     * @param mixed $size 
     * @param int $offset 
     * @access public
     * @return void
     */
    public function lookup(array $queris = array())
    {
        try {
            $request = $this->getClient()->createRequest($this->lookupMethod, $this->lookupUri, array('query' => $queries));

            $response = $this->send($request);
        } catch(\Exception $ex) {
            throw new \RuntimeException('Failed to get response', 0, $ex);
        }

        // if success level, 
        if(2 == floor($response->getStatusCode()/100)) {
            $contentType = $response->getHeader('Content-Type');

            switch($contentType) {
            case 'application/json':
                return $response->json();
            case 'application/xml':
                return $response->xml();
            default:
                //throw new UnsupportedFormatException(sprintf('Content-Type "%s" is not supported.', $response->getHeader('Content-Type')));
                throw new \RuntimeException(sprintf('Content-Type "%s" is not supported.', $contentType));
            }
        }

        throw new \RuntimeException(sprintf('Failed to get the response: StatusCode [%d]', $response->getStatusCode()));
    }
    
    /**
     * getLookupMethod 
     * 
     * @access public
     * @return void
     */
    public function getLookupMethod()
    {
        return $this->lookupMethod;
    }
    
    /**
     * setLookupMethod 
     * 
     * @param mixed $lookupMethod 
     * @access public
     * @return void
     */
    public function setLookupMethod($lookupMethod)
    {
        $this->lookupMethod = $lookupMethod;
        return $this;
    }
    
    /**
     * getLookupUri 
     * 
     * @access public
     * @return void
     */
    public function getLookupUri()
    {
        return $this->lookupUri;
    }
    
    /**
     * setLookupUri 
     * 
     * @param mixed $lookupUri 
     * @access public
     * @return void
     */
    public function setLookupUri($lookupUri)
    {
        $this->lookupUri = $lookupUri;
        return $this;
    }

    public function getClient()
    {
        return $this->client;
    }
    
    public function setClient(GuzzleClient $client)
    {
        $this->client = $client;
        return $this;
    }
}

