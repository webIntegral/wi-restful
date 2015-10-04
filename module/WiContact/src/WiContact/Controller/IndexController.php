<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/WiContact for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace WiContact\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use WiContact\Form\CreateContactForm;
use WiContact\Entity\Contact;

class IndexController extends AbstractActionController
{
    
    /**
     * Entity Manager
     * 
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;
    
    /**
     * Entity Manager Setter
     * @param \Doctrine\ORM\EntityManager $em
     * @return void
     */
    public function setEm(EntityManager $em) {
        $this->em = $em;
    }
    
    /**
     * Entity Manager Getter
     * 
     * Gets Doctrine Entity Manager from Service Locator
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEm() {
        if (null === $this->em) {
            $this->setEm($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        }
        return $this->em;
    }
    
    /**
     * Contacts list view
     */
    public function indexAction()
    {
        // Get repository and all Contacts
        $repo = $this->getEm()->getRepository('WiContact\Entity\Contact');
        $contacts = $repo->findAll();
        
        return new ViewModel(array(
            'contacts' => $contacts
        ));
    }
    
    public function viewAction()
    {
        return new ViewModel(array(
        
        ));
    }

    public function addAction()
    {
        // Get EntityManager
        $em = $this->getEm();
        
        // Create the form and inject ObjectManager
        $form = new CreateContactForm($em);
        
        // Create a new, empty entity and bind it to the form
        $contact = new Contact();
        $form->bind($contact);
        
        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            
            if ($form->isValid()) {
                $em->persist($contact);
                $em->flush();
                
                // Redirect to edit
                $this->redirect()->toRoute('wi-contact', array(
                    'controller' => 'index',
                    'action' => 'edit',
                    'id' => $contact->getId()
                ));
            }
        }
        
        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    public function editAction()
    {
        return new ViewModel(array(
            
        ));
    }
    
    public function deleteAction()
    {
        return new ViewModel(array(
            
        ));
    }
}
