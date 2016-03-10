<?php
namespace WiUserAPI\V1\Rest\Token;

class TokenResourceFactory
{
    public function __invoke($services)
    {
        return new TokenResource();
    }
}
