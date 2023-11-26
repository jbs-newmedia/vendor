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

if (!isset($options['language'])) {
	$options['language']=Language::getCurrentLanguage('short');
}

$dir=strtolower('bootstrap'.DIRECTORY_SEPARATOR.$plugin_name);
$name=$plugin_name.DIRECTORY_SEPARATOR.$version.'.resource';
if (Resource::existsResource('bootstrap', $name)!==true) {
	Resource::copyResourcePath('oswcore'.DIRECTORY_SEPARATOR.'oswvendor'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.$plugin_name.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR, $dir.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR);
	Resource::writeResource('bootstrap', $name, time());
}

$path=Resource::getRelDir().$dir.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR;

if ($options['min']===true) {
	$jsfiles=[$path.'js'.DIRECTORY_SEPARATOR.'bootstrap-datepicker.min.js'];
	$cssfiles=[$path.'css'.DIRECTORY_SEPARATOR.'bootstrap-datepicker3.css'];
	$filename=$path.'locales'.DIRECTORY_SEPARATOR.'bootstrap-datepicker.'.$options['language'].'.min.js';
} else {
	$jsfiles=[$path.'js'.DIRECTORY_SEPARATOR.'bootstrap-datepicker.js'];
	$cssfiles=[$path.'css'.DIRECTORY_SEPARATOR.'bootstrap-datepicker3.css'];
	$filename=$path.'locales'.DIRECTORY_SEPARATOR.'bootstrap-datepicker.'.$options['language'].'.min.js';
}

if (file_exists(Settings::getStringVar('settings_abspath').$filename)===true) {
	$jsfiles[]=$filename;
}

$this->addTemplateJSFiles('head', $jsfiles);
$this->addTemplateCSSFiles('head', $cssfiles);

?>
