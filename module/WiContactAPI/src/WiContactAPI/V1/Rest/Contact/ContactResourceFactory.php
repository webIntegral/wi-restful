<?php
namespace WiContactAPI\V1\Rest\Contact;

class ContactResourceFactory
{
    public function __invoke($services)
    {
        return new ContactResource();
    }
}
