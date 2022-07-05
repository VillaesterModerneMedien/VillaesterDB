<?php

use CustomerNamespace\Component\Vmmdatabase\Site\Helper\CalculatorHelper;


$calcHelper = new CalculatorHelper();

setlocale(LC_MONETARY, 'de_DE');

$fmt = numfmt_create( 'de_DE', NumberFormatter::CURRENCY );
$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
//extract($displayData);
ksort($displayData);
var_dump($displayData);
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
//$spreadsheet->getActiveSheet()->setCellValue('O1', $O1);
//$spreadsheet->getActiveSheet()->setCellValue('F3', $F3);

?>


<table>
    <tr class="tableHead">
        <td></td>
        <td class="tableHead">Spannbetondecken mit Bitumen-abdichtung und Gussasphalt</td>
        <td class="tableHead">Trapezblechdecken mit Aufbeton und OS8 / OS 11</td>
        <td class="tableHead">Elementdecken mit Aufbeton bzw. Ortbetondecken oberflächenfertig</td>
        <td class="tableHead">oberflächenfertige Fertigteildecken</td>
    </tr>
    <tr>
        <td>Life Cycle Kosten gesamt [€]</td>
        <td id="B94">
            <?= numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('B94', $spreadsheet), 'EUR'); ?>
        </td>
        <td id="E94">
            <?= numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('E94', $spreadsheet), 'EUR'); ?>
        </td>
        <td id="G94">
            <?= numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('G94', $spreadsheet), 'EUR'); ?>
        </td>
        <td id="H94">
            <?= numfmt_format_currency($fmt, (float) $calcHelper->spreadCalc('H94', $spreadsheet), 'EUR'); ?>
        </td>
    </tr>
    <tr>
        <td id="A95">Bauweise - Splitlevel / Vollgeschoss</td>
        <td id="B95">
            <?= $calcHelper->spreadCalc('B95', $spreadsheet); ?>
        </td>
        <td id="E95">
            <?= $calcHelper->spreadCalc('E95', $spreadsheet); ?>
        </td>
        <td id="G95">
            <?= $calcHelper->spreadCalc('G95', $spreadsheet); ?>
        </td>
        <td id="H95">
            <?= $calcHelper->spreadCalc('H95', $spreadsheet); ?>
        </td>
    </tr>
    <tr>
        <td id="A96">Anzahl Stellplätze [Stück]</td>
        <td id="B96">
            <?= $calcHelper->spreadCalc('B96', $spreadsheet); ?>
        </td>
        <td id="E96">
            <?= $calcHelper->spreadCalc('E96', $spreadsheet); ?>
        </td>
        <td id="G96">
            <?= $calcHelper->spreadCalc('G96', $spreadsheet); ?>
        </td>
        <td id="H96">
            <?= $calcHelper->spreadCalc('H96', $spreadsheet); ?>
        </td>
    </tr>
    <tr>
        <td id="A97">Grundfläche alle Ebenen inkl. Rampen [m²]</td>
        <td id="B97">
            <?= $calcHelper->spreadCalc('B97', $spreadsheet); ?>
        </td>
        <td id="E97">
            <?= $calcHelper->spreadCalc('E97', $spreadsheet); ?>
        </td>
        <td id="G97">
            <?= $calcHelper->spreadCalc('G97', $spreadsheet); ?>
        </td>
        <td id="H97">
            <?= $calcHelper->spreadCalc('H97', $spreadsheet); ?>
        </td>
    </tr>
    <tr>
        <td>Verhältnis [m² / Stellplatz]</td>
        <td id="B98">
         <?php
         //##
         $B98 = 25;
         echo $B98;
         ?>
        </td>
        <td id="E98">
         <?php
         //##
         $E98 = 25;
         echo $E98;
         ?>
        </td>
        <td id="G98">
         <?php
         //##
         $G98 = 25;
         echo $G98;
         ?>

        </td>
        <td id="H98">
         <?php
         //##
         $H98 = 25;
         echo $H98;
         ?>
        </td>
    </tr>
    <tr>
        <td>Anzahl der Ebenen [Stück]</td>
        <td id="B99">
         <?php
         //##
         $B99 = 5;
         echo $B99;
         ?>
        </td>
        <td id="E99">
         <?php
         //##
         $E99 = 5;
         echo $E99;
         ?>
        </td>
        <td id="G99">
         <?php
         //##
         $G99 = 5;
         echo $G99;
         ?>
        </td>
        <td id="H99">
         <?php
         //##
         $H99 = 5;
         echo $H99;
         ?>
        </td>
    </tr>
    <tr>
        <td>oberste Ebenen überdacht?</td>
        <td id="B100">
         <?php
         //##
         $B100 = 'ja';
         echo $B100;
         ?>
        </td>
        <td id="E100">
         <?php
         //##
         $E100 = 'ja';
         echo $E100;
         ?>
        </td>
        <td id="G100">
         <?php
         //##
         $G100 = 'ja';
         echo $G100;
         ?>
        </td>
        <td id="H100">
         <?php
         //##
         $H100 = 'ja';
         echo $H100;
         ?>
        </td>
    </tr>
    <tr>
        <td>unterste Ebene gepflastert?</td>
        <td id="B101">
         <?php
         //##
         $B101 = 'nein';
         echo $B101;
         ?>
        </td>
        <td id="E101">
         <?php
         //##
         $E101 = 'nein';
         echo $E101;
         ?>
        </td>
        <td id="G101">
         <?php
         //##
         $G101 = 'nein';
         echo $G101;
         ?>
        </td>
        <td id="H101">
         <?php
         //##
         $H101 = 'nein';
         echo $H101;
         ?>
        </td>
    </tr>
    <tr>
        <td>Feuerwiderstandsklasse des Tragwerks?</td>
        <td id="B102">
         <?php
         //##
         $B102 = 'F0';
         echo $B102;
         ?>
        </td>
        <td id="E102">
         <?php
         //##
         $E102 = 'F0';
         echo $E102;
         ?>
        </td>
        <td id="G102">
         <?php
         //##
         $G102 = 'F0';
         echo $G102;
         ?>
        </td>
        <td id="H102">
         <?php
         //##
         $H102 = 'F0';
         echo $H102;
         ?>
        </td>
    </tr>
    <tr>
        <td>Kosten Gussasphalt einlagig [€/m²]</td>
        <td id="B103">
         <?php
         //##
         $B103 = 80;
         echo $B103;
         ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Kosten Gussasphalt zweilagig [€/m²]</td>
        <td id="B104">
         <?php
         //##
         $B104 = 95;
         echo $B104;
         ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Kosten OS 8 [€/m²]</td>
        <td class="schraffiert"></td>
        <td id="E105">
         <?php
         //##
         $E105 = 41;
         echo $E105;
         ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Kosten OS 11 [€/m²]</td>
        <td class="schraffiert"></td>
        <td id="E106">
         <?php
         //##
         $E106 = 62;
         echo $E106;
         ?>
        </td>
        <td class="schraffiert" colspan=2></td>
        </tr>
    <tr>
        <td>Anzahl Monitoring in den ersten 5 Jahren [Stück/Jahr]</td>
        <td id="B107">
         <?php
         //##
         $B107 = 1;
         echo $B107;
         ?>
        </td>
        <td id="E107">
         <?php
         //##
         $E107 = 1;
         echo $E107;
         ?>
        </td>
        <td id="G107">
         <?php
         //##
         $G107 = 1;
         echo $G107;
         ?>
        </td>
        <td id="H107">
         <?php
         //##
         $H107 = 1;
         echo $H107;
         ?>
        </td>
    </tr>
    <tr>
        <td>Anzahl Monitoring nach den ersten 5 Jahren [Stück/Jahr]</td>
        <td id="B108">
         <?php
         //##
         $B108 = 0.5;
         echo $B108 ;
         ?>
        </td>
        <td id="E108">
         <?php
         //##
         $E108 = 1;
         echo $E108;
         ?>
        </td>
        <td id="G108">
         <?php
         //##
         $G108 = 1;
         echo $G108;
         ?>
        </td>
        <td id="H108">
         <?php
         //##
         $H108 = 1;
         echo $H108;
         ?>
        </td>
    </tr>

    <tr>
        <td>Kosten Monitoring [€/m²]</td>
        <td id="B109">
         <?php
         //##
         $B109 = 0.2;
         echo $B109;
         ?>
        </td>
        <td id="E109">
         <?php
         //##
         $E109 = 0.3;
         echo $E109;
         ?>
        </td>
        <td id="G109">
         <?php
         //##
         $G109 = 0.3;
         echo $G109;
         ?>
        </td>
        <td id="H109">
         <?php
         //##
         $H109 = 0.2;
         echo $H109;
         ?>
        </td>
    </tr>
    <tr>
        <td>Anzahl Trockenreinigung</td>
        <td id="B110">
         <?php
         //##
         $B110 = 1;
         echo $B110;
         ?>
        </td>
        <td id="E110">
         <?php
         //##
         $E110 = 1;
         echo $E110;
         ?>
        </td>
        <td id="G110">
         <?php
         //##
         $G110 = 1;
         echo $G110;
         ?>
        </td>
        <td id="H110">
         <?php
         //##
         $H110 = 1;
         echo $H110;
         ?>
        </td>
    </tr>
    <tr>
        <td>Kosten Trockenreinigung [€/m²]</td>
        <td id="B111">
        <?php
         //##
         $B111 = 0.4;
         echo $B111;
         ?>
        </td>
        <td id="E111">
        <?php
         //##
         $E111 = 0.4;
         echo $E111;
         ?>
        </td>
        <td id="G111">
                    <?php
         //##
         $G111 = 0.4;
         echo $G111;
         ?>
        </td>
        <td id="H111">
                    <?php
         //##
         $H111 = 0.4;
         echo $H111;
         ?>
        </td>
    </tr>
    <tr>
         <td>Anzahl Nassreinigung [Stück/Jahr]</td>
         <td id="B112">
             <?php
             //##
             $B112 = 0;
             echo $B112;
             ?>
         </td>
         <td id="E112">
             <?php
             //##
             $E112 = 2;
             echo $E112;
             ?>
         </td>
         <td id="G112">
             <?php
             //##
             $G112 = 2;
             echo $G112;
             ?>
         </td>
         <td id="H112">
             <?php
             //##
             $H112 = 2;
             echo $H112;
             ?>
         </td>
    </tr>
    <tr>
        <td>Kosten Nassreinigung [€/m²]</td>
        <td id="B113">
             <?php
             //##
             $B113 = 0.8;
             echo $B113;
             ?>
        </td>
        <td id="E113">
             <?php
             //##
             $E113 = 0.8;
             echo $E113;
             ?>
        </td>
        <td id="G113">
             <?php
             //##
             $G113 = 0.8;
             echo $G113;
             ?>
        </td>
        <td id="H113">
         <?php
         //##
         $H113 = 0.8;
         echo $H113;
         ?>
        </td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung für 100% der Fläche (bei Gussasphalt ohne Abdichtung) im Betrachtungszeitraum [Stück]</td>
        <td id="B114">
         <?php
         //##
         $B114 = 0;
         echo $B114;
         ?>
        </td>
        <td id="E114">
         <?php
         //##
         $E114 = 2;
         echo $E114;
         ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung für 50% der Fläche (bei Gussasphalt ohne Abdichtung)im Betrachtungszeitraum [Stück]</td>
        <td id="B115">
         <?php
         //##
         $B115 = 0;
         echo $B115;
         ?>
        </td>
        <td id="E115">
         <?php
         //##
         $E115 = 2;
         echo $E115;
         ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung für 30% der Fläche (bei Gussasphalt ohne Abdichtung)im Betrachtungszeitraum [Stück]</td>
        <td id="B116">
         <?php
         //##
         $B116 = 1;
         echo $B116;
         ?>
        </td>
        <td id="E116">
         <?php
         //##
         $E116 = 5;
         echo $E116;
         ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung für 30% der Fläche mit Abdichtung (bei Gussasphalt)im Betrachtungszeitraum [Stück]</td>
        <td id="B117">
         <?php
         //##
         $B117 = 3;
         echo $B117;
         ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung für 100% der Freifläche (bei Gussasphalt mit Abdichtung)im Betrachtungszeitraum [Stück]</td>
        <td id="B118">
         <?php
         //##
         $B118 = 0;
         echo $B118;
         ?>
        </td>
        <td id="E118">
         <?php
         //##
         $E118 = 2;
         echo $E118;
         ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Entfernen und Entsorgen des Altbelages für einlagigen Gussasphalt ohne Abdichtung [€/m²]</td>
        <td id="B119">
         <?php
         //##
         $B119 = 5;
         echo $B119;
         ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Entfernen und Entsorgen des Altbelages für zweilagigen Gussasphalt ohne Abdichtung [€/m²]</td>
        <td id="B120">
         <?php
         //##
         $B120 = 10;
         echo $B120;
         ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Entfernen und Entsorgen des Altbelages für einlagigen Gussasphalt mit Abdichtung [€/m²]</td>
        <td id="B121">
            <?php
            //##
            $B121 = 56;
            echo $B121;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Entfernen und Entsorgen des Altbelages für zweilagigen Gussasphalt mit Abdichtung [€/m²]</td>
        <td id="B122">
            <?php
            //##
            $B122 = 61;
            echo $B122;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Belagserneuerung einlagig ohne Abdichtung [€/m²]</td>
        <td id="B123">
            <?php
            //##
            $B123 = 40;
            echo $B123;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Belagserneuerung zweilagig ohne Abdichtung [€/m²]</td>
        <td id="B124">
            <?php
            //##
            $B124 = 55;
            echo $B124;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Belagserneuerung einlagig mit Abdichtung [€/m²]</td>
        <td id="B125">
            <?php
            //##
            $B125 = 80;
            echo $B125;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Belagserneuerung zweilagig mit Abdichtung [€/m²]</td>
        <td id="B126">
            <?php
            //##
            $B126 = 95;
            echo $B126;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Entfernen und Entsorgen des Altbelages bei OS 8 [€/m²]</td>
        <td class="schraffiert"></td>
        <td id="E127">
            <?php
            //##
            $E126 = 0.4;
            echo $E126;
            ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Entfernen und Entsorgen des Altbelages bei OS 11 [€/m²]</td>
        <td class="schraffiert"></td>
        <td id="E128">
            <?php
            //##
            $E128 = 10;
            echo $E128;
            ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Belagserneuerung mit OS 8 [€/m²]</td>
        <td class="schraffiert"></td>
        <td id="E129">
            <?php
            //##
            $E129 = 41;
            echo $E129;
            ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Belagserneuerung mit OS 11 [€/m²]</td>
        <td class="schraffiert"></td>
        <td id="E130">
            <?php
            //##
            $E130 = 62;
            echo $E130;
            ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
         <td>Mietausfall pro Stellplatz infolge Wartung und Instandhaltung [€/Monat]</td>
         <td id="B131">
             <?php
             //##
             $E131 = 100;
             echo $E131;
             ?>
         </td>
         <td id="E131">
             <?php
             //##
             $E131 = 100;
             echo $E131;
             ?>
         </td>
         <td id="G131">
             <?php
             //##
             $G131 = 100;
             echo $G131;
             ?>
         </td>
         <td id="H131">
             <?php
             //##
             $H131 = 100;
             echo $H131;
             ?>
         </td>
    </tr>
    <tr>
         <td>vom Mietausfall betroffene Stellplätze im Betrachtungszeitraum *1 [Stück]</td>
         <td id="B132">
             <?php
             //##
             $B132 = 1200;
             echo $B132;
             ?>
         </td>
         <td id="E132">
             <?php
             //##
             $E132 = 4500;
             echo $E132;
             ?>
         </td>
         <td id="G132">
             <?php
             //##
             $G132 = 45000;
             echo $G132;
             ?>
         </td>
         <td id="H132">
             <?php
             //##
             $H132 = 45000;
             echo $H132;
             ?>
         </td>
    </tr>
    <tr>
         <td>Mietausfalldauer *2 [Monate/Stellplatz]</td>
         <td id="B133">
             <?php
             //##
             $B133 = 18.30;
             echo $B133;
             ?>
         </td>
         <td id="E133">
             <?php
             //##
             $E133 = 67.50;
             echo $E133;
             ?>
         </td>
         <td id="G133">
             <?php
             //##
             $G133 = 135;
             echo $G133;
             ?>
         </td>
         <td id="H133">
             <?php
             //##
             $H133 = 45;
             echo $H133;
             ?>
         </td>
    </tr>
    <tr>
        <td>Kosten ohne Abdichtungssysteme [€]</td>
        <td id="B134">
            <?php
            //##
            $B134 = 9720;
            echo $B134;
            var_dump($B134);
            ?>
        </td>
        <td id="E134">
            <?php
            //##
            $E134 = 9720;
            echo $E134;
            ?>
        </td>
        <td id="G134">
            <?php
            //##
            $G134 = 9720;
            echo $G134;
            ?>
        </td>
        <td id="H134">
            <?php
            //##
            $H134 = 9720;
            echo $H134;
            ?>
        </td>
    </tr>
    <tr>
         <td>Kosten Abdichtungssysteme [€]</td>
         <td id="B135">
             <?php
             //##
             $B135 = 1513182.40;
             echo $B135;
             ?>
         </td>
         <td id="E135">
             <?php
             //##
             $E135 = 911916.80;
             echo $E135;
             ?>
         </td>
         <td id="G135">
             <?php
             //##
             $G135 = 310000;
             echo $G135;
             ?>
         </td>
         <td id="H135">
             <?php
             //##
             $H135 = 310000;
             echo $H135;
             ?>
         </td>
    </tr>
    <tr>
         <td>Kosten Brandschutz F30 [€]</td>
         <td id="B136">
             <?php
             //##
             $B136 = 0;
             echo $B136;
             ?>
         </td>
         <td id="E136">
             <?php
             //##
             $E136 = 0;
             echo $E136;
             ?>
         </td>
         <td id="G136">
             <?php
             //##
             $G136 = 0;
             echo $G136;
             ?>
         </td>
         <td id="H136">
             nicht möglich
         </td>
    </tr>
    <tr>
         <td>Kosten Brandschutz F90 [€]</td>
         <td id="B137">
             <?php
             //##
             $E137 = 0;
             echo $E137;
             ?>
         </td>
         <td id="E137">
             <?php
             //##
             $E137 = 0;
             echo $E137;
             ?>
         </td>
         <td id="G137">
             <?php
             //##
             $G137 = 0;
             echo $G137;
             ?>
         </td>
         <td id="H137">nicht möglich</td>
    </tr>
    <tr>
         <td>Grundfläche pro Ebene [m²]</td>
         <td id="B138">
             <?php
             //##
             $B138 = 5000;
             echo $B138;
             ?>
         </td>
         <td id="E138">
             <?php
             //##
             $E138 = 5000;
             echo $E138;
             ?>
         </td>
         <td id="G138">
             <?php
             //##
             $G138 = 5000;
             echo $G138;
             ?>
         </td>
         <td id="H138">
             <?php
             //##
             $H138 = 5000;
             echo $H138;
             ?>
         </td>
    </tr>
    <tr>
         <td>Geschossfläche [m²]</td>
         <td id="B139">
             <?php
             //##
             $B139 = 10000;
             echo $B139;
             ?>
         </td>
         <td id="E139">
             <?php
             //##
             $E139 = 10000;
             echo $E139;
             ?>
         </td>
         <td id="G139">
             <?php
             //##
             $G139 = 10000;
             echo $G139;
             ?>
         </td>
         <td id="H139">
             <?php
             //##
             $H139 = 10000;
             echo $H139;
             ?>
         </td>
    </tr>
    <tr>
         <td>Oberflächen mit Systemaufbau [m²]</td>
         <td id="B140">
             <?php
             //##
             $B140 = 20000;
             echo $B140;
             ?>
         </td>
         <td id="E140">
             <?php
             //##
             $E140 = 20000;
             echo $E140;
             ?>
         </td>
         <td id="G140">
             <?php
             //##
             $G140 = 20000;
             echo $G140;
             ?>
         </td>
         <td id="H140">
             <?php
             //##
             $H140 = 20000;
             echo $H140;
             ?>
         </td>
    </tr>
    <tr>
         <td>davon Oberflächen Freideck [m²]</td>
         <td id="B141">
             <?php
             //##
             $B141 = 0;
             echo $B141;
             ?>
         </td>
         <td id="E141">
             <?php
             //##
             $E141 = 0;
             echo $E141;
             ?>
         </td>
         <td id="G141">
             <?php
             //##
             $G141 = 0;
             echo $G141;
             ?>
         </td>
         <td id="H141">
             <?php
             //##
             $H141 = 0;
             echo $H141;
             ?>
         </td>
    </tr>
    <tr>
        <td>Anzahl Rampen mit Gussasphalt [Stück]</td>
        <td id="B142">
            <?php
            //##
            $B142 = 3;
            echo $B142;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Rampenflächen mit Gussasphalt [m²]</td>
        <td id="B143">
            <?php
            //##
            $B143 = 212.16;
            echo $B143;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Gussasphalt einlagig [m²]</td>
        <td id="B144">
            <?php
            //##
            $B144 = 14787.84;
            echo $B144;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Gussasphalt zweilagig [m²]</td>
        <td id="B145">
            <?php
            //##
            $B145 = 212.16;
            echo $B145;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>OS 8 [m²]</td>
        <td class="schraffiert"></td>
        <td id="E146">
            <?php
            //##
            $E146 = 14787.84;
            echo $E146;
            ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
         <td>OS 11 [m²]</td>
         <td id="B147">
             <?php
             //##
             $B147 = 4929.28;
             echo $B147;
             ?>
         </td>
         <td id="E147">
             <?php
             //##
             $E147 = 4929.28;
             echo $E147;
             ?>
         </td>
         <td id="G147">
             <?php
             //##
             $G147 = 4929.28;
             echo $G147;
             ?>
         </td>
         <td id="H147">
             <?php
             //##
             $H147 = 4929.28;
             echo $H147;
             ?>
         </td>
    </tr>
    <tr>
         <td>Anzahl Rampen mit OS 11 [Stück]</td>
         <td id="B148">
             <?php
             //##
             $B148 = 1;
             echo $B148;
             ?>
         </td>
         <td id="E148">
             <?php
             //##
             $E148 = 4;
             echo $E148;
             ?>
         </td>
         <td id="G148">
             <?php
             //##
             $B148 = 1;
             echo $B148;
             ?>
         </td>
         <td id="H148">
             <?php
             //##
             $H148 = 1;
             echo $H148;
             ?>
         </td>
    </tr>
    <tr>
         <td>Rampenfläche mit OS 11 [m²]</td>
         <td id="B149">
             <?php
             //##
             $B149 = 70.72;
             echo $B149;
             ?>
         </td>
         <td id="E149">
             <?php
             //##
             $E149 = 282.88;
             echo $E149;
             ?>
         </td>
         <td id="G149">
             <?php
             //##
             $G149 = 70.72;
             echo $G149;
             ?>
         </td>
         <td id="H149">
             <?php
             //##
             $H149 = 70.72;
             echo $H149;
             ?>
         </td>
    </tr>
    <tr>
         <td>Grundfläche Erdgeschossebene [m²]</td>
         <td id="B150">
             <?php
             //##
             $B150 = 5000;
             echo $B150;
             ?>
         </td>
         <td id="E150">
             <?php
             //##
             $E150 = 5000;
             echo $E150;
             ?>
         </td>
         <td id="G150">
             <?php
             //##
             $G150 = 5000;
             echo $G150;
             ?>
         </td>
         <td id="H150">
             <?php
             //##
             $H150 = 5000;
             echo $H150;
             ?>
         </td>
    </tr>
    <tr>
         <td>Grundfläche Untergeschoss [m²]</td>
         <td id="B151">
             <?php
             //##
             $B151 = 5000;
             echo $B151;
             ?>
         </td>
         <td id="E151">
             <?php
             //##
             $E151 = 5000;
             echo $E151;
             ?>
         </td>
         <td id="G151">
             <?php
             //##
             $G151 = 5000;
             echo $G151;
             ?>
         </td>
         <td id="H151">
             <?php
             //##
             $H151 = 5000;
             echo $H151;
             ?>
         </td>
    </tr>
    <tr>
        <td>Fläche oberflächenfertiger Ortbeton [m²]</td>
        <td class="schraffiert" colspan=2></td>
        <td id="G152">
            <?php
            //##
            $G152 = 15000;
            echo $G152;
            ?>
        </td>
        <td class="schraffiert"></td>
    </tr>
    <tr>
        <td>Fläche Fertigteildecken [m²]</td>
        <td class="schraffiert" colspan=3></td>
        <td id="H153">
            <?php
            //##
            $H153 = 5000;
            echo $H153;
            ?>
        </td>
    </tr>
    <tr>
         <td>Oberflächen Pflaster [m²]</td>
         <td id="B154">
             <?php
             //##
             $B154 = 5000;
             echo $B154;
             ?>
         </td>
         <td id="E154">
             <?php
             //##
             $E154 = 5000;
             echo $E154;
             ?>
         </td>
         <td id="G154">
             <?php
             //##
             $G154 = 5000;
             echo $G154;
             ?>
         </td>
         <td id="H154">
             <?php
             //##
             $H154 = 5000;
             echo $H154;
             ?>
         </td>
    </tr>
    <tr>
         <td>Oberflächen &quot;weiße Wanne&quot; [m²]</td>
         <td id="B155">
             <?php
             //##
             $B155 = 5000;
             echo $B155;
             ?>
         </td>
         <td id="E155">
             <?php
             //##
             $E155 = 5000;
             echo $E155;
             ?>
         </td>
         <td id="G155">
             <?php
             //##
             $G155 = 5000;
             echo $G155;
             ?>
         </td>
         <td id="H155">
             <?php
             //##
             $H155 = 5000;
             echo $H155;
             ?>
         </td>
    </tr>
    <tr>
         <td>Dachfläche [m²]</td>
         <td id="B156">
             <?php
             //##
             $B156 = 10000;
             echo $B156;
             ?>
         </td>
         <td id="E156">
             <?php
             //##
             $E156 = 10000;
             echo $E156;
             ?>
         </td>
         <td id="G156">
             <?php
             //##
             $G156 = 5000;
             echo $G156;
             ?>
         </td>
         <td id="H156">
             <?php
             //##
             $H156 = 1000;
             echo $H156;
             ?>
         </td>
    </tr>
    <tr>
         <td>Wartungskosten [€]</td>
         <td id="B157">
             <?php
             //##
             $B157 = 957500;
             echo $B157;
             ?>
         </td>
         <td id="E157">
             <?php
             //##
             $E157 = 2300000;
             echo $E157;
             ?>
         </td>
         <td id="G157">
             <?php
             //##
             $G157 = 2375000;
             echo $G157;
             ?>
         </td>
         <td id="H157">
             <?php
             //##
             $H157 = 5000;
             echo $H157;
             ?>
         </td>
    </tr>
    <tr>
        <td>Anzahl Monitoring Gussasphalt im Betrachtungszeitraum [Stück]</td>
        <td id="B158">
            <?php
            //##
            $B158 = 27.50;
            echo $B158;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
         <td>Anzahl Monitoring OS Beschichtung imBetrachtungszeitraum [Stück]</td>
         <td id="B159">
             <?php
             //##
             $B159 = 50;
             echo $B159;
             ?>
         </td>
         <td id="E159">
             <?php
             //##
             $E159 = 50;
             echo $E159;
             ?>
         </td>
         <td id="G159">
             <?php
             //##
             $G159 = 50;
             echo $G159;
             ?>
         </td>
         <td id="H159">
             <?php
             //##
             $H159 = 50;
             echo $H159;
             ?>
         </td>
    </tr>
    <tr>
        <td>Kosten Monitoring Gussasphalt [€]</td>
        <td id="B160">
            <?php
            //##
            $B160 = 82500;
            echo $B160;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
         <td>Kosten Monitoring OS Beschichtung [€]</td>
         <td id="B161">
             <?php
             //##
             $B161 = 75000;
             echo $B161;
             ?>
         </td>
         <td id="E161">
             <?php
             //##
             $E161 = 300000;
             echo $E161;
             ?>
         </td>
         <td id="G161">
             <?php
             //##
             $G161 = 75000;
             echo $G161;
             ?>
         </td>
         <td id="H161">
             <?php
             //##
             $H161 = 75000;
             echo $H161;
             ?>
         </td>
    </tr>
    <tr>
        <td>Anzahl Monitoring oberflächenfertigeOrtbetondecken im Betrachtungs-zeitraum [Stück]</td>
        <td class="schraffiert"></td>
        <td id="G162">
            <?php
            //##
            $G162 = 50;
            echo $G162;
            ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Kosten Monitoring oberflächenfertigeOrtbetondecken [€]</td>
        <td class="schraffiert" colspan=2></td>
        <td id="G163">
            <?php
            //##
            $G163 = 300000;
            echo $G163;
            ?>
        </td>
        <td class="schraffiert"></td>
    </tr>
    <tr>
        <td>Anzahl Monitoring oberflächenfertigeFertigteildecken im Betrachtungszeitraum [Stück]</td>
        <td class="schraffiert" colspan=3></td>
        <td id="H164">
            <?php
            //##
            $H164 = 50;
            echo $H164;
            ?>
        </td>
    </tr>
    <tr>
        <td>Kosten Monitoring oberflächenfertigeFertigteildecken [€]</td>
        <td class="schraffiert" colspan=3></td>
        <td id="H165">
            <?php
            //##
            $H165 = 225000;
            echo $H165;
            ?>
        </td>
    </tr>
    <tr>
         <td>Kosten Monitoring gesamt [€]</td>
         <td id="B166">
             <?php
             //##
             $B166 = 157500;
             echo $B166;
             ?>
         </td>
         <td id="E166">
             <?php
             //##
             $E166 = 300000;
             echo $E166;
             ?>
         </td>
         <td id="G166">
             <?php
             //##
             $G166 = 375000;
             echo $G166;
             ?>
         </td>
         <td id="H166">
             <?php
             //##
             $H166 = 300000;
             echo $H166;
             ?>
         </td>
    </tr>
    <tr>
        <td>Anzahl Trockenreinigung Gussasphaltim Betrachtungszeitraum [Stück]</td>
        <td id="B167">
            <?php
            //##
            $B167 = 50;
            echo $B167;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Kosten Trockenreinigung Gussasphalt [€]</td>
        <td id="B168">
            <?php
            //##
            $B168 = 300000;
            echo $B168;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Anzahl Nassreinigung Gussasphalt im Betrachtungszeitraum [Stück]</td>
        <td id="B169">
            <?php
            //##
            $B169 = 0;
            echo $B169;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Kosten Nassreinigung Gussasphalt [€]</td>
        <td id="B170">
            <?php
            //##
            $B170 = 0;
            echo $B170;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
         <td>Anzahl Trockenreinigung OS-Beschichtungim Betrachtungszeitraum [Stück]</td>
         <td id="B171">
             <?php
             //##
             $B171 = 50;
             echo $B171;
             ?>
         </td>
         <td id="E171">
             <?php
             //##
             $E171 = 50;
             echo $E171;
             ?>
         </td>
         <td id="G171">
             <?php
             //##
             $G171 = 50;
             echo $G171;
             ?>
         </td>
         <td id="H171">
             <?php
             //##
             $H171 = 50;
             echo $H171;
             ?>
         </td>
    </tr>
    <tr>
         <td>Kosten Trockenreinigung OS Beschichtung [€]</td>
         <td id="B172">
             <?php
             //##
             $B172 = 100000;
             echo $B172;
             ?>
         </td>
         <td id="E172">
             <?php
             //##
             $E172 = 400000;
             echo $E172;
             ?>
         </td>
         <td id="G172">
             <?php
             //##
             $G172 = 100000;
             echo $G172;
             ?>
         </td>
         <td id="H172">
             <?php
             //##
             $H172 = 100000;
             echo $H172;
             ?>
         </td>
    </tr>
    <tr>
         <td>Anzahl Nassreinigung OS Beschichtungim Betrachtungszeitraum [Stück]</td>
         <td id="B173">
             <?php
             //##
             $B173 = 100;
             echo $B173;
             ?>
         </td>
         <td id="E173">
             <?php
             //##
             $E173 = 100;
             echo $E173;
             ?>
         </td>
         <td id="G173">
             <?php
             //##
             $G173 = 100;
             echo $G173;
             ?>
         </td>
         <td id="H173">
             <?php
             //##
             $H173 = 100;
             echo $H173;
             ?>
         </td>
    </tr>
    <tr>
         <td>Kosten Nassreinigung OS Beschichtung [€]</td>
         <td id="B174">
             <?php
             //##
             $B174 = 400000;
             echo $B174;
             ?>
         </td>
         <td id="E174">
             <?php
             //##
             $E174 = 1600000;
             echo $E174;
             ?>
         </td>
         <td id="G174">
             <?php
             //##
             $G174 = 400000;
             echo $G174;
             ?>
         </td>
         <td id="H174">
             <?php
             //##
             $H174 = 400000;
             echo $H174;
             ?>
         </td>
    </tr>
    <tr>
        <td>Anzahl Trockenreinigung Ortbetondeckenim Betrachtungszeitraum [Stück]</td>
        <td class="schraffiert" colspan=2></td>
        <td id="G175">
            <?php
            //##
            $G175 = 50;
            echo $G175;
            ?>
        </td>
        <td class="schraffiert"></td>
    </tr>
    <tr>
        <td>Kosten Trockenreinigung Ortbetondecken [€]</td>
        <td class="schraffiert" colspan=2></td>
        <td id="G176">
            <?php
            //##
            $G176 = 300000;
            echo $G176;
            ?>
        </td>
        <td class="schraffiert"></td>
    </tr>
    <tr>
        <td>Anzahl Nassreinigung Ortbetondeckenim Betrachtungszeitraum [Stück]</td>
        <td class="schraffiert" colspan=2></td>
        <td id="G177">
            <?php
            //##
            $G177 = 100;
            echo $G177;
            ?>
        </td>
        <td class="schraffiert"></td>
    </tr>
    <tr>
        <td>Kosten Nassreinigung Ortbetondecken [€]</td>
        <td class="schraffiert" colspan=2></td>
        <td id="G178">
            <?php
            //##
            $G178 = 1200000;
            echo $G178;
            ?>
        </td>
        <td class="schraffiert"></td>
    </tr>
    <tr>
        <td>Anzahl Trockenreinigung Fertigteildeckenim Betrachtungszeitraum [Stück]</td>
        <td class="schraffiert" colspan=3></td>
        <td id="H179">
            <?php
            //##
            $H179 = 50;
            echo $H179;
            ?>
        </td>
    </tr>
    <tr>
        <td>Kosten Trockenreinigung Fertigteildecken [€]</td>
        <td class="schraffiert" colspan=3></td>
        <td id="H180">
            <?php
            //##
            $H180 = 300000;
            echo $H180;
            ?>
        </td>
    </tr>
    <tr>
        <td>Anzahl Nassreinigung Fertigteildeckenim Betrachtungszeitraum [Stück]</td>
        <td class="schraffiert" colspan=3></td>
        <td id="H181">
            <?php
            //##
            $H181 = 100;
            echo $H181;
            ?>
        </td>
    </tr>
    <tr>
        <td>Kosten Nassreinigung Fertigteildecken [€]</td>
        <td class="schraffiert" colspan=3></td>
        <td id="H182">
            <?php
            //##
            $H182 = 1200000;
            echo $H182;
            ?>
        </td>
    </tr>
    <tr>
         <td>Reinigungskosten gesamt [€]</td>
         <td id="B183">
             <?php
             //##
             $B183 = 800000;
             echo $B183;
             ?>
         </td>
         <td id="E183">
             <?php
             //##
             $E183 = 2000000;
             echo $E183;
             ?>
         </td>
         <td id="G183">
             <?php
             //##
             $G183 = 2000000;
             echo $G183;
             ?>
         </td>
         <td id="H183">
             <?php
             //##
             $H183 = 2000000;
             echo $H183;
             ?>
         </td>
    </tr>
    <tr>
         <td>Instandsetzungskosten [€]</td>
         <td id="B184">
             <?php
             //##
             $B184 = 2762318.88;
             echo $B184;
             ?>
         </td>
         <td id="E184">
             <?php
             //##
             $E184 = 3799858.18;
             echo $E184;
             ?>
         </td>
         <td id="G184">
             <?php
             //##
             $G184 = 2520000;
             echo $G184;
             ?>
         </td>
         <td id="H184">
             <?php
             //##
             $H184 = 2320000;
             echo $H184;
             ?>
         </td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung für 100% der Fläche ohne Abdichtung im Betrachtungszeitraum [Stück]</td>
        <td id="B185">
            <?php
            //##
            $B185 = 0;
            echo $B185;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Kosten der Belagserneuerung für 100% der Fläche ohne Abdichtung [€]</td>
        <td id="B186">
            <?php
            //##
            $B186 = 0;
            echo $B186;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung für 50% der Fläche ohne Abdichtung im Betrachtungszeitraum [Stück]</td>
        <td id="B187">
            <?php
            //##
            $B187 = 0;
            echo $B187;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Kosten der Belagserneuerung für 50% der Fläche ohne Abdichtung [€]</td>
        <td id="B188">
            <?php
            //##
            $B188 = 0;
            echo $B188;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung für 30% der Fläche ohne Abdichtung im Betrachtungszeitraum [Stück]</td>
        <td id="B189">
            <?php
            //##
            $B189 = 1;
            echo $B189;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Kosten der Belagserneuerung für 30% der Fläche ohne Abdichtung [€]</td>
        <td id="B190">
            <?php
            //##
            $B190 = 202500;
            echo $B190;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung für 30% der Fläche mit Abdichtung im Betrachtungszeitraum [Stück]</td>
        <td id="B191">
            <?php
            //##
            $B191 = 3;
            echo $B191;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Kosten der Belagserneuerung für 30% der Fläche mit Abdichtung [€]</td>
        <td id="B192">
            <?php
            //##
            $B192 = 1839818.88;
            echo $B192;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung für 100% der Freifläche mit Abdichtung<span style='mso-spacerun:yes'>  </span>im Betrachtungszeitraum [Stück]</td>
        <td id="B193">
            <?php
            //##
            $B193 = 0;
            echo $B193;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Kosten der Belagserneuerung für 100% der Freifläche mit Abdichtung [€]</td>
        <td id="B194">
            <?php
            //##
            $B194 = 0;
            echo $B194;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Kosten Instandsetzung Asphalt gesamt [€]</td>
        <td id="B195">
            <?php
            //##
            $B195 = 2042318.88;
            echo $B195;
            ?>
        </td>
        <td class="schraffiert" colspan=3></td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung OS Beschichtungfür 100% der Fläche im Betrachtungszeitraum [Stück]</td>
        <td id="B196">
            <?php
            //##
            $B196 = 2;
            echo $B196;
            ?>
        </td>
        <td id="E196">
            <?php
            //##
            $E196 = 2;
            echo $E196;
            ?>
        </td>
        <td id="G196">
            <?php
            //##
            $G196 = 2;
            echo $G196;
            ?>
        </td>
        <td id="H196">
            <?php
            //##
            $H196 = 2;
            echo $H196;
            ?>
        </td>
    </tr>
    <tr>
         <td>Kosten der Belagserneuerung OS für 100% der Fläche [€]</td>
         <td id="B197">
             <?php
             //##
             $B197 = 720000;
             echo $B197;
             ?>
         </td>
         <td id="E197">
             <?php
             //##
             $E197 = 2111032.32;
             echo $E197;
             ?>
         </td>
         <td id="G197">
             <?php
             //##
             $G197 = 720000;
             echo $G197;
             ?>
         </td>
         <td id="H197">
             <?php
             //##
             $H197 = 720000;
             echo $H197;
             ?>
         </td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung OS Beschichtungfür 50% der Fläche im Betrachtungszeitraum [Stück]</td>
        <td class="schraffiert"></td>
        <td id="E198">
            <?php
            //##
            $E198 = 2;
            echo $E198;
            ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Kosten der Belagserneuerung OSfür 50% der Fläche [€]</td>
        <td class="schraffiert"></td>
        <td id="E199">
            <?php
            //##
            $E199 = 1055516.16;
            echo $E199;
            ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung OS Beschichtungfür 30% der Fläche im Betrachtungszeitraum [Stück]
        </td>
        <td class="schraffiert"></td>
        <td id="E200">
            <?php
            //##
            $E200 = 5;
            echo $E200;
            ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Kosten der Belagserneuerung OSfür 30% der Fläche [€]</td>
        <td class="schraffiert"></td>
        <td id="E201">
            <?php
            //##
            $E201 = 633309.70;
            echo $E201;
            ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Anzahl der Belagserneuerung OS Beschichtungfür 100% der Freifläche im Betrachtungszeitraum [Stück]
        </td>
        <td class="schraffiert"></td>
        <td id="E202">
            <?php
            //##
            $E202 = 2;
            echo $E202;
            ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
        <td>Kosten der Belagserneuerung OSfür 100% der Freifläche [€]</td>
        <td class="schraffiert"></td>
        <td id="E203">
            <?php
            //##
            $E203 = 0;
            echo $E203;
            ?>
        </td>
        <td class="schraffiert" colspan=2></td>
    </tr>
    <tr>
         <td>Kosten Instandsetzung OS gesamt [€]</td>
         <td id="B204">
             <?php
             //##
             $B204 = 720000;
             echo $B204;
             ?>
         </td>
         <td id="E204">
             <?php
             //##
             $E204 = 3799858.18;
             echo $E204;
             ?>
         </td>
         <td id="G204">
             <?php
             //##
             $G204 = 720000;
             echo $G204;
             ?>
         </td>
         <td id="H204">
             <?php
             //##
             $H204 = 720000;
             echo $H204;
             ?>
         </td>
    </tr>
    <tr>
        <td>Anzahl Erneuerung Fugensystem zu 100% im Betrachtungszeitraum [Stück]</td>
        <td class="schraffiert" colspan=3></td>
        <td id="H205">
            <?php
            //##
            $H205 = 2;
            echo $H205;
            ?>
        </td>
    </tr>
    <tr>
        <td>Kosten Erneuerung Fugensystem [€]</td>
        <td class="schraffiert" colspan=3></td>
        <td id="H206">
            <?php
            //##
            $H206 = 1000000;
            echo $H206;
            ?>
        </td>
    </tr>
    <tr>
        <td>Ausbesserung von Rissen mit Bandagen bei oberflächenfertigen Ortbetondecken [€]</td>
        <td class="schraffiert" colspan=2></td>
        <td id="G207">
            <?php
            //##
            $G207 = 1800000;
            echo $G207;
            ?>
        </td>
        <td class="schraffiert"></td>
    </tr>
    <tr>
        <td>Ausbesserung von Rissen mit Bandagen bei oberflächenfertigen Fertigteildecken [€]</td>
        <td class="schraffiert" colspan=3></td>
        <td id="H208">
            <?php
            //##
            $H208 = 600000;
            echo $H208;
            ?>
        </td>
    </tr>
    <tr>
         <td>Instandhaltungskosten gesamt [€]</td>
         <td id="B209">
             <?php
             //##
             $B209 = 2762318.88;
             echo $B209;
             ?>
         </td>
         <td id="E209">
             <?php
             //##
             $E209 = 3799858.18;
             echo $E209;
             ?>
         </td>
         <td id="G209">
             <?php
             //##
             $G209 = 2520000;
             echo $G209;
             ?>
         </td>
         <td id="H209">
             <?php
             //##
             $H209 = 2320000;
             echo $H209;
             ?>
         </td>
    </tr>
    <tr>
         <td>Kosten Mietausfall [€]</td>
         <td id="B210">
             <?php
             //##
             $B210 = 1830000;
             echo $B210;
             ?>
         </td>
         <td id="E210">
             <?php
             //##
             $E210 = 6750000;
             echo $E210;
             ?>
         </td>
         <td id="G210">
             <?php
             //##
             $G210 = 13500000;
             echo $G210;
             ?>
         </td>
         <td id="H210">
             <?php
             //##
             $H210 = 9500000;
             echo $H210;
             ?>
         </td>
    </tr>
</table>
