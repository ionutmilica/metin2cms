<?php

function mysqlHash($password)
{
    return '*'.strtoupper(sha1(sha1($password, true)));

    //return DB::selectOne("SELECT PASSWORD('".$password."') AS `password`;")->password;
}