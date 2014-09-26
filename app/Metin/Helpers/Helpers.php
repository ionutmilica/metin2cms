<?php

/**
 * This function mimic mysql password() internal function.
 * Blame metin2 core for using this instead a proper algorithm
 *
 * @param $password
 * @return string
 */

function mysqlHash($password)
{
    return '*'.strtoupper(sha1(sha1($password, true)));

    // Slower but will work on every mysql versions.
    //return DB::selectOne("SELECT PASSWORD('".$password."') AS `password`;")->password;
}

if ( ! function_exists('view'))
{
    function view($name)
    {
        return View::make($name);
    }
}
