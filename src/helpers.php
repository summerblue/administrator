<?php

if (!function_exists('setting'))
{
    function setting($key, $default = '', $setting_name = 'site')
    {
        if ( ! config()->get($setting_name)) {
            // Decode the settings to an associative array.
            $site_settings = json_decode(file_get_contents(storage_path("/administrator_settings/$setting_name.json")), true);
            // Add the site settings to the application configuration
            config()->set($setting_name, $site_settings);
        }

        // Access a setting, supplying a default value
        return config()->get($setting_name.'.'.$key, $default);
    }
}

if (!function_exists('admin_setting')) {
    function admin_setting($key, $default = '', $setting_name = 'site')
    {
        if ( ! config()->get($setting_name)) {
            // Decode the settings to an associative array.
            $site_settings = json_decode(file_get_contents(storage_path("/administrator_settings/$setting_name.json")), true);
            // Add the site settings to the application configuration
            config()->set($setting_name, $site_settings);
        }

        // Access a setting, supplying a default value
        return config()->get($setting_name.'.'.$key, $default);
    }
}
