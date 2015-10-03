<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/WiContacts for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace WiContacts\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager; // @todo: Verificar si esta librería si es requerida

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
        $repo = $this->getEm()->getRepository('WiContacts\Entity\Contact');
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
        return new ViewModel(array(
            
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
