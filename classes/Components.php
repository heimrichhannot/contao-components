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


class Components extends \Frontend
{
    /**
     * Add assets from a component group
     *
     * @param       $strGroup
     * @param array $arrNew
     * @param array $arrCurrent
     *
     * @return array
     */
    public static function addAssets($strGroup, $arrNew = array(), $arrCurrent = array())
    {
        if (!isset($arrNew['files']))
        {
            return $arrCurrent;
        }

        $arrFiles = $arrNew['files'];
        $intIndex = $arrNew['sort'];

        if (!is_array($arrFiles))
        {
            $arrFiles = array($arrFiles);
        }

        if (!is_array($arrCurrent))
        {
            $arrCurrent = array($arrCurrent);
        }

        $arrReplace = array();

        foreach ($arrFiles as $key => $strFile)
        {
            // do not add the same file multiple times
            if (in_array($strFile, $arrCurrent))
            {
                continue;
            }

            $arrReplace[$strGroup . '.' . $key] = $strFile;
        }

        if ($intIndex !== null)
        {
            array_insert($arrCurrent, $intIndex, $arrReplace);

            return $arrCurrent;
        }

        return $arrCurrent + $arrReplace;
    }

    /**
     * Register all active components
     *
     * @param \LayoutModel $objLayout
     *
     * @return bool
     */
    public static function registerComponents(\LayoutModel $objLayout)
    {
        $arrComponents = static::getActiveComponents($objLayout);

        if (!is_array($arrComponents))
        {
            return false;
        }

        $arrJs  = is_array($GLOBALS['TL_JAVASCRIPT']) ? $GLOBALS['TL_JAVASCRIPT'] : array();
        $arrCss = is_array($GLOBALS['TL_USER_CSS']) ? $GLOBALS['TL_USER_CSS'] : array();

        foreach ($arrComponents as $group => $arrComponent)
        {
            $arrJs  = static::addAssets($group, $arrComponent['js'], $arrJs);
            $arrCss = static::addAssets($group, $arrComponent['css'], $arrCss);
        }

        $GLOBALS['TL_JAVASCRIPT'] = $arrJs;
        $GLOBALS['TL_USER_CSS']   = $arrCss;
    }

    /**
     * Get active components for a given frontend layout
     *
     * @param \LayoutModel $objLayout
     *
     * @return array
     */
    public static function getActiveComponents(\LayoutModel $objLayout)
    {
        $arrAvailable = static::getComponents();

        if ($objLayout->disableComponents)
        {
            $arrInactive = deserialize($objLayout->inactiveComponents, true);

            $arrAvailable = array_diff_key($arrAvailable, array_flip($arrInactive));
        }

        return $arrAvailable;
    }


    /**
     * Get components as array
     * @param $blnGroup
     *
     * @return array All available assets
     */
    public static function getComponents($blnGroup = false)
    {
        $arrOptions = array();

        $arrComponents = $GLOBALS['TL_COMPONENTS'];

        if (!is_array($arrComponents))
        {
            return $arrOptions;
        }

        foreach ($arrComponents as $groupKey => $arrGroup)
        {
            $varValue = $arrGroup;

            if ($blnGroup)
            {
                $varValue = $groupKey;
            }

            $arrOptions[$groupKey] = $varValue;
        }

        return $arrOptions;
    }

    /**
     * Get component group names as array
     *
     * @return array of assets
     */
    public static function getComponentGroups()
    {
        return static::getComponents(true);
    }
}