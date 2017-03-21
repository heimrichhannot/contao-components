<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2017 Heimrich & Hannot GmbH
 *
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Components\Backend;

class Layout extends \Backend
{
    /**
     * Return all components groups as array
     *
     * @param \DataContainer $dc
     *
     * @return array
     */
    public function getComponentsAsOption(\DataContainer $dc)
    {
        return \HeimrichHannot\Components\Components::getComponentGroups();
    }

}