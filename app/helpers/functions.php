<?php

function dd($data)
{
    echo "<pre>";
    print_r($data);
    die();
}

function request($key = null, $default = null)
{
    $request = new Request();
    return $request->input($key, $default);
}