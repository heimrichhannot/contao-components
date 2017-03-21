<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'HeimrichHannot',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'HeimrichHannot\Components\Hooks'          => 'system/modules/components/classes/Hooks.php',
	'HeimrichHannot\Components\Backend\Layout' => 'system/modules/components/classes/Backend/Layout.php',
	'HeimrichHannot\Components\Components'     => 'system/modules/components/classes/Components.php',
));
