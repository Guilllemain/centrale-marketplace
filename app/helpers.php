<?php 

if (! function_exists('utf8ize')) {
    function utf8ize($data)
    {
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $data[$k] = utf8ize($v);
            }
        } elseif (is_string($data)) {
            return utf8_encode($data);
        }
        return $data;
    }
}
