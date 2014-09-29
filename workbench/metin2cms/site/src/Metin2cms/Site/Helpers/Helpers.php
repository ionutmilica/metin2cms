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

