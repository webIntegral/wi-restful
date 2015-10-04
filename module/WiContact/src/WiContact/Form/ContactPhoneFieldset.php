<?php
namespace WiContact\Form;

use WiContact\Entity\ContactPhone;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Persistence\ObjectManager;

class ContactPhoneFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('contact-phone');
        
        $this->setHydrator(new DoctrineHydrator($objectManager))
           ->setObject(new ContactPhone());
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'phone',
            'options' => array(
                'label' => 'Phone'
            )
        ));
    }
    
    public function getInputFilterSpecification()
    {
        return array(
            'id' => array(
                'required' => false
            ),
            
            'phone' => array(
                'required' => true
            )
        );
    }
}