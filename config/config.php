<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2017 Heimrich & Hannot GmbH
 *
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

/**
 * HOOKS
 */
if (is_array($GLOBALS['TL_HOOKS']['replaceDynamicScriptTags']))
{
    array_insert($GLOBALS['TL_HOOKS']['replaceDynamicScriptTags'], 0, array(array('HeimrichHannot\Components\Hooks', 'replaceDynamicScriptTagsHook')));
}
else
{
    $GLOBALS['TL_HOOKS']['replaceDynamicScriptTags'][] = array('HeimrichHannot\Components\Hooks', 'replaceDynamicScriptTagsHook');
}
