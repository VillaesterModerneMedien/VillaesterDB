<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_vmmdatabase
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace CustomerNamespace\Component\Vmmdatabase\Site\Controller;


\defined('_JEXEC') or die;

require_once(JPATH_BASE . '/vendor/autoload.php');

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Response\JsonResponse;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\User\UserFactoryInterface;
use Joomla\Input\Input;
use Joomla\Plugin\System\Webauthn\Helper\Joomla;
use Joomla\Utilities\ArrayHelper;
use NumberFormatter;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use CustomerNamespace\Component\Vmmdatabase\Site\Helper\CalculatorHelper;
use CustomerNamespace\Component\Vmmdatabase\Site\Helper\TableLayoutHelper;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

/**
 * Controller for single customer view
 *
 * @since  __DEPLOY_VERSION__
 */
class CustomerController extends FormController
{
	/**
	 * The URL view item variable.
	 *
	 * @var    string
	 * @since  __DEPLOY_VERSION__
	 */
	protected $view_item = 'form';

    protected $allFields = [];

    protected $calcHelper;

    protected $spreadsheet;

    /**
     * Constructor.
     *
     * @param   array                 $config       An optional associative array of configuration settings.
     *                                              Recognized key values include 'name', 'default_task', 'model_path', and
     *                                              'view_path' (this list is not meant to be comprehensive).
     * @param   MVCFactoryInterface   $factory      The factory.
     * @param   CMSApplication        $app          The JApplication for the dispatcher
     * @param   Input                 $input        Input
     * @param   FormFactoryInterface  $formFactory  The form factory.
     *
     * @since   3.0
     */
    public function __construct($config = array(), MVCFactoryInterface $factory = null, ?CMSApplication $app = null, ?Input $input = null,
                                FormFactoryInterface $formFactory = null
    )
    {
        parent::__construct($config, $factory, $app, $input);

        $this->calcHelper =  new CalculatorHelper();

        $inputFileType = 'Xls';
       // $inputFileName = JPATH_BASE . '/vmmdatabasesafe.xls';
        $inputFileName = JPATH_BASE . '/vmmdatabaseMatthias_mm.xls';

        $sheetname = 'Berechnung';

        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Advise the Reader of which WorkSheets we want to load  **/
        $reader->setLoadSheetsOnly($sheetname);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $this->spreadsheet = $reader->load($inputFileName);
    }

