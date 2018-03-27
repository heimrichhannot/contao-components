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
     * remove assets from js group
     *
     * @param       $strGroup
     * @param array $arrNew
     * @param array $arrCurrent
     *
     * @return array
     */
    public static function removeAssets($arrRem = [], $arrCurrent = [])
    {
        if (!is_array($arrRem)) {
            return $arrCurrent;
        }

        foreach ($arrRem as $value) {
            $options = explode('|', $value);
            foreach ($arrCurrent as $key => $current) {
                $parts = explode('|', $current);
                if (ltrim($parts[0], '/') == ltrim($options[0], '/')) {
                    unset($arrCurrent[$key]);
                    continue 2;
                }
            }
        }

        return $arrCurrent;
    }

    /**
     * remove all disabled components
     *
     * @param \LayoutModel $objLayout
     *
     * @return bool
     */
    public static function disable(\LayoutModel $objLayout)
    {
        $disabled = static::getDisabledComponents($objLayout);

        if (!is_array($disabled)) {
            return false;
        }

        $arrJs      = is_array($GLOBALS['TL_JAVASCRIPT']) ? $GLOBALS['TL_JAVASCRIPT'] : [];
        $arrUserCss = is_array($GLOBALS['TL_USER_CSS']) ? $GLOBALS['TL_USER_CSS'] : [];
        $arrCss     = is_array($GLOBALS['TL_CSS']) ? $GLOBALS['TL_CSS'] : [];

        foreach ($disabled as $key => $arrComponent) {
            $arrJs      = static::removeAssets($arrComponent['js'], $arrJs);
            $arrUserCss = static::removeAssets($arrComponent['css'], $arrUserCss);
            $arrCss     = static::removeAssets($arrComponent['css'], $arrCss);
        }

        $GLOBALS['TL_JAVASCRIPT'] = $arrJs;
        $GLOBALS['TL_USER_CSS']   = $arrUserCss;
        $GLOBALS['TL_CSS']        = $arrCss;
    }

    /**
     * Get disabled components for a given frontend layout
     *
     * @param \LayoutModel $objLayout |null If null, the current Layout is used
     *
     * @return array
     */
    public static function getDisabledComponents(\LayoutModel $objLayout = null)
    {
        global $objPage;

        if ($objLayout === null && ($objLayout = \LayoutModel::findByPk($objPage->layout)) === null) {
            return [];
        }

        $disabled = [];
        $all      = static::getComponents();

        if ($objLayout->disableComponents) {
            $disabled = deserialize($objLayout->inactiveComponents, true);
            $disabled = array_intersect_key($all, array_flip($disabled));
        }

        return $disabled;
    }

    public static function isActive($strComponent)
    {
        return in_array($strComponent, array_keys(static::getActiveComponents()));
    }


    /**
     * Get components as array
     *
     * @param $blnGroup
     *
     * @return array All assets
     */
    public static function getComponents($blnGroup = false)
    {
        $arrOptions = [];

        $arrComponents = $GLOBALS['TL_COMPONENTS'];

        if (!is_array($arrComponents)) {
            return $arrOptions;
        }

        foreach ($arrComponents as $groupKey => $arrGroup) {
            $varValue = $arrGroup;

            if ($blnGroup) {
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

    /**
     * Get active components for a given frontend layout
     *
     * @param \LayoutModel $objLayout |null If null, the current Layout is used
     *
     * @return array
     */
    public static function getActiveComponents(\LayoutModel $objLayout = null)
    {
        global $objPage;
        if ($objLayout === null && ($objLayout = \LayoutModel::findByPk($objPage->layout)) === null) {
            return [];
        }
        $arrAvailable = static::getComponents();
        if ($objLayout->disableComponents) {
            $arrInactive  = deserialize($objLayout->inactiveComponents, true);
            $arrAvailable = array_diff_key($arrAvailable, array_flip($arrInactive));
        }

        return $arrAvailable;
    }
}