<?php

use PTS\ParserPsr7\Factory\Psr7Factory;

class CurlResponse
{
    public $body = '';
    public $headers = [];

    public function __construct($httpMessage)
    {
        $factory = new Psr7Factory;
        $response = $factory->toPsr7Response($httpMessage);

        $this->headers = $response->getHeaders();
        $this->headers['Http-Version'] = $response->getProtocolVersion();
        $this->headers['Status-Code'] = $response->getStatusCode();
        $this->headers['Status'] = $response->getReasonPhrase();

        $this->body = $response->getBody();
    }

    public function __toString()
    {
        return $this->body;
    }

    public function headers()
    {
        return $this->headers;
    }
}
