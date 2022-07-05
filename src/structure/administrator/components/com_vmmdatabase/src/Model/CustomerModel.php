<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_vmmdatabase
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace CustomerNamespace\Component\Vmmdatabase\Administrator\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\Database\ParameterType;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Helper\TagsHelper;

/**
 * Item Model for a Customer.
 *
 * @since  __BUMP_VERSION__
 */
class CustomerModel extends AdminModel
{
	/**
	 * The type alias for this content type.
	 *
	 * @var    string
	 * @since  __BUMP_VERSION__
	 */
	public $typeAlias = 'com_vmmdatabase.customer';

	/**
	 * The context used for the associations table
	 *
	 * @var    string
	 * @since  __BUMP_VERSION__
	 */
	protected $associationsContext = 'com_vmmdatabase.item';



	/**
	 * Method to get the row form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  \JForm|boolean  A \JForm object on success, false on failure
	 *
	 * @since   __BUMP_VERSION__
	 */
	public function getForm($data = [], $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm($this->typeAlias, 'customer', ['control' => 'jform', 'load_data' => $loadData]);

		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   __BUMP_VERSION__
	 */

 /*   protected function loadFormData()
    {
        $app = Factory::getApplication();

        $data = $this->getItem();

        $this->preprocessData($this->typeAlias, $data);

        return $data;
    }*/

    protected function loadFormData()
    {
        $app = Factory::getApplication();

        // Check the session for previously entered form data.
        $data = $app->getUserState('com_vmmdatabase.edit.customer.data', []);

        if (empty($data)) {
            $data = $this->getItem();

          /*  $felder = [];
            $felder['zugangsdaten'] = $data->zugangsdaten;
            $felder['projektdaten'] = $data->projektdaten;
            $felder['wartungsdaten'] = $data->wartungsdaten;
            $felder['notizen'] = $data->notizen;

            foreach ($felder as $fieldgroup)
            {
                foreach ($fieldgroup as $fieldname => $fieldvalue)
                {
                    $data->$fieldname = $fieldvalue;

                }
            }

            $data->zugangsdaten = [$data->app_url,$data->app_user];*/
            // Prime some default values.
            if ($this->getState('customer.id') == 0) {
                $data->set('catid', $app->input->get('catid', $app->getUserState('com_vmmdatabase.customers.filter.category_id'), 'int'));
            }
        }

        $this->preprocessData($this->typeAlias, $data);

        return $data;
    }

    /**
	 * Method to get a single record.
	 *
	 * @param   integer  $pk  The id of the primary key.
	 *
	 * @return  mixed  Object on success, false on failure.
	 *
	 * @since   __BUMP_VERSION__
	 */
	public function getItem($pk = null)
	{
		$item = parent::getItem($pk);

		// Load associated customer items
		$assoc = Associations::isEnabled();


		if ($assoc) {
			$item->associations = [];

			if ($item->id != null) {
				$associations = Associations::getAssociations('com_vmmdatabase', '#__customers_details', 'com_vmmdatabase.item', $item->id, 'id', null);

				foreach ($associations as $tag => $association) {
					$item->associations[$tag] = $association->id;
				}
			}
		}

		// Load item tags
		if (!empty($item->id)) {
			$item->tags = new TagsHelper;
			$item->tags->getTagIds($item->id, 'com_vmmdatabase.customer');
		}

		return $item;
	}
}
