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

/**
 * Get current theme
 *
 * @return mixed
 */
function theme()
{
    return Config::get('theme.current');
}

/**
 * Get the current path to assets stored as a theme
 *
 * @param string $asset
 * @param null $theme
 * @return string
 */
function assetTheme($asset = '', $theme = null)
{
    if ($theme == null)
    {
        $theme = theme();
    }

    return asset('assets/' . $theme . '/' .$asset);
}
