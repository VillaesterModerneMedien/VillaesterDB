<?php

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use CustomerNamespace\Component\Vmmdatabase\Site\Helper\CalculatorHelper;


$calcHelper = new CalculatorHelper();

setlocale(LC_MONETARY, 'de_DE');

$fmt = numfmt_create( 'de_DE', NumberFormatter::CURRENCY );
$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

require_once(JPATH_BASE . '/vendor/autoload.php');

$inputFileType = 'Xls';
$inputFileName = JPATH_BASE . '/lcctestneu.xls';

$sheetname = 'Berechnung';

/**  Create a new Reader of the type defined in $inputFileType  **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
/**  Advise the Reader of which WorkSheets we want to load  **/
$reader->setLoadSheetsOnly($sheetname);
/**  Load $inputFileName to a Spreadsheet Object  **/
$spreadsheet = $reader->load($inputFileName);

foreach ($displayData as $fieldName => $fieldValue)
{
    $spreadsheet->getActiveSheet()->setCellValue($fieldName, $fieldValue);
}

?>

<table>
    <tr class="tableHead">
        <td>Life Cycle Kosten gesamt</td>
        <td>Spannbetondecken mit Bitumen-abdichtung und Gussasphalt</td>
        <td>Trapezblechdecken mit Aufbeton und OS8 / OS 11</td>
        <td>Elementdecken mit Aufbeton bzw. Ortbetondecken oberflächenfertig</td>
        <td>oberflächenfertige Fertigteildecken</td>
    </tr>

<?php
    Calculation::getInstance($spreadsheet)->disableCalculationCache();

    for($i = 1; $i <= 50;$i++ )
    {
        $spreadsheet->getActiveSheet()->setCellValue('F3', $i);
        ?>

            <tr>
                <td><?= $i;?> Jahre</td>
                <td>
                    <?= numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('B94', $spreadsheet), 'EUR'); ?>
                </td>
                <td>
                    <?= numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('E94', $spreadsheet), 'EUR'); ?>
                </td>
                <td>
                    <?= numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('G94', $spreadsheet), 'EUR'); ?>
                </td>
                <td>
                    <?= numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('H94', $spreadsheet), 'EUR'); ?>
                </td>
            </tr>

        <?php
     }
?>
</table>
