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

$version=Settings::getStringVar('vendor_lib_jslib_'.$lib_name.'_version');

$dir=strtolower($this->getClassName().DIRECTORY_SEPARATOR.$lib_name);
$name=$lib_name.DIRECTORY_SEPARATOR.$version.'.resource';
if (Resource::existsResource($this->getClassName(), $name)!==true) {
	Resource::copyResourcePath('oswvendor'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'jslib'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.$lib_name.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR, $dir.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR);
	Resource::writeResource($this->getClassName(), $name, time());
}

$path=Resource::getRelDir().$dir.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR;

$jsfiles=[$path.'js'.DIRECTORY_SEPARATOR.'aos.min.js'];
$cssfiles=[$path.'css'.DIRECTORY_SEPARATOR.'aos.min.css'];

$this->addTemplateJSFiles('head', $jsfiles);
$this->addTemplateCSSFiles('head', $cssfiles);
$this->addTemplateJSCode('head', '$(function () { AOS.init(); });');

?>