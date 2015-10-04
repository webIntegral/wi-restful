<?php
namespace WiContact\Form;

use WiContact\Entity\Contact;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

class ContactFieldset extends Fieldset implements InputFilterProviderInterface {
    
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('contact');
        
        $this->setHydrator(new DoctrineHydrator($objectManager))
            ->setObject(new Contact());
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'name'
        ));
        
        $phoneFieldset = new ContactPhoneFieldset($objectManager);
        $this->add(array(
            'type'  => 'Zend\Form\Element\Collection',
            'name'  => 'phones',
            'options' => array(
                'count' => 2,
                'target_element' => $phoneFieldset
            )
        ));
    }
    
    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
                'required' => true
            ),
        );
    }
}