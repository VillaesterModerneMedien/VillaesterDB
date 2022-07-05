<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_vmmdatabase
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace CustomerNamespace\Component\Vmmdatabase\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Categories\CategoryNode;
use Joomla\CMS\Language\Multilanguage;

/**
 * Vmmdatabase Component Route Helper
 *
 * @static
 * @package     Joomla.Site
 * @subpackage  com_vmmdatabase
 * @since       __DEPLOY_VERSION__
 */
abstract class RouteHelper
{
	/**
	 * Get the URL route for a vmmdatabase from a customer ID, vmmdatabase category ID and language
	 *
	 * @param   integer  $id        The id of the vmmdatabase
	 * @param   integer  $catid     The id of the vmmdatabase's category
	 * @param   mixed    $language  The id of the language being used.
	 *
	 * @return  string  The link to the vmmdatabase
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function getVmmdatabaseRoute($id, $catid, $language = 0)
	{
		// Create the link
		$link = 'index.php?option=com_vmmdatabase&view=vmmdatabase&id=' . $id;

		if ($catid > 1) {
			$link .= '&catid=' . $catid;
		}

		if ($language && $language !== '*' && Multilanguage::isEnabled()) {
			$link .= '&lang=' . $language;
		}

		return $link;
	}

	/**
	 * Get the URL route for a customer from a customer ID, vmmdatabase category ID and language
	 *
	 * @param   integer  $id        The id of the vmmdatabase
	 * @param   integer  $catid     The id of the vmmdatabase's category
	 * @param   mixed    $language  The id of the language being used.
	 *
	 * @return  string  The link to the vmmdatabase
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function getCustomerRoute($id, $catid, $language = 0)
	{
		// Create the link
		$link = 'index.php?option=com_vmmdatabase&view=customer&id=' . $id;

		if ($catid > 1) {
			$link .= '&catid=' . $catid;
		}

		if ($language && $language !== '*' && Multilanguage::isEnabled()) {
			$link .= '&lang=' . $language;
		}

		return $link;
	}

	/**
	 * Get the URL route for a vmmdatabase category from a vmmdatabase category ID and language
	 *
	 * @param   mixed  $catid     The id of the vmmdatabase's category either an integer id or an instance of CategoryNode
	 * @param   mixed  $language  The id of the language being used.
	 *
	 * @return  string  The link to the vmmdatabase
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function getCategoryRoute($catid, $language = 0)
	{
		if ($catid instanceof CategoryNode) {
			$id = $catid->id;
		} else {
			$id = (int) $catid;
		}

		if ($id < 1) {
			$link = '';
		} else {
			// Create the link
			$link = 'index.php?option=com_vmmdatabase&view=category&id=' . $id;

			if ($language && $language !== '*' && Multilanguage::isEnabled()) {
				$link .= '&lang=' . $language;
			}
		}

		return $link;
	}
}
