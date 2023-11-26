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

if (!isset($options['min'])) {
	$options['min']=true;
}

$version=Settings::getStringVar('vendor_lib_jquery_'.$plugin_name.'_version');
$dir=strtolower('jquery'.DIRECTORY_SEPARATOR.$plugin_name);

$name=$plugin_name.DIRECTORY_SEPARATOR.$version.'.resource';
if (Resource::existsResource('jquery', $name)!==true) {
	$files=['js'.DIRECTORY_SEPARATOR.'jquery.easing.compatibility.js', 'js'.DIRECTORY_SEPARATOR.'jquery.easing.js', 'js'.DIRECTORY_SEPARATOR.'jquery.easing.min.js',];
	Resource::copyResourcePath('oswcore'.DIRECTORY_SEPARATOR.'oswvendor'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'jquery'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.$plugin_name.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR, $dir.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR, $files);
	Resource::writeResource('jquery', $name, time());
}

$path=Resource::getRelDir().$dir.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR;

if ($options['min']===true) {
	$jsfiles=[$path.'js'.DIRECTORY_SEPARATOR.'jquery.easing.min.js'];
} else {
	$jsfiles=[$path.'js'.DIRECTORY_SEPARATOR.'jquery.easing.js'];
}

$this->addTemplateJSFiles('head', $jsfiles);

?>
