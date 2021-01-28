<?php

use Illuminate\Routing\Route;

/**
 * Set any link as active by adding class Active
 * @param [uri] $uri current url
 * @param string $output css class name
 */

function set_active($uri, $output = 'active')
{
    if (is_array($uri)) {
        foreach ($uri as $u) {
            if ((request()->is($u))) {
                return $output;
            }
        }
    } else {
        if ((request()->is($uri))) {
            return $output;
        }
    }
}
