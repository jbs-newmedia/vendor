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

$dir=strtolower($this->getClassName().DIRECTORY_SEPARATOR.$plugin_name);

$name=$plugin_name.DIRECTORY_SEPARATOR.$version.'.resource';
if (Resource::existsResource('jquery', $name)!==true) {
	$files=['js'.DIRECTORY_SEPARATOR.'jquery.fancybox.js', 'js'.DIRECTORY_SEPARATOR.'jquery.fancybox.min.js', 'css'.DIRECTORY_SEPARATOR.'jquery.fancybox.css', 'css'.DIRECTORY_SEPARATOR.'jquery.fancybox.min.css'];
	Resource::copyResourcePath('frame'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'jquery'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.$plugin_name.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR, $dir.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR, $files);
	Resource::writeResource('jquery', $name, time());
}

$path=Resource::getRelDir().$dir.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR;

if ($options['min']===true) {
	$jsfiles=[$path.'js'.DIRECTORY_SEPARATOR.'jquery.fancybox.min.js'];
	$cssfiles=[$path.'css'.DIRECTORY_SEPARATOR.'jquery.fancybox.min.css'];
} else {
	$jsfiles=[$path.'js'.DIRECTORY_SEPARATOR.'jquery.fancybox.js'];
	$cssfiles=[$path.'css'.DIRECTORY_SEPARATOR.'jquery.fancybox.css'];
}

$this->addTemplateJSFiles('head', $jsfiles);
$this->addTemplateCSSFiles('head', $cssfiles);

?>