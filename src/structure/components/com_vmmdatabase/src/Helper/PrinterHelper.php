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
class PrinterHelper
{

    public function printTest($vehicle)
    {
        require_once __DIR__ . '/vendor/autoload.php';
        JLoader::register('SercosysMiaHelperMailerHelper', JPATH_SITE . '/components/com_sercosysmia/helpers/mailerHelper.php');
        $printer = new SercosysMiaHelperMailerHelper();

        $name = 'testname';

        //var_dump($vehicle->images);die;
        $html  = 'hier html';


        $stylesheet = file_get_contents(JPATH_SITE . '/media/com_sercosysmia/css/detailPrint.css');
        $filename = JPATH_BASE . '/images/' . $name . strtotime(date_create()->format('Y-m-d H:i:s')) . '.pdf';

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

        $mpdf->Output($filename, \Mpdf\Output\Destination::FILE );


        $printer->sendMailFromPDF($filename, $vehicle);
    }
}
