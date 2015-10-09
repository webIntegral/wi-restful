<?php
namespace WiContact\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class UpdateContactForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('update-contact-form');
        
        // The form will hydrate an object of type "Contact"
        $this->setHydrator(new DoctrineHydrator($objectManager));
        
        // Add the fieldset and set it as base fieldset
        $contactFieldset = new ContactFieldset($objectManager);
        $contactFieldset->setUseAsBaseFieldset(true);
        $this->add($contactFieldset);
        
        // @todo … add CSRF and submit elements …
        
        // @todo Optionally set your validation group here
    }
}