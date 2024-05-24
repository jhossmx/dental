<?php
use Config\MyConfig;

//Dynamically add Javascript files to header page
if (!function_exists('add_js')) {

    function add_js($files = [])
    {
        $config = config('MyConfig');
        if (empty($files)) {
            return;
        }

        if (is_array($files)) {

            if (!is_array($files) && count($files) <= 0) {
                return;
            }
            foreach ($files as $item) {
                $config->footer_js[] = $item;
            }

        }
    }
}

//Dynamically add CSS files to header page
if (!function_exists('add_css')) {

    function add_css($files = [])
    {
        $config = config('MyConfig');
        if (empty($files)) {
            return;
        }
        if (is_array($files)) {
            if (!is_array($files) && count($files) <= 0) {
                return;
            }
            foreach ($files as $item) {
                $config->header_css[] = $item;
            }
        }
    }
}

//Putting our CSS files
if (!function_exists('put_css')) {
    function put_css()
    {
        $str = '';
        $config = config('MyConfig');
        foreach ($config->header_css as $item) {
            $str .= '<link rel="stylesheet" href="' . base_url() . 'assets/css/' . $item . '" type="text/css" />' . "\n";
        }
        return $str;
    }
}

//Putting our JS files
if (!function_exists('put_js')) {
    function put_js()
    {
        $str = '';
        $config = config('MyConfig');
        foreach ($config->footer_js as $item) {
            $str .= '<script type="text/javascript" src="' . base_url() . 'assets/js/' . $item . '"></script>' . "\n";
        }
        return $str;
    }
}

//Putting our CSS and JS files together
if (!function_exists('put_headers')) {
    function put_headers()
    {
        $str = '';
        $config = config('MyConfig');
        $header_css = $config->header_css;
        $header_js = $config->footer_js;

        foreach ($header_css as $item) {
            $str .= '<link rel="stylesheet" href="' . base_url() . 'css/' . $item . '" type="text/css" />' . "\n";
        }

        foreach ($header_js as $item) {
            $str .= '<script type="text/javascript" src="' . base_url() . 'js/' . $item . '"></script>' . "\n";
        }
        return $str;
    }
}