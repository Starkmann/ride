<?php

namespace Eike\Ride\Tests\Unit\Domain\Model;

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
 * Test case for class \Eike\Ride\Domain\Model\Ride.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Eike Starkmann <eike.starkmann@posteo.de>
 */
class RideTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Eike\Ride\Domain\Model\Ride
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Eike\Ride\Domain\Model\Ride();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription()
	{
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDateReturnsInitialValueForDateTime()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getDate()
		);
	}

	/**
	 * @test
	 */
	public function setDateForDateTimeSetsDate()
	{
		$dateTimeFixture = new \DateTime();
		$this->subject->setDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'date',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSpaceReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setSpaceForIntSetsSpace()
	{	}

	/**
	 * @test
	 */
	public function getRouteReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getRoute()
		);
	}

	/**
	 * @test
	 */
	public function setRouteForStringSetsRoute()
	{
		$this->subject->setRoute('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'route',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getReturningReturnsInitialValueForRide()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getReturning()
		);
	}

	/**
	 * @test
	 */
	public function setReturningForRideSetsReturning()
	{
		$returningFixture = new \Eike\Ride\Domain\Model\Ride();
		$this->subject->setReturning($returningFixture);

		$this->assertAttributeEquals(
			$returningFixture,
			'returning',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDriverReturnsInitialValueForFeUser()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getDriver()
		);
	}

	/**
	 * @test
	 */
	public function setDriverForObjectStorageContainingFeUserSetsDriver()
	{
		$driver = new \Eike\Ride\Domain\Model\FeUser();
		$objectStorageHoldingExactlyOneDriver = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneDriver->attach($driver);
		$this->subject->setDriver($objectStorageHoldingExactlyOneDriver);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneDriver,
			'driver',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addDriverToObjectStorageHoldingDriver()
	{
		$driver = new \Eike\Ride\Domain\Model\FeUser();
		$driverObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$driverObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($driver));
		$this->inject($this->subject, 'driver', $driverObjectStorageMock);

		$this->subject->addDriver($driver);
	}

	/**
	 * @test
	 */
	public function removeDriverFromObjectStorageHoldingDriver()
	{
		$driver = new \Eike\Ride\Domain\Model\FeUser();
		$driverObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$driverObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($driver));
		$this->inject($this->subject, 'driver', $driverObjectStorageMock);

		$this->subject->removeDriver($driver);

	}

	/**
	 * @test
	 */
	public function getDestinationReturnsInitialValueForAddress()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getDestination()
		);
	}

	/**
	 * @test
	 */
	public function setDestinationForAddressSetsDestination()
	{
		$destinationFixture = new \Eike\Ride\Domain\Model\Address();
		$this->subject->setDestination($destinationFixture);

		$this->assertAttributeEquals(
			$destinationFixture,
			'destination',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStartReturnsInitialValueForAddress()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getStart()
		);
	}

	/**
	 * @test
	 */
	public function setStartForAddressSetsStart()
	{
		$startFixture = new \Eike\Ride\Domain\Model\Address();
		$this->subject->setStart($startFixture);

		$this->assertAttributeEquals(
			$startFixture,
			'start',
			$this->subject
		);
	}
}
