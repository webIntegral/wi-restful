<?php
namespace WiUserAPI\V1\Rest\UserStatus;

class UserStatusResourceFactory
{
    public function __invoke($services)
    {
        return new UserStatusResource();
    }
}
