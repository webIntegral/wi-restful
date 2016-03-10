<?php
namespace WiUserAPI\V1\Rest\UserByToken;

class UserByTokenResourceFactory
{
    public function __invoke($services)
    {
        return new UserByTokenResource();
    }
}
