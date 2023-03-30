<?php

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
