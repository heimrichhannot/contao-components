# Components

Components is a contao extension that gives better control over javascript and css invocation within page layouts.
If you register your javascript and css files as component, it is possible to disable the component for each layout.

## Technical instruction 

To register custom js/css components, register them within '$GLOBALS['TL_COMPONENTS']'.

The following example is taken from [heimrichhannot/contao-bootstrapper](https://packagist.org/packages/heimrichhannot/contao-bootstrapper).

```
$GLOBALS['TL_COMPONENTS'] = array
(
		'bs.inputSlider' => array
     	(
     		'js'  => array
     		(
     			'files' => array
     			(
     				'system/modules/bootstrapper/assets/vendor/seiyria-bootstrap-slider/dist/bootstrap-slider' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
     				BOOTSTRAPPER_JS_COMPONENT_DIR . '/input-slider/bs.inputSlider' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
     			),
     		),
     		'css' => array
     		(
     			'files' => array
     			(
     				'system/modules/bootstrapper/assets/vendor/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css|screen|static',
     			)
     		),
     	),
     	'bs.tooltip' => array
     	(
     		'js'  => array
     		(
     			'files' => array
     			(
     				BOOTSTRAPPER_JS_COMPONENT_DIR . '/tooltip/bs.tooltip' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
     			),
     		)
     	),
     	'modernizr'         => array
     	(
     		'js' => array
     		(
     			'files' => array
     			(
     				'system/modules/bootstrapper/assets/vendor/modernizr.min.js|static',
     			),
     			'sort'  => 0, // invoke always before all other javascript
     		),
     	),
);
```