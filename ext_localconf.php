<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Eike.ride',
	'List',
	array(
		'Ride' => 'list, show, new, create, edit, update, delete',

	),
	// non-cacheable actions
	array(
		'Ride' => 'new, create, delete, update',

	)
);