    public function getResults()
    {
        $app = $this->app;

        $calcHelper = $this->calcHelper;
        $this->_getInputValues();
        $allFields = $this->allFields;
        setlocale(LC_MONETARY, 'de_DE');

        $fmt = numfmt_create( 'de_DE', NumberFormatter::CURRENCY );
        $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
        //extract($displayData);
        ksort($allFields);
        //var_dump($allFields);

        $spreadsheet = $this->spreadsheet;


        foreach ($allFields as $fieldName => $fieldValue)
        {
            $spreadsheet->getActiveSheet()->setCellValue($fieldName, $fieldValue);
        }

        //var_dump($calcHelper->spreadCalc('B88', $spreadsheet));
        //var_dump($calcHelper->spreadCalc('F88', $spreadsheet));die;

        $results = [
          'B94'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('B94', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('B94', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A94', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('B93', $spreadsheet),
          ],
          'E94'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('E94', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('E94', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A94', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('E93', $spreadsheet),
          ],
          'G94'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('G94', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('G94', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A94', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('G93', $spreadsheet),
          ],
          'H94'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('H94', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('H94', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A94', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('H93', $spreadsheet),
          ],

          'B157'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('B157', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('B157', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A157', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('B93', $spreadsheet),
          ],
          'E157'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('E157', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('E157', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A157', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('E93', $spreadsheet),
          ],
          'G157'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('G157', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('G157', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A157', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('G93', $spreadsheet),
          ],
          'H157'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('H157', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('H157', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A157', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('H93', $spreadsheet),
          ],

          'B184'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('B184', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('B184', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A184', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('B93', $spreadsheet),
          ],
          'E184'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('E184', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('E184', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A184', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('E93', $spreadsheet),
          ],
          'G184'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('G184', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('G184', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A184', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('G93', $spreadsheet),
          ],
          'H184'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('H184', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('H184', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A184', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('H93', $spreadsheet),
          ],

          'B210'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('B94', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('B210', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A210', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('B93', $spreadsheet),
          ],
          'E210'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('E94', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('E210', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A210', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('E93', $spreadsheet),
          ],
          'G210'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('G94', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('G210', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A210', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('G93', $spreadsheet),
          ],
          'H210'     =>    [
              'value'       =>  numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('H94', $spreadsheet), 'EUR'),
              'rawvalue'    =>  (float) $calcHelper->spreadCalc('H210', $spreadsheet),
              'label'       =>  $calcHelper->spreadCalc('A210', $spreadsheet),
              'labelTop'    =>  $calcHelper->spreadCalc('H93', $spreadsheet),
          ],
        ];

        if($results)
        {
            header('Content-Type: application/json');
            echo new JsonResponse($results);
        }
        $app->close();
    }


	public function showMatrixTable(){

        $basePath = JPATH_COMPONENT_ADMINISTRATOR . '/layouts';

        $document = Factory::getDocument();
        $document->addStyleSheet('/media/com_vmmdatabase/css/frontendTable.css');

        //TODO: Noch mal in der Gruppe nachfrtagen
       // Html::_('stylesheet', JPATH_SITE . 'media/com_vmmdatabase/css/frontendTable.css', array('version' => 'auto', 'relative' => true));

        $this->_getInputValues();

        echo LayoutHelper::render('vmmdatabase.matrixtable.ajaxAusgabe', $this->allFields);
    }

    /**
     * Holt die Werte aus dem Backend und die Werte aus dem Frontendform und sendet sie an die Tabelle
     */
    private function _getInputValues(){
        $app = $this->app;

        $result = array();

        $inputsArray = [
            'F3'    => 'Schieberegler',
            'B25'   => 'Bauweise – Splitlevel/Vollgeschoss',
            'B27'   => 'Anzahl Stellplätze',
            'B29'   => 'Grundfläche aller Ebenen inkl. Rampen',
            'B33'   =>  'Anzahl der Ebenen',
            'B35'   =>  'oberste Ebenen überdacht?',
            'B37'   =>  'unterste Ebene gepflastert?',
            'B39'   =>  'Feuerwiderstandsklasse des Tragwerks',
            //'B84'   =>  'Belagserneuerung einlagig mit Abdichtung',
            //'B86'   =>  'Belagserneuerung zweilagig mit Abdichtung',
            'B88'   =>  'Mietausfall pro Stellplatz infolge Wartung und Instandhaltung',
            'F31'   =>  'OS 8',
            'F33'   =>  'OS 11',
            'F49'   =>  'Kosten Monitoring',
            'F51'   =>  'Anzahl Trockenreinigung',
            'F53'   =>  'Kosten Trockenreinigung',
            'F55'   =>  'Anzahl Nassreinigung',
            'F57'   =>  'Kosten Nassreinigung',
            'F62'   =>  'Anzahl der Belagserneuerung für 100% der Fläche',
            'F64'   =>  'Anzahl der Belagserneuerung für 50% der Fläche',
            'F66'   =>  'Anzahl der Belagserneuerung für 30% der Fläche',
            'F70'   =>  'Anzahl der Belagserneuerung für 100% der Freifläche',
            'F72'   =>  'Entfernen und Entsorgen des Altbelages bei OS 8',
            'F74'   =>  'Entfernen und Entsorgen des Altbelages bei OS 11',
        ];

        foreach($inputsArray as $id => $text)
        {
            $result[$id] = $app->input->request->get($id, '', 'string');
        }

        $item = $this->getModel()->getItem($app->input->request->get('id', '', 'INT'));
        $felder = json_decode($item->felder, true);

        foreach($felder['customerParameter'] as $name => $value)
        {
            $result[$name] = $value;
        }

        foreach($felder['berechnungsansaetze'] as $name => $value)
        {
            $result[$name] = $value;
        }

        $this->allFields = $result;
    }

    /**
     * Ajax: Generiere und hole Werte für die Kostenentwicklung
     */
    public function getKostenentwicklung()
    {

        $spreadsheet = $this->spreadsheet;
        $calcHelper = $this->calcHelper;
        Calculation::getInstance($spreadsheet)->disableCalculationCache();

        $this->_getInputValues();
        $allFields = $this->allFields;

        foreach ($allFields as $fieldName => $fieldValue)
        {
            $spreadsheet->getActiveSheet()->setCellValue($fieldName, $fieldValue);
        }

        $jahresResult = [];

        for($i = 1; $i <= 50;$i++ )
        {
            $spreadsheet->getActiveSheet()->setCellValue('F3', $i);
//
            $jahresResult[$i] = [
                'B94'   =>   $calcHelper->spreadCalc('B94', $spreadsheet),
                'E94'   =>   $calcHelper->spreadCalc('E94', $spreadsheet),
                'G94'   =>   $calcHelper->spreadCalc('G94', $spreadsheet),
                'H94'   =>   $calcHelper->spreadCalc('H94', $spreadsheet),
            ];
        }

        if($jahresResult)
        {
            header('Content-Type: application/json');
            echo new JsonResponse($jahresResult);
        }
        $this->app->close();
    }

    public function getPDF()
    {
        require_once JPATH_SITE . '/components/com_vmmdatabase/src/Helper/vendor/autoload.php';


        $params = ComponentHelper::getParams('com_vmmdatabase');
        $hinweistext = $params->get('hinweistext', '');
        $obererText = $params->get('oberertext', '');

        $spreadsheet = $this->spreadsheet;
        $calcHelper = $this->calcHelper;

        setlocale(LC_MONETARY, 'de_DE');
        $fmt = numfmt_create( 'de_DE', NumberFormatter::DECIMAL );
        $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);

        $this->_getInputValues();
        $allFields = $this->allFields;

        foreach ($allFields as $fieldName => $fieldValue)
        {
            $spreadsheet->getActiveSheet()->setCellValue($fieldName, $fieldValue);
        }

        $html = $obererText;

        $html .= '<table>';

        $tableChar = [
            'A',
            'B',
            'E',
            'G',
            'H',
            'I'
        ];

        for($i = 93; $i <= 210;$i++ )
        {
            if($i != 132)
            {
                $html .= '<tr class="row' . $i .'">';
                foreach ($tableChar as $char)
                {
                    $type = gettype($calcHelper->spreadCalc($char . $i, $spreadsheet));

                    switch ($type) {
                        case 'NULL':
                            $value = '';
                            break;
                        case 'integer':
                            $value = numfmt_format($fmt, (float) $calcHelper->spreadCalc($char . $i, $spreadsheet));
                            break;
                        case 'double':
                            $value = numfmt_format($fmt, (float) $calcHelper->spreadCalc($char . $i, $spreadsheet));
                            break;
                        case 'string':
                            $value = $calcHelper->spreadCalc($char . $i, $spreadsheet);
                            break;
                    }

                    $html .= '<td id="' . $char . $i . '" class="cell' . $char . '">' .  $value  . '</td>';
                }
                $html .= '</tr>';
            }

        }
        $html .= '</table>';

        $html .= $hinweistext;

        $stylesheet = file_get_contents(JPATH_SITE . '/media/com_vmmdatabase/css/detailPrint.css');
        $filename = JPATH_BASE . '/images/testname'  . strtotime(date_create()->format('Y-m-d H:i:s')) . '.pdf';

        $downloadFilename =  'LifeCyclekosten-Berechnung-' . strtotime(date_create()->format('Y-m-d H:i:s')) . '.pdf';

        try {
            ob_clean();
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

            header('Content-Type: application/x-download');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            header('Cache-Control: private, max-age=0, must-revalidate');
            header('Pragma: public');
            $mpdf->Output($downloadFilename, \Mpdf\Output\Destination::DOWNLOAD);
            exit;


        } catch (\Mpdf\MpdfException $e) {
            echo $e->getMessage();
        }
    }
}
