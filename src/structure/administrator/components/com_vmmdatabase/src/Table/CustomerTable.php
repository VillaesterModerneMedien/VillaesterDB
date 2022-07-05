<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_vmmdatabase
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace CustomerNamespace\Component\Vmmdatabase\Administrator\Table;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Tag\TaggableTableInterface;
use Joomla\CMS\Tag\TaggableTableTrait;
use Joomla\Database\DatabaseDriver;
use Joomla\CMS\Language\Text;
use Joomla\Registry\Registry;

/**
 * Customers Table class.
 *
 * @since  __BUMP_VERSION__
 */
class CustomerTable extends Table implements TaggableTableInterface
{
	use TaggableTableTrait;

	/**
	 * Constructor
	 *
	 * @param   DatabaseDriver  $db  Database connector object
	 *
	 * @since   __BUMP_VERSION__
	 */
	public function __construct(DatabaseDriver $db)
	{
		$this->typeAlias = 'com_vmmdatabase.customer';

		parent::__construct('#__vmmdatabase_details', 'id', $db);
	}

	/**
	 * Generate a valid alias from title / date.
	 * Remains public to be able to check for duplicated alias before saving
	 *
	 * @return  string
	 */
	public function generateAlias()
	{
		if (empty($this->alias)) {
			$this->alias = $this->name;
		}

		$this->alias = ApplicationHelper::stringURLSafe($this->alias, $this->language);

		if (trim(str_replace('-', '', $this->alias)) == '') {
			$this->alias = Factory::getDate()->format('Y-m-d-H-i-s');
		}

		return $this->alias;
	}

	/**
	 * Overloaded check function
	 *
	 * @return  boolean
	 *
	 * @see     Table::check
	 * @since   __BUMP_VERSION__
	 */
	public function check()
	{
		try {
			parent::check();
		} catch (\Exception $e) {
			$this->setError($e->getMessage());

			return false;
		}

		// Check the publish down date is not earlier than publish up.
		if ($this->publish_down > $this->_db->getNullDate() && $this->publish_down < $this->publish_up) {
			$this->setError(Text::_('JGLOBAL_START_PUBLISH_AFTER_FINISH'));

			return false;
		}

		// Set publish_up, publish_down to null if not set
		if (!$this->publish_up) {
			$this->publish_up = null;
		}

		if (!$this->publish_down) {
			$this->publish_down = null;
		}

		return true;
	}

	/**
	 * Get the type alias
	 *
	 * @return  string  The alias as described above
	 *
	 * @since   __BUMP_VERSION__
	 */
	public function getTypeAlias()
	{

		return $this->typeAlias;

	}

	/** Stores a customer.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  boolean  True on success, false on failure.
	 *
	 * @since   __BUMP_VERSION__
	 */
	public function store($updateNulls = true)
	{
        $input = Factory::getApplication()->input;

        $felder = [];
        $felder['zugangsdaten'] = $input->get('jform')['zugangsdaten'];
        $felder['projektdaten'] = $input->get('jform')['projektdaten'];
        $felder['wartungsdaten'] = $input->get('jform')['wartungsdaten'];
        $felder['notizen'] = $input->get('jform')['notizen'];

		$registry = new Registry($this->params);
		$this->params = (string) $registry;


        foreach ($felder as $fieldgroup)
        {
            foreach ($fieldgroup as $fieldname => $fieldvalue)
            {
                $this->$fieldname = $fieldvalue;
            }
        }

		return parent::store($updateNulls);
	}
}
