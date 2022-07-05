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

$layout  = 'edit';
$tmpl = $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
//$fieldsetGroups = $this->form->getFieldsets('matrixFelder');
$fieldsetGroups = [
    'customerParameter',
    'berechnungsansaetze',
];
?>
<form action="<?php echo Route::_('index.php?option=com_vmmdatabase&layout=' . $layout . $tmpl . '&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="customer-form" class="form-validate">

	<?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>
	<div>
		<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'details']); ?>

        <?php foreach($fieldsetGroups as $group):
            $groupLabel = (string) $this->form->getXml()->xpath('//fields[@name="' . $group . '" and not(ancestor::field/form/*)]')->attributes()['label'];

            echo HTMLHelper::_('uitab.addTab', 'myTab', $group, Text::_($groupLabel));
            $fieldsets = $this->form->getFieldsets($group);
            echo HTMLHelper::_('uitab.endTab');
        ?>
        <?php endforeach; ?>

		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', empty($this->item->id) ? Text::_('COM_VMMDATABASE_NEW_CUSTOMER') : Text::_('COM_VMMDATABASE_EDIT_CUSTOMER')); ?>

        <?php
        foreach($this->form->getFieldset('kostenOberflaechensysteme') as $field)
        {
            //var_dump($field->get('element'));
            //$this->form->renderField($field);
        }

        //$this->form->getFieldset('kostenOberflaechensysteme');

        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                                Kosten Oberflächensysteme
                            </div>
                            <div class="card-body">
                                <?php echo $this->form->renderField('F27'); ?>
                                <?php echo $this->form->renderField('F29'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                                Wartung Gussasphalt
                            </div>
                            <div class="card-body">
                                <?php echo $this->form->renderField('B45'); ?>
                                <?php echo $this->form->renderField('B47'); ?>
                                <?php echo $this->form->renderField('B49'); ?>
                                <?php echo $this->form->renderField('B51'); ?>
                                <?php echo $this->form->renderField('B53'); ?>
                                <?php echo $this->form->renderField('B55'); ?>
                                <?php echo $this->form->renderField('B57'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                                Instandsetzung Gussasphalt
                            </div>
                            <div class="card-body">
                                <?php echo $this->form->renderField('B62'); ?>
                                <?php echo $this->form->renderField('B64'); ?>
                                <?php echo $this->form->renderField('B66'); ?>
                                <?php echo $this->form->renderField('B68'); ?>
                                <?php echo $this->form->renderField('B72'); ?>
                                <?php echo $this->form->renderField('B74'); ?>
                                <?php echo $this->form->renderField('B76'); ?>
                                <?php echo $this->form->renderField('B78'); ?>
                                <?php echo $this->form->renderField('B80'); ?>
                                <?php echo $this->form->renderField('B82'); ?>
                                <?php echo $this->form->renderField('B84'); ?>
                                <?php echo $this->form->renderField('B86'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                                Wartung Gussasphalt
                            </div>
                            <div class="card-body">
                                <?php echo $this->form->renderField('B45'); ?>
                                <?php echo $this->form->renderField('B47'); ?>
                                <?php echo $this->form->renderField('B49'); ?>
                                <?php echo $this->form->renderField('B51'); ?>
                                <?php echo $this->form->renderField('B53'); ?>
                                <?php echo $this->form->renderField('B55'); ?>
                                <?php echo $this->form->renderField('B57'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                                Wartung OS
                            </div>
                            <div class="card-body">
                                <?php echo $this->form->renderField('F45'); ?>
                                <?php echo $this->form->renderField('F47'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                                Joomla Global
                            </div>
                            <div class="card-body">
                                <?php echo LayoutHelper::render('joomla.edit.global', $this); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<?php echo HTMLHelper::_('uitab.endTab'); ?>


		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'berechnung', empty($this->item->id) ? Text::_('COM_VMMDATABASE_NEW_CUSTOMER22') : Text::_('COM_VMMDATABASE_EDIT_CUSTOMER22')); ?>
		<div class="row">
			<div class="col-lg-12">
                <h2><?= Text::_('COM_VMMDATABASE_HEADLINE_BERECHNUNGSANSAETZE'); ?></h2>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                               GU-Aufschlag
                            </div>
                            <div class="card-body">
                                <?php echo $this->form->renderField('B_B1'); ?>
                                <?php echo $this->form->renderField('B_B2'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                                Flächenansätze
                            </div>
                            <div class="card-body">
                                <?php echo $this->form->renderField('B_B6'); ?>
                                <?php echo $this->form->renderField('B_B7'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                                Kosten Rohbau
                            </div>
                            <div class="card-body">
                                <?php echo $this->form->renderField('B_B11'); ?>
                                <?php echo $this->form->renderField('B_B12'); ?>
                                <?php echo $this->form->renderField('B_B13'); ?>
                                <?php echo $this->form->renderField('B_B14'); ?>
                                <?php echo $this->form->renderField('B_B15'); ?>
                                <?php echo $this->form->renderField('B_B16'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                                Zeitansätze Belagserneuerung Asphalt
                            </div>
                            <div class="card-body">
                                <?php echo $this->form->renderField('B_B21'); ?>
                                <?php echo $this->form->renderField('B_B22'); ?>
                                <?php echo $this->form->renderField('B_B23'); ?>
                                <?php echo $this->form->renderField('B_B24'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                                Zeitansätze Belagserneuerung (Anzahl pro Stellplatz / Monate)
                            </div>
                            <div class="card-body">
                                <?php echo $this->form->renderField('B_B29'); ?>
                                <?php echo $this->form->renderField('B_B30'); ?>
                                <?php echo $this->form->renderField('B_B31'); ?>
                                <?php echo $this->form->renderField('B_B32'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                                Ansätze für Fugenerneuerung
                            </div>
                            <div class="card-body">
                                <?php echo $this->form->renderField('B_B35'); ?>
                                <?php echo $this->form->renderField('B_B36'); ?>
                                <?php echo $this->form->renderField('B_B37'); ?>
                                <?php echo $this->form->renderField('B_B38'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card text-dark bg-light mb-3">
                            <div class="card-header">
                                Kostenansätze für die Herstellung von Bandagen
                            </div>
                            <div class="card-body">
                                <?php echo $this->form->renderField('B_B41'); ?>
                                <?php echo $this->form->renderField('B_B42'); ?>
                                <?php echo $this->form->renderField('B_B43'); ?>
                                <?php echo $this->form->renderField('B_B44'); ?>
                                <?php echo $this->form->renderField('B_B45'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">

                    </div>
                </div>

			</div>
		</div>

		<?php echo HTMLHelper::_('uitab.endTab'); ?>

		<?php if ($assoc) : ?>
			<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'associations', Text::_('JGLOBAL_FIELDSET_ASSOCIATIONS')); ?>
			<?php echo $this->loadTemplate('associations'); ?>
			<?php echo HTMLHelper::_('uitab.endTab'); ?>
		<?php endif; ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'params', Text::_('JGLOBAL_FIELDSET_PARAMS')); ?>
		<?php echo LayoutHelper::render('joomla.edit.params', $this); ?>
        <?php echo HTMLHelper::_('uitab.endTab'); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'felder', Text::_('JGLOBAL_FIELDSET_PARAMS22')); ?>

        <?php //echo $this->form->renderFieldset('kostenOberflaechensysteme'); ?>
        <?php
            //$fieldsets = []

            $fieldsetGroups = $this->form->getFieldsets('matrixFelder');
            foreach($fieldsetGroups as $fieldsetName => $fieldset)
            {
                $this->fieldset = (string) $fieldsetName;
                echo LayoutHelper::render('joomla.edit.fieldset', $this);
            }
        ?>
        <?php echo HTMLHelper::_('uitab.endTab'); ?>

		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publishing', Text::_('JGLOBAL_FIELDSET_PUBLISHING')); ?>
		<div class="row">
			<div class="col-md-6">
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
