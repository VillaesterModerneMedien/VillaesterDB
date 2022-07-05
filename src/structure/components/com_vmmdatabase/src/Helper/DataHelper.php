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



class DataHelper
{

    public function returnFrontendFields()
    {
        $frontendFields = [
            /*
            'F3'   =>  [
                'label'     =>  'Schieberegler',
                'type'      =>  'text',
                'default'   =>  50
            ],*/
            'B25'   =>  [
                'label'     =>  'Bauweise – Splitlevel/Vollgeschoss',
                'type'      =>  'text',
                'default'   =>  'Split',
                'unit'      =>  'Split / Voll'
            ],
            'B27'   =>  [
                'label'     =>  'Anzahl Stellplätze',
                'type'      =>  'text',
                'default'   => 1000,
                'unit'      =>  'Stellplätze'
          ],
            'B29'   =>  [
                'label'     =>  'Grundfläche aller Ebenen inkl. Rampen',
                'type'      =>  'text',
                'default'   =>  25000,
                'unit'      =>  'm²'
            ],
            //orangenes Feld
            //TODO: Funktion einbauen Conditional
            'B31'   =>  [
                'label'     =>  'Verhältnis m² / Stellplatz',
                'type'      =>  'text',
                'default'   =>  25,
                'readonly'  =>  'readonly',
                'unit'      =>  'm² / Stellplatz'
            ],
            'B33'   =>  [
                'label'     =>  'Anzahl der Ebenen',
                'type'      =>  'text',
                'default'   =>  5,
                'unit'      =>  'Ebenen'
            ],
            'B35'   =>  [
                'label'     =>  'oberste Ebenen überdacht?',
                'type'      =>  'text',
                'default'   =>  'ja',
                'unit'      =>  'ja / nein'
            ],
            //orangenes Feld
            //TODO: Funktion einbauen Conditional
            'B37'   =>  [
                'label'     =>  'unterste Ebene gepflastert?',
                'type'      =>  'text',
                'default'   =>  'nein',
                'readonly'  =>  'readonly',
                'unit'      =>  'ja / nein'
            ],
            'B39'   =>  [
                'label'     =>  'Feuerwiderstandsklasse des Tragwerks',
                'type'      =>  'text',
                'default'   =>  'F0',
                'unit'      =>  'F0 / F30 / F90'
            ],
            'B88'   =>  [
                'label'     =>  'Mietausfall pro Stellplatz infolge Wartung und Instandhaltung',
                'type'      =>  'text',
                'default'   =>  100,
                'unit'      =>  '€ / Monat'
            ],
            'F31'   =>  [
                'label'     =>  'OS 8',
                'type'      =>  'text',
                'default'   =>  41,
                'unit'      =>  '€ / m²'
            ],
            'F33'   =>  [
                'label'     =>  'OS 11',
                'type'      =>  'text',
                'default'   =>  62,
                'unit'      =>  '€ / m²'
            ],
            'F49'   =>  [
                'label'     =>  'Kosten Monitoring',
                'type'      =>  'text',
                'default'   =>  0.3,
                'unit'      =>  '€ / m²'
            ],
            'F51'   =>  [
                'label'     =>  'Anzahl Trockenreinigung',
                'type'      =>  'text',
                'default'   =>  1,
                'unit'      =>  'pro Jahr'
            ],
            'F53'   =>  [
                'label'     =>  'Kosten Trockenreinigung',
                'type'      =>  'text',
                'default'   =>  0.4,
                'unit'      =>  '€ / m²'
            ],
            'F55'   =>  [
                'label'     =>  'Anzahl Nassreinigung',
                'type'      =>  'text',
                'default'   =>  2,
                'unit'      =>  'pro Jahr'
            ],
            'F57'   =>  [
                'label'     =>  'Kosten Nassreinigung',
                'type'      =>  'text',
                'default'   =>  0.8,
                'unit'      =>  '€ / m²'
            ],
            'F62'   =>  [
                'label'     =>  'Anzahl der Belagserneuerung für 100% der Fläche',
                'type'      =>  'text',
                'default'   =>  2,
                'unit'      =>  'mal'
            ],
            'F64'   =>  [
                'label'     =>  'Anzahl der Belagserneuerung für 50% der Fläche',
                'type'      =>  'text',
                'default'   =>  2,
                'unit'      =>  'mal'
            ],
            'F66'   =>  [
                'label'     =>  'Anzahl der Belagserneuerung für 30% der Fläche',
                'type'      =>  'text',
                'default'   =>  5,
                'unit'      =>  'mal'
            ],
            'F70'   =>  [
                'label'     =>  'Anzahl der Belagserneuerung für 100% der Freifläche',
                'type'      =>  'text',
                'default'   =>  2,
                'unit'      =>  'mal'
            ],
            'F72'   =>  [
                'label'     =>  'Entfernen und Entsorgen des Altbelages bei OS 8',
                'type'      =>  'text',
                'default'   =>  5,
                'unit'      =>  '€ / m²'
            ],
            'F74'   =>  [
                'label'     =>  'Entfernen und Entsorgen des Altbelages bei OS 11',
                'type'      =>  'text',
                'default'   =>  10,
                'unit'      =>  '€ / m²'
            ],
            //orangenes Feld
            //TODO: Funktion einbauen Conditional
            'F80'   =>  [
                'label'     =>  'Belagserneuerung mit OS 8',
                'type'      =>  'text',
                'default'   =>  41,
                'readonly'  =>  'readonly',
                'unit'      =>  '€ / m²'
            ],
            //orangenes Feld
            //TODO: Funktion einbauen Conditional
            'F82'   =>  [
                'label'     =>  'Belagserneuerung mit OS 11',
                'type'      =>  'text',
                'default'   =>  62,
                'readonly'  =>  'readonly',
                'unit'      =>  '€ / m²'
            ],
            //orangenes Feld
            //TODO: Funktion einbauen Conditional
            'F88'   =>  [
                'label'     =>  'Mietausfall pro Stellplatz infolge Instandhaltung',
                'type'      =>  'text',
                'default'   =>  100,
                'readonly'  =>  'readonly',
                'unit'      =>  '€ / Monat'
            ]
        ];

        return $frontendFields;
    }
    public function returnBackendFields()
    {
        $backendFields = [
            'F27'   =>  [
                'label'     =>  'Gussasphalt einlagig',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'F29'   =>  [
                'label'     =>  'Gussasphalt zweilagig',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'B45'   =>  [
                'label'     =>  'Anzahl Monitoring in den ersten 5 Jahren',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  'pro Jahr'
            ],
            'B47'   =>  [
                'label'     =>  'Anzahl Monitoring nach den ersten 5 Jahren',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  'pro Jahr'
            ],
            'B49'   =>  [
                'label'     =>  'Kosten Monitoring',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'B51'   =>  [
                'label'     =>  'Anzahl Trockenreinigung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  'pro Jahr'
            ],
            'B53'   =>  [
                'label'     =>  'Kosten Trockenreinigung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'B55'   =>  [
                'label'     =>  'Anzahl Nassreinigung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  'pro Jahr'
            ],
            'B57'   =>  [
                'label'     =>  'Kosten Nassreinigung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'B62'   =>  [
                'label'     =>  'Anzahl der Belagserneuerung für 100% der Fläche ohne Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  'mal'
            ],
            'B64'   =>  [
                'label'     =>  'Anzahl der Belagserneuerung für 50% der Fläche ohne Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  'mal'
            ],
            'B66'   =>  [
                'label'     =>  'Anzahl der Belagserneuerung für 30% der Fläche ohne Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  'mal'
            ],
            'B68'   =>  [
                'label'     =>  'Anzahl der Belagserneuerung für 30% der Fläche mit Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  'mal'
            ],
            'B70'   =>  [
                'label'     =>  'Anzahl der Belagserneuerung für 100% der Freifläche mit Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  'mal'
            ],
            'B72'   =>  [
                'label'     =>  'Entfernen und Entsorgen des Altbelages für einlagigen Gussasphalt ohne Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'B74'   =>  [
                'label'     =>  'Entfernen und Entsorgen des Altbelages für zweilagigen Gussasphalt ohne Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'B76'   =>  [
                'label'     =>  'Entfernen und Entsorgen des Altbelages für einlagigen Gussasphalt mit Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'B78'   =>  [
                'label'     =>  'Entfernen und Entsorgen des Altbelages für zweilagigen Gussasphalt mit Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'B80'   =>  [
                'label'     =>  'Belagserneuerung einlagig ohne Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'B82'   =>  [
                'label'     =>  'Belagserneuerung zweilagig ohne Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'B84'   =>  [
                'label'     =>  'Belagserneuerung einlagig mit Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'B86'   =>  [
                'label'     =>  'Belagserneuerung zweilagig mit Abdichtung',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  '€ / m²'
            ],
            'F45'   =>  [
                'label'     =>  'Anzahl Monitoring in den ersten 5 Jahren',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  'pro Jahr'
            ],
            'F47'   =>  [
                'label'     =>  'Anzahl Monitoring in den ersten 5 Jahren',
                'type'      =>  'text',
                'readonly'  =>  'readonly',
                'backend'   =>  'backend',
                'unit'      =>  'pro Jahr'
            ],

        ];

        return $backendFields;
    }

}
