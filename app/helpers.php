<?php

/**
 * Send flash message to Session
 *
 * @param  [String] $message [A message to send to the flash function object]
 * @return  App\Http\Flash@message        [Flash Function from the Flash Class]
 */
function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash');
    if (func_num_args() == 0) {
        return $flash;
    }
    return $flash->info($title, $message);
}
