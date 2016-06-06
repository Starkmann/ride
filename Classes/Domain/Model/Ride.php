<?php
namespace Eike\Ride\Domain\Model;

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
 * A ride
 */
class Ride extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * Description
     *
     * @var string
     */
    protected $description = '';
    
    /**
     * Date
     *
     * @var \DateTime
     */
    protected $date = null;
    
    /**
     * How much persons
     *
     * @var int
     */
    protected $space = 0;
    
    /**
     * route
     *
     * @var string
     */
    protected $route = '';
    
    /**
     * returning
     *
     * @var \Eike\Ride\Domain\Model\Ride
     * @lazy
     */
    protected $returning = null;
    
    /**
     * driver
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Eike\Ride\Domain\Model\FeUser>
     * @cascade remove
     */
    protected $driver = null;
    
    /**
     * destination
     *
     * @var \Eike\Ride\Domain\Model\Address
     */
    protected $destination = null;
    
    /**
     * start
     *
     * @var \Eike\Ride\Domain\Model\Address
     */
    protected $start = null;
    
    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * Returns the date
     *
     * @return \DateTime $date
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * Sets the date
     *
     * @param \DateTime $date
     * @return void
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }
    
    /**
     * Returns the space
     *
     * @return int $space
     */
    public function getSpace()
    {
        return $this->space;
    }
    
    /**
     * Sets the space
     *
     * @param int $space
     * @return void
     */
    public function setSpace($space)
    {
        $this->space = $space;
    }
    
    /**
     * Returns the returning
     *
     * @return \Eike\Ride\Domain\Model\Ride returning
     */
    public function getReturning()
    {
        return $this->returning;
    }
    
    /**
     * Sets the returning
     *
     * @param \Eike\Ride\Domain\Model\Ride $returning
     * @return void
     */
    public function setReturning(\Eike\Ride\Domain\Model\Ride $returning)
    {
        $this->returning = $returning;
    }
    
    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }
    
    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->driver = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Adds a FeUser
     *
     * @param \Eike\Ride\Domain\Model\FeUser $driver
     * @return void
     */
    public function addDriver(\Eike\Ride\Domain\Model\FeUser $driver)
    {
        $this->driver->attach($driver);
    }
    
    /**
     * Removes a FeUser
     *
     * @param \Eike\Ride\Domain\Model\FeUser $driverToRemove The FeUser to be removed
     * @return void
     */
    public function removeDriver(\Eike\Ride\Domain\Model\FeUser $driverToRemove)
    {
        $this->driver->detach($driverToRemove);
    }
    
    /**
     * Returns the driver
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Eike\Ride\Domain\Model\FeUser> $driver
     */
    public function getDriver()
    {
        return $this->driver;
    }
    
    /**
     * Sets the driver
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Eike\Ride\Domain\Model\FeUser> $driver
     * @return void
     */
    public function setDriver(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $driver)
    {
        $this->driver = $driver;
    }
    
    /**
     * Returns the destination
     *
     * @return \Eike\Ride\Domain\Model\Address $destination
     */
    public function getDestination()
    {
        return $this->destination;
    }
    
    /**
     * Sets the destination
     *
     * @param \Eike\Ride\Domain\Model\Address $destination
     * @return void
     */
    public function setDestination(\Eike\Ride\Domain\Model\Address $destination)
    {
        $this->destination = $destination;
    }
    
    /**
     * Returns the start
     *
     * @return \Eike\Ride\Domain\Model\Address $start
     */
    public function getStart()
    {
        return $this->start;
    }
    
    /**
     * Sets the start
     *
     * @param \Eike\Ride\Domain\Model\Address $start
     * @return void
     */
    public function setStart(\Eike\Ride\Domain\Model\Address $start)
    {
        $this->start = $start;
    }
    
    /**
     * Returns the route
     *
     * @return string $route
     */
    public function getRoute()
    {
        return $this->route;
    }
    
    /**
     * Sets the route
     *
     * @param string $route
     * @return void
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

}