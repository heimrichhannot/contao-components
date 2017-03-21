<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2017 Heimrich & Hannot GmbH
 *
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Components;


class Hooks extends \Controller
{
    /**
     * Invoke component assets within replaceDynamicScriptTags TL_HOOK
     *
     * @param $strBuffer
     *
     * @return mixed
     */
    public function replaceDynamicScriptTagsHook($strBuffer)
    {
        global $objPage;

        if (!$objPage)
        {
            return $strBuffer;
        }

        $objLayout = \LayoutModel::findByPk($objPage->layout);

        if (!$objLayout)
        {
            return $strBuffer;
        }

        \HeimrichHannot\Components\Components::registerComponents($objLayout);

        return $strBuffer;
    }
}