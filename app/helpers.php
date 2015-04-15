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
 * Escape the string for search
 *
 * @param $string
 * @return string
 */
function dbEscape($string)
{
    return trim(DB::getPdo()->quote($string), '\'');
}

/**
 * Get current theme
 *
 * @return mixed
 */
function theme()
{
    return 'standard';
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

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array()) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img)
    {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}