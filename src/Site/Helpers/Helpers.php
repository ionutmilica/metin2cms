<?php

/**
 * Mysql 5.* password() replacement.
 *
 * @param $password
 * @return string
 */
function mysqlHash($password)
{
    return '*'.strtoupper(sha1(sha1($password, true)));
}

function assetTheme($asset, $theme = null)
{
    if ($theme == null)
    {
        $theme = Config::get('theme.current');
    }

    return asset('assets/' . $theme . '/' .$asset);
}
