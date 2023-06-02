<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('get_segment_url')) {
    function get_segment_url()
    {
        $segment = [];
        $current_url = explode('/', url()->current());
        foreach ($current_url as $key => $value) {
            if ($key > 2) {
                $segment[] = $value;
            }
        }
        return $segment;
    }
}

if (!function_exists('asset')) {
    function asset($path)
    {
        return env('APP_URL') . $path;
    }
}

if (!function_exists('active_checker')) {
    function active_checker(String $keyword, String $if_true, String $if_false)
    {
        return Request::is($keyword) ? $if_true : $if_false;
    }
}
if (!function_exists('parse_url_components')) {
    function parse_url_components($url)
    {
        $parsed_url = parse_url($url);

        $components = [
            'protocol' => isset($parsed_url['scheme']) ? $parsed_url['scheme'] : '',
            'host' => isset($parsed_url['host']) ? $parsed_url['host'] : '',
            'path' => isset($parsed_url['path']) ? $parsed_url['path'] : '',
            'query' => isset($parsed_url['query']) ? $parsed_url['query'] : '',
            'fragment' => isset($parsed_url['fragment']) ? $parsed_url['fragment'] : '',
        ];
        $components['path_sliced'] = explode("/", $components['path']);

        return $components;
    }
}
