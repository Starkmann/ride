<?php
namespace Eike\Ride\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Eike Starkmann <eike.starkmann@posteo.de>
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Eike\Ride\Controller\RideController.
 *
 * @author Eike Starkmann <eike.starkmann@posteo.de>
 */
class RideControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \Eike\Ride\Controller\RideController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('Eike\\Ride\\Controller\\RideController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllRidesFromRepositoryAndAssignsThemToView()
	{

		$allRides = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$rideRepository = $this->getMock('Eike\\Ride\\Domain\\Repository\\RideRepository', array('findAll'), array(), '', FALSE);
		$rideRepository->expects($this->once())->method('findAll')->will($this->returnValue($allRides));
		$this->inject($this->subject, 'rideRepository', $rideRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('rides', $allRides);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenRideToView()
	{
		$ride = new \Eike\Ride\Domain\Model\Ride();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('ride', $ride);

		$this->subject->showAction($ride);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenRideToRideRepository()
	{
		$ride = new \Eike\Ride\Domain\Model\Ride();

		$rideRepository = $this->getMock('Eike\\Ride\\Domain\\Repository\\RideRepository', array('add'), array(), '', FALSE);
		$rideRepository->expects($this->once())->method('add')->with($ride);
		$this->inject($this->subject, 'rideRepository', $rideRepository);

		$this->subject->createAction($ride);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenRideToView()
	{
		$ride = new \Eike\Ride\Domain\Model\Ride();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('ride', $ride);

		$this->subject->editAction($ride);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenRideInRideRepository()
	{
		$ride = new \Eike\Ride\Domain\Model\Ride();

		$rideRepository = $this->getMock('Eike\\Ride\\Domain\\Repository\\RideRepository', array('update'), array(), '', FALSE);
		$rideRepository->expects($this->once())->method('update')->with($ride);
		$this->inject($this->subject, 'rideRepository', $rideRepository);

		$this->subject->updateAction($ride);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenRideFromRideRepository()
	{
		$ride = new \Eike\Ride\Domain\Model\Ride();

		$rideRepository = $this->getMock('Eike\\Ride\\Domain\\Repository\\RideRepository', array('remove'), array(), '', FALSE);
		$rideRepository->expects($this->once())->method('remove')->with($ride);
		$this->inject($this->subject, 'rideRepository', $rideRepository);

		$this->subject->deleteAction($ride);
	}
}
