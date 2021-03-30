<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Eike.ride',
	'List',
	'Ride'
);

$pluginSignature = str_replace('_','','ride') . '_list';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:ride/Configuration/FlexForms/flexform_list.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('ride', 'Configuration/TypoScript', 'Ride');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ride_domain_model_ride', 'EXT:ride/Resources/Private/Language/locallang_csh_tx_ride_domain_model_ride.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ride_domain_model_ride');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    'ride',
    'tx_ride_domain_model_ride'
);
