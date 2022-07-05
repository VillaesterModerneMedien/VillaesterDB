<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_vmmdatabase
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;

$displayData = [
	'textPrefix' => 'COM_VMMDATABASE',
	'formURL' => 'index.php?option=com_vmmdatabase',
	'helpURL' => 'https://github.com/astridx/boilerplate#readme',
	'icon' => 'icon-copy',
];

$user = Factory::getApplication()->getIdentity();

if ($user->authorise('core.create', 'com_vmmdatabase') || count($user->getAuthorisedCategories('com_vmmdatabase', 'core.create')) > 0) {
	$displayData['createURL'] = 'index.php?option=com_vmmdatabase&task=customer.add';
}

echo LayoutHelper::render('joomla.content.emptystate', $displayData);
