<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2017 Heimrich & Hannot GmbH
 *
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

$dc = &$GLOBALS['TL_DCA']['tl_layout'];


/**
 * Selectors
 */
$dc['palettes']['__selector__'][] = 'disableComponents';

/**
 * Palettes
 */
$jsPalette                 = '{components_legend},disableComponents;';
$dc['palettes']['default'] = str_replace('addJQuery;', 'addJQuery;' . $jsPalette, $dc['palettes']['default']);

/**
 * Subpalettes
 */
$dc['subpalettes']['disableComponents'] = 'inactiveComponents';

/**
 * Fields
 */
$arrFields = array(
    'disableComponents'  => array(
        'label'     => &$GLOBALS['TL_LANG']['tl_layout']['disableComponents'],
        'exclude'   => true,
        'filter'    => true,
        'inputType' => 'checkbox',
        'eval'      => array('submitOnChange' => true),
        'sql'       => "char(1) NOT NULL default ''",
    ),
    'inactiveComponents' => array(
        'label'            => &$GLOBALS['TL_LANG']['tl_layout']['inactiveComponents'],
        'exclude'          => true,
        'inputType'        => 'checkboxWizard',
        'options_callback' => array('HeimrichHannot\Components\Backend\Layout', 'getComponentsAsOption'),
        'eval'             => array('multiple' => true),
        'sql'              => "blob NULL",
    ),
);

$dc['fields'] = array_merge($dc['fields'], $arrFields);