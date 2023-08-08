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

$version=Settings::getStringVar('vendor_lib_jquery_'.$plugin_name.'_version');

if (!isset($options['min'])) {
	$options['min']=true;
}

$dir=strtolower('bootstrap'.DIRECTORY_SEPARATOR.$plugin_name);
$name=$plugin_name.DIRECTORY_SEPARATOR.$version.'.resource';
if (Resource::existsResource('bootstrap', $name)!==true) {
	$files=['js'.DIRECTORY_SEPARATOR.'jquery.dataTables.js', 'js'.DIRECTORY_SEPARATOR.'dataTables.bootstrap5.js', 'css'.DIRECTORY_SEPARATOR.'dataTables.bootstrap5.css', 'js'.DIRECTORY_SEPARATOR.'jquery.dataTables.min.js', 'js'.DIRECTORY_SEPARATOR.'dataTables.bootstrap5.min.js', 'css'.DIRECTORY_SEPARATOR.'dataTables.bootstrap5.min.css'];
	Resource::copyResourcePath('oswvendor'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'jquery'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.$plugin_name.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR, $dir.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR, $files);
	Resource::writeResource('bootstrap', $name, time());
}

$path=Resource::getRelDir().$dir.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR;

if ($options['min']===true) {
	$jsfiles=[$path.'js'.DIRECTORY_SEPARATOR.'jquery.dataTables.min.js', $path.'js'.DIRECTORY_SEPARATOR.'dataTables.bootstrap5.min.js'];
	$cssfiles=[$path.'css'.DIRECTORY_SEPARATOR.'dataTables.bootstrap5.min.css'];
}
else {
	$jsfiles=[$path.'js'.DIRECTORY_SEPARATOR.'jquery.dataTables.js', $path.'js'.DIRECTORY_SEPARATOR.'dataTables.bootstrap5.js'];
	$cssfiles=[$path.'css'.DIRECTORY_SEPARATOR.'dataTables.bootstrap5.css'];
}

$this->addTemplateJSFiles('head', $jsfiles);
$this->addTemplateCSSFiles('head', $cssfiles);

?>