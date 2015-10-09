<?php
namespace WiContact\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class CreateContactForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('create-contact-form');
        
        // The form will hydrate an object of type "Contact"
        $this->setHydrator(new DoctrineHydrator($objectManager));
        
        // Add the fieldset and set it as base fieldset
        $contactFieldset = new ContactFieldset($objectManager);
        $contactFieldset->setUseAsBaseFieldset(true);
        $this->add($contactFieldset);
        
        // … add CSRF and submit elements …
        
        /*$this->add(array(
         'name' => 'security',
         'type' => 'Zend\Form\Element\Csrf'
        ));*/
        
        
        // Optionally set your validation group here
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Crear',
                'id'    => 'submitbutton'
            )
        ));
    }
}