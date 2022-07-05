<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_vmmdatabase
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace CustomerNamespace\Component\Vmmdatabase\Administrator\Service\HTML;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use CustomerNamespace\Component\Vmmdatabase\Site\Helper\RouteHelper;
use Joomla\Registry\Registry;

/**
 * Content Component HTML Helper
 *
 * @since  __DEPLOY_VERSION__
 */
class Icon
{
	/**
	 * The application
	 *
	 * @var    CMSApplication
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	private $application;

	/**
	 * Service constructor
	 *
	 * @param   CMSApplication  $application  The application
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function __construct(CMSApplication $application)
	{
		$this->application = $application;
	}

	/**
	 * Method to generate a link to the create item page for the given category
	 *
	 * @param   object    $category  The category information
	 * @param   Registry  $params    The item parameters
	 * @param   array     $attribs   Optional attributes for the link
	 *
	 * @return  string  The HTML markup for the create item link
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	public static function create($category, $params, $attribs = [])
	{
		$uri = Uri::getInstance();

		$url = 'index.php?option=com_vmmdatabase&task=customer.add&return=' . base64_encode($uri) . '&id=0&catid=' . $category->id;

		$text = LayoutHelper::render('joomla.content.icons.create', ['params' => $params, 'legacy' => false]);

		// Add the button classes to the attribs array
		if (isset($attribs['class'])) {
			$attribs['class'] .= ' btn btn-primary';
		} else {
			$attribs['class'] = 'btn btn-primary';
		}

		$button = HTMLHelper::_('link', Route::_($url), $text, $attribs);

		$output = '<span class="hasTooltip" title="' . HTMLHelper::_('tooltipText', 'COM_VMMDATABASE_CREATE_CUSTOMER') . '">' . $button . '</span>';

		return $output;
	}

	/**
	 * Display an edit icon for the customer.
	 *
	 * This icon will not display in a popup window, nor if the customer is trashed.
	 * Edit access checks must be performed in the calling code.
	 *
	 * @param   object    $customer  The customer information
	 * @param   Registry  $params   The item parameters
	 * @param   array     $attribs  Optional attributes for the link
	 * @param   boolean   $legacy   True to use legacy images, false to use icomoon based graphic
	 *
	 * @return  string   The HTML for the customer edit icon.
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function edit($customer, $params, $attribs = [], $legacy = false)
	{
		$user = Factory::getUser();
		$uri  = Uri::getInstance();

		// Ignore if in a popup window.
		if ($params && $params->get('popup')) {
			return '';
		}

		// Ignore if the state is negative (trashed).
		if ($customer->published < 0) {
			return '';
		}

		// Set the link class
		$attribs['class'] = 'dropdown-item';

		// Show checked_out icon if the customer is checked out by a different user
		if (property_exists($customer, 'checked_out')
			&& property_exists($customer, 'checked_out_time')
			&& $customer->checked_out > 0
			&& $customer->checked_out != $user->get('id')) {
			$checkoutUser = Factory::getUser($customer->checked_out);
			$date         = HTMLHelper::_('date', $customer->checked_out_time);
			$tooltip      = Text::_('JLIB_HTML_CHECKED_OUT') . ' :: ' . Text::sprintf('COM_VMMDATABASE_CHECKED_OUT_BY', $checkoutUser->name)
				. ' <br /> ' . $date;

			$text = LayoutHelper::render('joomla.content.icons.edit_lock', ['tooltip' => $tooltip, 'legacy' => $legacy]);

			$output = HTMLHelper::_('link', '#', $text, $attribs);

			return $output;
		}

		if (!isset($customer->slug)) {
			$customer->slug = "";
		}

		$customerUrl = RouteHelper::getCustomerRoute($customer->slug, $customer->catid, $customer->language);
		$url        = $customerUrl . '&task=customer.edit&id=' . $customer->id . '&return=' . base64_encode($uri);

		if ($customer->published == 0) {
			$overlib = Text::_('JUNPUBLISHED');
		} else {
			$overlib = Text::_('JPUBLISHED');
		}

		if (!isset($customer->created)) {
			$date = HTMLHelper::_('date', 'now');
		} else {
			$date = HTMLHelper::_('date', $customer->created);
		}

		if (!isset($created_by_alias) && !isset($customer->created_by)) {
			$author = '';
		} else {
			$author = $customer->created_by_alias ?: Factory::getUser($customer->created_by)->name;
		}

		$overlib .= '&lt;br /&gt;';
		$overlib .= $date;
		$overlib .= '&lt;br /&gt;';
		$overlib .= Text::sprintf('COM_VMMDATABASE_WRITTEN_BY', htmlspecialchars($author, ENT_COMPAT, 'UTF-8'));

		$icon = $customer->published ? 'edit' : 'eye-slash';

		if (strtotime($customer->publish_up) > strtotime(Factory::getDate())
			|| ((strtotime($customer->publish_down) < strtotime(Factory::getDate())) && $customer->publish_down != Factory::getDbo()->getNullDate())) {
			$icon = 'eye-slash';
		}

		$text = '<span class="hasTooltip fa fa-' . $icon . '" title="'
			. HTMLHelper::tooltipText(Text::_('COM_VMMDATABASE_EDIT_CUSTOMER'), $overlib, 0, 0) . '"></span> ';
		$text .= Text::_('JGLOBAL_EDIT');

		$attribs['title'] = Text::_('COM_VMMDATABASE_EDIT_CUSTOMER');
		$output           = HTMLHelper::_('link', Route::_($url), $text, $attribs);

		return $output;
	}
}
