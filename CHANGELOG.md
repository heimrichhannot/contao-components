# Changelog

All notable changes to this project will be documented in this file.

## [2.2.0] - 2021-08-31

- Added: support for php 8

## [2.1.0] - 2018-11-28

### Changed
- load after `heimrichhannot/contao-modal` in order to remove assets added by `replaceDynamicScriptTags` HOOK

## [2.0.2] - 2018-03-27

### Fixed
- properly match paths when removing assets 

## [2.0.1] - 2018-03-27

### Fixed
- disable css that is invoked in `$GLOBALS['TL_CSS']`
- properly match paths when removing assets 

## [2.0.0] - 2017-11-06

### Changed

- load all js/css components and then disable them in BE

## [1.1.0] - 2017-09-12

### Changed

- added `before` and `after` to define files invocation (`sort` should not be used any longer)

## [1.0.4] - 2017-08-15

### Changed

- unset asset if already added to $GLOBALS before, and add again within component context 

## [1.0.3] - 2017-06-12

### Added

- Components::getActive()

## [1.0.2] - 2017-04-05

### Changed

- added php7 support, fixed contao-core dependency

## [1.0.1] - 2017-04-05

### Changed

- added php7 support, fixed contao-core dependency

## [1.0.0] - 2017-03-21

- initial version
