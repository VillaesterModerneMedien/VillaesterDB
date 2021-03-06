<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_vmmdatabase
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

$app = Factory::getApplication();
$input = $app->input;

$assoc = Associations::isEnabled();

$this->ignore_fieldsets = ['item_associations'];
$this->useCoreUI = true;

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate')
    ->useScript('com_vmmdatabase.admin-vmmdatabase-letter');

$layout = 'edit';
$tmpl = $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
//$fieldsetGroups = $this->form->getFieldsets('matrixFelder');
$fieldsetGroups = [
    'Zugangsdaten'  => [
        'app_url',
        'app_user',
        'app_pass',
        'app_key',
    ]
];

?>
<form
    action="<?php echo Route::_('index.php?option=com_vmmdatabase&layout=' . $layout . $tmpl . '&id=' . (int)$this->item->id); ?>"
    method="post" name="adminForm" id="customer-form" class="form-validate">

    <?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>
    <div>
        <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'details']); ?>
            <?php foreach ($fieldsetGroups as $groupName => $fields): ?>
            <?= HTMLHelper::_('uitab.addTab', 'myTab', $groupName, Text::_($groupName)); ?>

            <?php foreach($fields as $field){
		            echo $this->form->renderField($field);
                };
            ?>

            <?php echo HTMLHelper::_('uitab.endTab'); ?>
        <?php endforeach; ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publishing', Text::_('JGLOBAL_FIELDSET_PUBLISHING')); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo LayoutHelper::render('joomla.edit.global', $this); ?>

                <fieldset id="fieldset-publishingdata" class="options-form">
                    <legend><?php echo Text::_('JGLOBAL_FIELDSET_PUBLISHING'); ?></legend>
                    <div>
                        <?php echo LayoutHelper::render('joomla.edit.publishingdata', $this); ?>
                    </div>
                </fieldset>
            </div>
        </div>
        <?php echo HTMLHelper::_('uitab.endTab'); ?>

        <?php echo HTMLHelper::_('uitab.endTabSet'); ?>
    </div>
    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
