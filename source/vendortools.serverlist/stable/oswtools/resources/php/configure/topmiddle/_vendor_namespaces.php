<?php

$this->settings = ['page_title' => 'Vendor Namespaces'];

$vendor_settings = [];

foreach (glob(\osWFrame\Core\Settings::getStringVar('settings_framepath') . 'oswvendor' . DIRECTORY_SEPARATOR . 'namespaces' . DIRECTORY_SEPARATOR . '*') as $vendor) {
    $vendor_name = strtolower(str_replace(['.'], ['_'], basename($vendor)));
    $products = glob($vendor . DIRECTORY_SEPARATOR . 'version-*');
    if ($products != []) {
        foreach (glob($vendor . DIRECTORY_SEPARATOR . '*') as $vendor_version) {
            if (is_dir($vendor_version)) {
                $vendor_version = basename($vendor_version);
                $vendor_settings[$vendor_name][$vendor_version] = $vendor_version;
            }
        }
        if ($vendor_settings[$vendor_name] == []) {
            unset($vendor_settings[$vendor_name]);
        } else {
            krsort($vendor_settings[$vendor_name]);
        }
    } else {
        foreach (glob($vendor . DIRECTORY_SEPARATOR . '*') as $product) {
            $product_name = strtolower(str_replace(['.'], ['_'], basename($product)));
            $vendor_versions = glob($product . DIRECTORY_SEPARATOR . 'version-*');
            if ($vendor_versions != []) {
                $vendor_settings[$vendor_name . '_' . $product_name] = [];
                foreach (glob($product . DIRECTORY_SEPARATOR . '*') as $vendor_version) {
                    if (is_dir($vendor_version)) {
                        $vendor_version = basename($vendor_version);
                        $vendor_settings[$vendor_name . '_' . $product_name][$vendor_version] = $vendor_version;
                    }
                }
                if ($vendor_settings[$vendor_name . '_' . $product_name] == []) {
                    unset($vendor_settings[$vendor_name . '_' . $product_name]);
                } else {
                    krsort($vendor_settings[$vendor_name . '_' . $product_name]);
                }
            }
        }
    }
}

foreach ($vendor_settings as $v => $vv) {
    $this->fields['vendor_namespace_' . $v . '_version'] = ['default_name' => $v, 'default_type' => 'select', 'default_select' => array_merge(['0' => 'newest'], $vv), 'default_value' => '', 'valid_type' => 'oswvendor', 'valid_min_length' => 1, 'valid_max_length' => 32, 'configure_write' => true];
    $this->fields['vendor_namespace_' . $v . '_versions'] = ['default_name' => $v . '_versions', 'default_type' => 'hidden', 'default_value' => implode(';', $vv), 'valid_type' => 'string', 'valid_min_length' => 1, 'valid_max_length' => 1024, 'configure_write' => true];
}

?>