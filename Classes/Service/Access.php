<?php
namespace Eike\Ride\Service;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 "Eike Starkmann <eike.starkmann@posteo.de>"
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
 *
 *
 * @package Ride
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Access  {
	
	/**
	 * fronted user repository
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
	 * @inject
	 */
	protected $userRepository;
	
	/**
	 * Return logged in frontend user, if any, NULL otherwise
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
	 */
	public function getLoggedInFrontendUser() {
		$frontendUser = NULL;
		$user = $GLOBALS['TSFE']->fe_user->user;
		if(isset($user['uid'])) {
			$frontendUser = $this->userRepository->findByUid($user['uid']);
		}
		return $frontendUser;
	}
	
	/**
	 * 
	 * @param \Eike\Ride\Domain\Model\Ride $ride
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser
	 * @return boolean
	 */
	public function mayEditOrDelete($ride, $feUser) {
		return $ride->getDriver() == $feUser;
	}
}
?>