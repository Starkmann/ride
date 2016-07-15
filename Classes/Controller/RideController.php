<?php
namespace Eike\Ride\Controller;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Eike Starkmann <eike.starkmann@posteo.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * RideController
 */
class RideController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * rideRepository
     *
     * @var \Eike\Ride\Domain\Repository\RideRepository
     * @inject
     */
    protected $rideRepository = NULL;
    /**
     * addressRepository
     *
     * @var \Eike\Ride\Domain\Repository\AddressRepository
     * @inject
     */
    protected $addressRepository = NULL;
    
    /**
     * access
     *
     * @var \Eike\Ride\Service\Access
     * @inject
     */
    protected $access = NULL;
    
    /**
     *
     * @var \Eike\Ride\Service\Address
     * @inject
     */
    protected $addressService = NULL;
    
    public function initializeCreateAction() {
        if (isset($this->arguments['newRide'])) {
            $this->arguments['newRide']
            ->getPropertyMappingConfiguration()
            ->forProperty('date')
            ->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y/m/d H:i');
        }
    }
    
    public function initializeUpdateAction() {
        if (isset($this->arguments['ride'])) {
            $this->arguments['ride']
            ->getPropertyMappingConfiguration()
            ->forProperty('date')
            ->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y/m/d H:i');
        }
    }
    
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $rides = $this->rideRepository->findAll();
        
        $this->view->assign('feUser', $this->access->getLoggedInFrontendUser());
        $this->view->assign('rides', $rides);
        $this->view->assign('destination', $this->addressRepository->findByUid($this->settings['destination']));
    }
    
    /**
     * action show
     *
     * @param \Eike\Ride\Domain\Model\Ride $ride
     * @return void
     */
    public function showAction(\Eike\Ride\Domain\Model\Ride $ride)
    {
        $this->view->assign('ride', $ride);
    }
    
    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
    	if(!$this->access->getLoggedInFrontendUser()){
    		throw new InsufficientUserPermissionsException('You are not logged in so you cannot create something here',1466258305);
    	}
    	$this->view->assign('now', new \DateTime());
    	$this->view->assign('driver', $this->access->getLoggedInFrontendUser());
    }
    
    /**
     * action create
     *
     * @param \Eike\Ride\Domain\Model\Ride $newRide
     * @return void
     */
    public function createAction(\Eike\Ride\Domain\Model\Ride $newRide)
    {
    	$this->addFlashMessage('The object was created.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
    	$this->addressService->updateCoordinates($newRide->getStart());
        $this->rideRepository->add($newRide);
        $this->redirect('list');
    }
    
    /**
     * action edit
     *
     * @param \Eike\Ride\Domain\Model\Ride $ride
     * @ignorevalidation $ride
     * @return void
     */
    public function editAction(\Eike\Ride\Domain\Model\Ride $ride)
    {
    	if(!$this->access->mayEditOrDelete($ride, $this->access->getLoggedInFrontendUser())){
    		throw new InsufficientUserPermissionsException('You are not allowed to edit this ride',1466260533);
    	}
        $this->view->assign('ride', $ride);
        $this->view->assign('driver', $this->access->getLoggedInFrontendUser());
    }
    
    /**
     * action update
     *
     * @param \Eike\Ride\Domain\Model\Ride $ride
     * @return void
     */
    public function updateAction(\Eike\Ride\Domain\Model\Ride $ride)
    {
        $this->addFlashMessage('The object was updated.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->addressService->updateCoordinates($ride->getStart());
        $this->rideRepository->update($ride);
        $this->redirect('list');
    }
    
    /**
     * action delete
     *
     * @param \Eike\Ride\Domain\Model\Ride $ride
     * @return void
     */
    public function deleteAction(\Eike\Ride\Domain\Model\Ride $ride)
    {
    	if(!$this->access->mayEditOrDelete($ride, $this->access->getLoggedInFrontendUser())){
    		throw new InsufficientUserPermissionsException('You are not allowed to delete this ride',1466260675);
    	}
        $this->addFlashMessage('The object was deleted.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->rideRepository->remove($ride);
        $this->redirect('list');
    }

}