<?php

use BasicApp\Auth\Config\Auth;

if (!function_exists('auth'))
{
    function auth()
    {
        return service('auth');
    }
}

// Compability with:
// https://codeigniter.com/user_guide/extending/authentication.html

if (!function_exists('user_id'))
{
    function user_id()
    {
        return auth()->getUserId();
    }
}