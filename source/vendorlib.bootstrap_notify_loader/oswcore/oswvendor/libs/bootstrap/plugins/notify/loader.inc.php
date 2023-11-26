<?php

/**
 * This file is part of the osWFrame package
 *
 * @author Juergen Schwind
 * @copyright Copyright (c) JBS New Media GmbH - Juergen Schwind (https://jbs-newmedia.com)
 * @package osWFrame
 * @link https://oswframe.com
 * @license MIT License
 */

namespace osWFrame\Core;

$version=Settings::getStringVar('vendor_lib_bootstrap_'.$plugin_name.'_version');

if (!isset($options['min'])) {
	$options['min']=true;
}

$dir=strtolower('bootstrap'.DIRECTORY_SEPARATOR.$plugin_name);
$name=$plugin_name.DIRECTORY_SEPARATOR.$version.'.resource';
if (Resource::existsResource('bootstrap', $name)!==true) {
	$files=['js'.DIRECTORY_SEPARATOR.'bootstrap-notify.js', 'js'.DIRECTORY_SEPARATOR.'bootstrap-notify.min.js'];
	Resource::copyResourcePath('oswvendor'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.$plugin_name.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR, $dir.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR, $files);
	Resource::writeResource('bootstrap', $name, time());
}

$path=Resource::getRelDir().$dir.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR;

if ($options['min']===true) {
	$jsfiles=[$path.'js'.DIRECTORY_SEPARATOR.'bootstrap-notify.min.js'];
} else {
	$jsfiles=[$path.'js'.DIRECTORY_SEPARATOR.'bootstrap-notify.js'];
}

$this->addTemplateJSFiles('head', $jsfiles);

?>