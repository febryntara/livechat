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
