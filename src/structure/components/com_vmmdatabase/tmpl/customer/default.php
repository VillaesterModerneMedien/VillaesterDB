<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_vmmdatabase
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\Uri\Uri;
use CustomerNamespace\Component\Vmmdatabase\Site\Helper\DataHelper;


HTMLHelper::_('jquery.framework');
HTMLHelper::_('script', 'com_vmmdatabase/canvasjs.min.js', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('script', 'com_vmmdatabase/frontendForm.min.js', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('stylesheet', 'com_vmmdatabase/frontendForm.css', array('version' => 'auto', 'relative' => true));

$dataHelper = new DataHelper();
$frontendFields = $dataHelper->returnFrontendFields();
$backendFields = $dataHelper->returnBackendFields();

$itemValues =  json_decode($this->item->felder);
$itemValues =  (array) $itemValues->customerParameter;

$canDo   = ContentHelper::getActions('com_vmmdatabase', 'category', $this->item->catid);
$canEdit = $canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == Factory::getUser()->id);
$tparams = $this->item->params;


if ($tparams->get('show_name')) {
	if ($this->Params->get('show_customer_name_label')) {
		echo Text::_('COM_VMMDATABASE_NAME');
	}
}
?>
<div class="uk-grid">
    <div class="uk-width-1-2">
        <a href="https://park-raum.com" target="blank"><img class="parkRaum" src="images/logo_parkraum_redesign_2021.png"/></a>
    </div>
    <div class="uk-width-1-2">
        <a href="https://johannesbaut.de" target="blank"><img class="johBau" src="images/joh_logo-rgb.jpg"/></a>
    </div>
    <div class="uk-width-1-1 grey">
        <hr>
    </div>
</div>

    <div class="headline">LIFE CYCLE KOSTEN <br><span class="headline2">für am Markt übliche Systeme</span></div>

    <div class="header">
        <div class="uk-width-1-1">
            <div class="uk-child-width-1-2 uk-child-width-1-4@s uk-grid total">
                <div>
                    <h3 id="headline1" class="totalHead"></h3>
                    <p class="totalSubhead2">Life Cycle Kosten</p>
                    <span id="value1" class="totalSum2"></span>
                </div>
                <div>
                    <h3 id="headline2" class="totalHead totalHead2"></h3>
                    <p class="totalSubhead totalOverload">Life Cycle Kosten</p>
                    <span id="value2" class="totalSum totalOverload"></span>
                    <span class="warnHinweis">max. Gebäudestandzeit von 35 Jahren überschritten</span>
                </div>
                <div>
                    <h3 id="headline3" class="totalHead totalHead3"></h3>
                    <p class="totalSubhead totalOverload">Life Cycle Kosten</p>
                    <span id="value3" class="totalSum totalOverload"></span>
                    <span class="warnHinweis">max. Gebäudestandzeit von 35 Jahren überschritten</span>
                </div>
                <div>
                    <h3 id="headline4" class="totalHead totalHead4"></h3>
                    <p class="totalSubhead totalOverload">Life Cycle Kosten</p>
                    <span id="value4" class="totalSum totalOverload"></span>
                    <span class="warnHinweis">max. Gebäudestandzeit von 35 Jahren überschritten</span>
                    <span class="warnHinweis2Out">Bauart in F30 und F90 zurzeit nicht möglich</span>
                </div>
            </div>
        </div>
    </div>

<form action="index.php?option=com_vmmdatabase&task=customer.getPDF&tmpl=component" name="lccCalcForm" id="lccCalcForm" method="post" enctype='multipart/form-data'>

    <div class="uk-grid">
        <div class="uk-width-1-1 uk-width-1-4@m">
            <input type="hidden" id="hiddenID" name="id" value="<?= $this->item->id; ?>">
            <div class="rangeSlider">
                <label>Laufzeit in <span class="yearsSlider"></span> Jahren</label>
                <input id="F3" name="F3" class="rangeJahre uk-range uk-width-2-3" type="range" value="50" min="0" max="50" step="1" oninput="document.getElementById('rangeValue').innerHTML = this.value">
            </div>
        </div>
        <div class="uk-width-1-1 uk-width-3-4@m">
            <div class="chart" id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
    </div>

    <div class="uk-grid">
        <div class="uk-width-1-2@s ">
            <h2 class="headContainer"><span class="icon-icon_gebaeude"></span>Gebäudedaten</h2>
            <div class="fieldMainContainer">
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B25</strong> <?= $frontendFields['B25']['label']; ?></label>
                    <div class="uk-button-select uk-form-select select-wrapper" data-uk-form-select>
                        <span></span>
                        <select name="B25" id="B25" class="inputChanger uk-input-">
                            <option value="Split">Split</option>
                            <option value="Voll">Voll</option>
                        </select>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['B25']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B27</strong> <?= $frontendFields['B27']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['B27']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['B27']['readonly']; ?> uk-input-<?= $frontendFields['B27']['backend']; ?> uk-input uk-<?= $frontendFields['B27']['type']; ?>" name="B27" id="B27" value="<?= $frontendFields['B27']['default']; ?>" <?= $frontendFields['B27']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['B27']['unit']; ?></div>

                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B29</strong> <?= $frontendFields['B29']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['B29']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['B29']['readonly']; ?> uk-input-<?= $frontendFields['B29']['backend']; ?> uk-input uk-<?= $frontendFields['B29']['type']; ?>" name="B29" id="B29" value="<?= $frontendFields['B29']['default']; ?>" <?= $frontendFields['B29']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['B29']['unit']; ?></div>

                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B31</strong> <?= $frontendFields['B31']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['B31']['type']; ?>" class="inputChanger result uk-input-<?= $frontendFields['B31']['readonly']; ?> uk-input-<?= $frontendFields['B31']['backend']; ?> uk-input uk-<?= $frontendFields['B31']['type']; ?>" name="B31" id="B31" value="<?= $frontendFields['B31']['default']; ?>" <?= $frontendFields['B31']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['B31']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B33</strong> <?= $frontendFields['B33']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['B33']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['B33']['readonly']; ?> uk-input-<?= $frontendFields['B33']['backend']; ?> uk-input uk-<?= $frontendFields['B33']['type']; ?>" name="B33" id="B33" value="<?= $frontendFields['B33']['default']; ?>" <?= $frontendFields['B33']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['B33']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B35</strong> <?= $frontendFields['B35']['label']; ?></label>
                    <div class="uk-button-select uk-form-select select-wrapper" data-uk-form-select>
                        <span></span>
                        <select name="B35" id="B35" class="inputChanger uk-input-">
                            <option value="ja">ja</option>
                            <option value="nein">nein</option>
                        </select>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['B35']['unit']; ?></div>
                </div>

                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B37</strong> <?= $frontendFields['B37']['label']; ?></label>
                    <div class="uk-button-select uk-form-select select-wrapper" data-uk-form-select>
                        <span></span>
                        <select name="B37" id="B37" class="inputChanger uk-input-">
                            <option value="ja">ja</option>
                            <option value="nein">nein</option>
                        </select>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['B37']['unit']; ?>
                        <span data-tooltip="Bei „nein“ wird kalkulatorisch eine weiße Wanne mit OS 8 Beschichtung angenommen; bei Vollgeschossen wird generell Pflaster im Erdgeschoss angesetzt" data-flow="top"> <i class="fas fa-question-circle"></i></span>
                    </div>

                </div>



                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B39</strong> <?= $frontendFields['B39']['label']; ?></label>
                    <div class="uk-button-select uk-form-select select-wrapper" data-uk-form-select>
                        <span></span>
                        <select name="B39" id="B39" class="inputChanger uk-input-">
                            <option value="F0">F0</option>
                            <option value="F30">F30</option>
                            <option value="F90">F90</option>
                        </select>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['B39']['unit']; ?>
                        <span data-tooltip="Für alle Systeme ist die Ausführung der Stützen, Unterzüge und Decken in der jeweiligen Anforderung gerechnet. Das System mit den oberflächenfertigen Fertigteildecken ist zurzeit nicht in den Bauarten F30 und F90 möglich." data-flow="top"> <i class="fas fas2 fa-question-circle"></i></span>
                    </div>

                </div>
            </div>
        </div>


        <div class="uk-width-1-2@s ">
            <h2 class="headContainer headContainerMargin"><span class="icon-icon_kosten"></span>Kosten Oberflächensysteme</h2>
            <div class="fieldMainContainer">
            <div class="fieldContainer marginTop">
                <label class="uk-form-label"><strong>F27</strong> <?= $backendFields['F27']['label']; ?></label>
                <div class="uk-form-controls">
                    <input type="<?= $backendFields['F27']['type']; ?>" class=" uk-input-<?= $backendFields['F27']['readonly']; ?> uk-input-<?= $backendFields['F27']['backend']; ?> uk-input uk-<?= $backendFields['F27']['type']; ?>" name="F27" id="F27" value="<?= (float) $itemValues['F27']; ?>" <?= $backendFields['F27']['readonly']; ?>>
                </div>
                <div class="unit uk-form-label"><?= $backendFields['F27']['unit']; ?></div>
            </div>
            <div class="fieldContainer">
                <label class="uk-form-label"><strong>F29</strong> <?= $backendFields['F29']['label']; ?></label>
                <div class="uk-form-controls">
                    <input type="<?= $backendFields['F29']['type']; ?>" class=" uk-input-<?= $backendFields['F29']['readonly']; ?> uk-input-<?= $backendFields['F29']['backend']; ?> uk-input uk-<?= $backendFields['F29']['type']; ?>" name="F29" id="F29" value="<?= (float) $itemValues['F29']; ?>" <?= $backendFields['F29']['readonly']; ?>>
                </div>
                <div class="unit uk-form-label"><?= $backendFields['F29']['unit']; ?></div>
            </div>
            <div class="fieldContainer">
                <label class="uk-form-label"><strong>F31</strong> <?= $frontendFields['F31']['label']; ?></label>
                <div class="uk-form-controls">
                    <input type="<?= $frontendFields['F31']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F31']['readonly']; ?> uk-input-<?= $frontendFields['F31']['backend']; ?> uk-input uk-<?= $frontendFields['F31']['type']; ?>" name="F31" id="F31" value="<?= $frontendFields['F31']['default']; ?>" <?= $frontendFields['F31']['readonly']; ?>>
                </div>
                <div class="unit uk-form-label"><?= $frontendFields['F31']['unit']; ?></div>
            </div>
        <div class="fieldContainer">
            <label class="uk-form-label"><strong>F33</strong> <?= $frontendFields['F33']['label']; ?></label>
            <div class="uk-form-controls">
                <input type="<?= $frontendFields['F33']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F33']['readonly']; ?> uk-input-<?= $frontendFields['F33']['backend']; ?> uk-input uk-<?= $frontendFields['F33']['type']; ?>" name="F33" id="F33" value="<?= $frontendFields['F33']['default']; ?>" <?= $frontendFields['F33']['readonly']; ?>>
            </div>
            <div class="unit uk-form-label"><?= $frontendFields['F33']['unit']; ?></div>
        </div>
            </div>
         </div>
    </div>

    <div class="uk-grid">
        <div class="uk-width-1-2@s lessWidth">
            <h2 class="headContainer"><span class="icon-icon_wartung"></span>Wartung Gussasphalt</h2>
            <div class="fieldMainContainer">
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B45</strong> <?= $backendFields['B45']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B45']['type']; ?>" class=" uk-input-<?= $backendFields['B45']['readonly']; ?> uk-input-<?= $backendFields['B45']['backend']; ?> uk-input uk-<?= $backendFields['B45']['type']; ?>" name="B45" id="B45" value="<?= (float) $itemValues['B45']; ?>" <?= $backendFields['B45']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B45']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B47</strong> <?= $backendFields['B47']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B47']['type']; ?>" class=" uk-input-<?= $backendFields['B47']['readonly']; ?> uk-input-<?= $backendFields['B47']['backend']; ?> uk-input uk-<?= $backendFields['B47']['type']; ?>" name="B47" id="B47" value="<?= (float) $itemValues['B47']; ?>" <?= $backendFields['B47']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B47']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B49</strong> <?= $backendFields['B49']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B49']['type']; ?>" class=" uk-input-<?= $backendFields['B49']['readonly']; ?> uk-input-<?= $backendFields['B49']['backend']; ?> uk-input uk-<?= $backendFields['B49']['type']; ?>" name="B49" id="B49" value="<?= (float) $itemValues['B49']; ?>" <?= $backendFields['B49']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B49']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B51</strong> <?= $backendFields['B51']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B51']['type']; ?>" class=" uk-input-<?= $backendFields['B51']['readonly']; ?> uk-input-<?= $backendFields['B51']['backend']; ?> uk-input uk-<?= $backendFields['B51']['type']; ?>" name="B51" id="B51" value="<?= (float) $itemValues['B51']; ?>" <?= $backendFields['B51']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B51']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B53</strong> <?= $backendFields['B53']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B53']['type']; ?>" class=" uk-input-<?= $backendFields['B53']['readonly']; ?> uk-input-<?= $backendFields['B53']['backend']; ?> uk-input uk-<?= $backendFields['B53']['type']; ?>" name="B53" id="B53" value="<?= (float) $itemValues['B53']; ?>" <?= $backendFields['B53']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B53']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B55</strong> <?= $backendFields['B55']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B55']['type']; ?>" class=" uk-input-<?= $backendFields['B55']['readonly']; ?> uk-input-<?= $backendFields['B55']['backend']; ?> uk-input uk-<?= $backendFields['B55']['type']; ?>" name="B55" id="B55" value="<?= (float) $itemValues['B55']; ?>" <?= $backendFields['B55']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B55']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B57</strong> <?= $backendFields['B57']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B57']['type']; ?>" class=" uk-input-<?= $backendFields['B57']['readonly']; ?> uk-input-<?= $backendFields['B57']['backend']; ?> uk-input uk-<?= $backendFields['B57']['type']; ?>" name="B57" id="B57" value="<?= (float) $itemValues['B57']; ?>" <?= $backendFields['B57']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B57']['unit']; ?></div>
                </div>
            </div>
        </div>
        <div class="uk-width-1-2@s lessWidth">
            <h2 class="headContainer headContainerMargin"><span class="icon-icon_wartung"></span>Wartung OS-Beschichtungen, Ortbetondecken, Fertigteildecken</h2>
            <div class="fieldMainContainer">
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F45</strong> <?= $backendFields['F45']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['F45']['type']; ?>" class=" uk-input-<?= $backendFields['F45']['readonly']; ?> uk-input-<?= $backendFields['F45']['backend']; ?> uk-input uk-<?= $backendFields['F45']['type']; ?>" name="F45" id="F45" value="<?= (float) $itemValues['F45']; ?>" <?= $backendFields['F45']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['F45']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F47</strong> <?= $backendFields['F47']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['F47']['type']; ?>" class=" uk-input-<?= $backendFields['F47']['readonly']; ?> uk-input-<?= $backendFields['F47']['backend']; ?> uk-input uk-<?= $backendFields['F47']['type']; ?>" name="F47" id="F47" value="<?= (float) $itemValues['F47']; ?>" <?= $backendFields['F47']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['F47']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F49</strong> <?= $frontendFields['F49']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F49']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F49']['readonly']; ?> uk-input-<?= $frontendFields['F49']['backend']; ?> uk-input uk-<?= $frontendFields['F49']['type']; ?>" name="F49" id="F49" value="<?= $frontendFields['F49']['default']; ?>" <?= $frontendFields['F49']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F49']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F51</strong> <?= $frontendFields['F51']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F51']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F51']['readonly']; ?> uk-input-<?= $frontendFields['F51']['backend']; ?> uk-input uk-<?= $frontendFields['F51']['type']; ?>" name="F51" id="F51" value="<?= $frontendFields['F51']['default']; ?>" <?= $frontendFields['F51']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F51']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F53</strong> <?= $frontendFields['F53']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F53']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F53']['readonly']; ?> uk-input-<?= $frontendFields['F53']['backend']; ?> uk-input uk-<?= $frontendFields['F53']['type']; ?>" name="F53" id="F53" value="<?= $frontendFields['F53']['default']; ?>" <?= $frontendFields['F53']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F53']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F55</strong> <?= $frontendFields['F55']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F55']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F55']['readonly']; ?> uk-input-<?= $frontendFields['F55']['backend']; ?> uk-input uk-<?= $frontendFields['F55']['type']; ?>" name="F55" id="F55" value="<?= $frontendFields['F55']['default']; ?>" <?= $frontendFields['F55']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F55']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F57</strong> <?= $frontendFields['F57']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F57']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F57']['readonly']; ?> uk-input-<?= $frontendFields['F57']['backend']; ?> uk-input uk-<?= $frontendFields['F57']['type']; ?>" name="F57" id="F57" value="<?= $frontendFields['F57']['default']; ?>" <?= $frontendFields['F57']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F57']['unit']; ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="uk-grid">
        <div class="uk-width-1-2@s lessWidth">
            <h2 class="headContainer"><span class="icon-icon_instandhaltung"></span>Instandsetzung Gussasphalt</h2>
            <div class="fieldMainContainer">
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B62</strong> <?= $backendFields['B62']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B62']['type']; ?>" class=" uk-input-<?= $backendFields['B62']['readonly']; ?> uk-input-<?= $backendFields['B62']['backend']; ?> uk-input uk-<?= $backendFields['B62']['type']; ?>" name="B62" id="B62" value="<?= (float) $itemValues['B62']; ?>" <?= $backendFields['B62']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B62']['unit']; ?>
                        <span data-tooltip="Eine Belagserneuerung in dieser Größenordnung wird bei diesem System nicht erforderlich und durch die folgend aufgeführten kleinteiligeren Instandhaltungen abgedeckt bzw. berücksichtigt." data-flow="top"> <i class="fas fa-question-circle"></i></span>
                    </div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B64</strong> <?= $backendFields['B64']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B64']['type']; ?>" class=" uk-input-<?= $backendFields['B64']['readonly']; ?> uk-input-<?= $backendFields['B64']['backend']; ?> uk-input uk-<?= $backendFields['B64']['type']; ?>" name="B64" id="B64" value="<?= (float) $itemValues['B64']; ?>" <?= $backendFields['B64']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B64']['unit']; ?>
                        <span data-tooltip="Eine Belagserneuerung in dieser Größenordnung wird bei diesem System nicht erforderlich und durch die folgend aufgeführten kleinteiligeren Instandhaltungen abgedeckt bzw. berücksichtigt." data-flow="top"> <i class="fas fa-question-circle"></i></span>
                    </div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B66</strong> <?= $backendFields['B66']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B66']['type']; ?>" class=" uk-input-<?= $backendFields['B66']['readonly']; ?> uk-input-<?= $backendFields['B66']['backend']; ?> uk-input uk-<?= $backendFields['B66']['type']; ?>" name="B66" id="B66" value="1" <?= $backendFields['B66']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B66']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B68</strong> <?= $backendFields['B68']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B68']['type']; ?>" class=" uk-input-<?= $backendFields['B68']['readonly']; ?> uk-input-<?= $backendFields['B68']['backend']; ?> uk-input uk-<?= $backendFields['B68']['type']; ?>" name="B68" id="B68" value="3" <?= $backendFields['B68']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B68']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B70</strong> <?= $backendFields['B70']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B70']['type']; ?>" class=" uk-input-<?= $backendFields['B70']['readonly']; ?> uk-input-<?= $backendFields['B70']['backend']; ?> uk-input uk-<?= $backendFields['B70']['type']; ?>" name="B70" id="B70" value="1" <?= $backendFields['B70']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B70']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B72</strong> <?= $backendFields['B72']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B72']['type']; ?>" class=" uk-input-<?= $backendFields['B72']['readonly']; ?> uk-input-<?= $backendFields['B72']['backend']; ?> uk-input uk-<?= $backendFields['B72']['type']; ?>" name="B72" id="B72" value="<?= (float) $itemValues['B72']; ?>" <?= $backendFields['B72']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B72']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B74</strong> <?= $backendFields['B74']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B74']['type']; ?>" class=" uk-input-<?= $backendFields['B74']['readonly']; ?> uk-input-<?= $backendFields['B74']['backend']; ?> uk-input uk-<?= $backendFields['B74']['type']; ?>" name="B74" id="B74" value="<?= (float) $itemValues['B74']; ?>" <?= $backendFields['B74']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B74']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B76</strong> <?= $backendFields['B76']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B76']['type']; ?>" class=" uk-input-<?= $backendFields['B76']['readonly']; ?> uk-input-<?= $backendFields['B76']['backend']; ?> uk-input uk-<?= $backendFields['B76']['type']; ?>" name="B76" id="B76" value="<?= (float) $itemValues['B76']; ?>" <?= $backendFields['B76']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B76']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B78</strong> <?= $backendFields['B78']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B78']['type']; ?>" class=" uk-input-<?= $backendFields['B78']['readonly']; ?> uk-input-<?= $backendFields['B78']['backend']; ?> uk-input uk-<?= $backendFields['B78']['type']; ?>" name="B78" id="B78" value="<?= (float) $itemValues['B78']; ?>" <?= $backendFields['B78']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B78']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B80</strong> <?= $backendFields['B80']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B80']['type']; ?>" class=" uk-input-<?= $backendFields['B80']['readonly']; ?> uk-input-<?= $backendFields['B80']['backend']; ?> uk-input uk-<?= $backendFields['B80']['type']; ?>" name="B80" id="B80" value="<?= (float) $itemValues['B80']; ?>" <?= $backendFields['B80']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B80']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B82</strong> <?= $backendFields['B82']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B82']['type']; ?>" class=" uk-input-<?= $backendFields['B82']['readonly']; ?> uk-input-<?= $backendFields['B82']['backend']; ?> uk-input uk-<?= $backendFields['B82']['type']; ?>" name="B82" id="B82" value="<?= (float) $itemValues['B82']; ?>" <?= $backendFields['B82']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B82']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B84</strong> <?= $backendFields['B84']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B84']['type']; ?>" class=" uk-input-<?= $backendFields['B84']['readonly']; ?> uk-input-<?= $backendFields['B84']['backend']; ?> uk-input uk-<?= $backendFields['B84']['type']; ?>" name="B84" id="B84" value="<?= (float) $itemValues['F27']; ?>" <?= $backendFields['B84']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B84']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B86</strong> <?= $backendFields['B86']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $backendFields['B86']['type']; ?>" class=" uk-input-<?= $backendFields['B86']['readonly']; ?> uk-input-<?= $backendFields['B86']['backend']; ?> uk-input uk-<?= $backendFields['B86']['type']; ?>" name="B86" id="B86" value="<?= (float) $itemValues['F29']; ?>" <?= $backendFields['B86']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $backendFields['B86']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>B88</strong> <?= $frontendFields['B88']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['B88']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['B88']['readonly']; ?> uk-input-<?= $frontendFields['B88']['backend']; ?> uk-input uk-<?= $frontendFields['B88']['type']; ?>" name="B88" id="B88" value="<?= $frontendFields['B88']['default']; ?>" <?= $frontendFields['B88']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['B88']['unit']; ?></div>
                </div>
            </div>
        </div>
        <div class="uk-width-1-2@s lessWidth">
            <h2 class="headContainer headContainerMargin"><span class="icon-icon_instandhaltung"></span>Instandsetzung OS-Beschichtung</h2>
            <div class="fieldMainContainer">
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F62</strong> <?= $frontendFields['F62']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F62']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F62']['readonly']; ?> uk-input-<?= $frontendFields['F62']['backend']; ?> uk-input uk-<?= $frontendFields['F62']['type']; ?>" name="F62" id="F62" value="<?= $frontendFields['F62']['default']; ?>" <?= $frontendFields['F62']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F62']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F64</strong> <?= $frontendFields['F64']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F64']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F64']['readonly']; ?> uk-input-<?= $frontendFields['F64']['backend']; ?> uk-input uk-<?= $frontendFields['F64']['type']; ?>" name="F64" id="F64" value="<?= $frontendFields['F64']['default']; ?>" <?= $frontendFields['F64']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F64']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F66</strong> <?= $frontendFields['F66']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F66']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F66']['readonly']; ?> uk-input-<?= $frontendFields['F66']['backend']; ?> uk-input uk-<?= $frontendFields['F66']['type']; ?>" name="F66" id="F66" value="<?= $frontendFields['F66']['default']; ?>" <?= $frontendFields['F66']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F66']['unit']; ?></div>
                </div>
                <div class="fieldContainer marginTop2">
                    <label class="uk-form-label"><strong>F70</strong> <?= $frontendFields['F70']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F70']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F70']['readonly']; ?> uk-input-<?= $frontendFields['F70']['backend']; ?> uk-input uk-<?= $frontendFields['F70']['type']; ?>" name="F70" id="F70" value="<?= $frontendFields['F70']['default']; ?>" <?= $frontendFields['F70']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F70']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F72</strong> <?= $frontendFields['F72']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F72']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F72']['readonly']; ?> uk-input-<?= $frontendFields['F72']['backend']; ?> uk-input uk-<?= $frontendFields['F72']['type']; ?>" name="F72" id="F72" value="<?= $frontendFields['F72']['default']; ?>" <?= $frontendFields['F72']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F72']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F74</strong> <?= $frontendFields['F74']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F74']['type']; ?>" class="inputChanger uk-input-<?= $frontendFields['F74']['readonly']; ?> uk-input-<?= $frontendFields['F74']['backend']; ?> uk-input uk-<?= $frontendFields['F74']['type']; ?>" name="F74" id="F74" value="<?= $frontendFields['F74']['default']; ?>" <?= $frontendFields['F74']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F74']['unit']; ?></div>
                </div>
                <div class="fieldContainer marginTop3">
                    <label class="uk-form-label"><strong>F80</strong> <?= $frontendFields['F80']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F80']['type']; ?>" class="inputChanger result uk-input-<?= $frontendFields['F80']['readonly']; ?> uk-input-<?= $frontendFields['F80']['backend']; ?> uk-input uk-<?= $frontendFields['F80']['type']; ?>" name="F80" id="F80" value="<?= $frontendFields['F80']['default']; ?>" <?= $frontendFields['F80']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F80']['unit']; ?></div>
                </div>
                <div class="fieldContainer">
                    <label class="uk-form-label"><strong>F82</strong> <?= $frontendFields['F82']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F82']['type']; ?>" class="inputChanger result uk-input-<?= $frontendFields['F82']['readonly']; ?> uk-input-<?= $frontendFields['F82']['backend']; ?> uk-input uk-<?= $frontendFields['F82']['type']; ?>" name="F82" id="F82" value="<?= $frontendFields['F82']['default']; ?>" <?= $frontendFields['F82']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F82']['unit']; ?></div>
                </div>
                <div class="fieldContainer marginTop3">
                    <label class="uk-form-label"><strong>F88</strong> <?= $frontendFields['F88']['label']; ?></label>
                    <div class="uk-form-controls">
                        <input type="<?= $frontendFields['F88']['type']; ?>" class="inputChanger result uk-input-<?= $frontendFields['F88']['readonly']; ?> uk-input-<?= $frontendFields['F88']['backend']; ?> uk-input uk-<?= $frontendFields['F88']['type']; ?>" name="F88" id="F88" value="<?= $frontendFields['F88']['default']; ?>" <?= $frontendFields['F88']['readonly']; ?>>
                    </div>
                    <div class="unit uk-form-label"><?= $frontendFields['F88']['unit']; ?></div>
                </div>
            </div>
        </div>
    </div>


    <!--<button class="uk-button uk-button-primary" type="submit">
        <span uk-icon="table"></span> Zur Tabelle
    </button>-->

    <button class="uk-button uk-button-primary" id="btnKostenentwicklung" type="submit">
        <span uk-icon="plus-circle"></span> Kostenentwicklung berechnen
    </button>

    <button class="uk-button uk-button-primary" type="submit" id="getPDF22"><span uk-icon="file-pdf"></span> Download PDF </button>

    <?php echo JHtml::_('form.token'); ?>



<div id="kostenentwicklungModal" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Kostenentwicklung</h2>
        </div>
        <div class="uk-modal-body uk-position-relative">
            <div id="preloader">
                <div uk-spinner="ratio: 3"></div>
                <h4 class="uk-heading-small">Kostenentwicklung wird berechnet...<br>Bitte warten</h4>
            </div>
            <div id="chartKostenentwicklung" style="height: 100%; width: 100%;"></div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button"><span uk-icon="close"></span> Schliessen</button>
        </div>
    </div>
</div>
    <!--<div>
        rhabarber rhabarber Telefonnummer oder so…
    </div>-->
</form>
<?php
echo $this->item->event->afterDisplayTitle;
echo $this->item->event->beforeDisplayContent;
echo $this->item->event->afterDisplayContent;

