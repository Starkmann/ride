<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Eike.' . $_EXTKEY,
	'List',
	array(
		'Ride' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Ride' => 'create, delete, update',
		
	)
);
