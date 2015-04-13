<?php namespace Metin2CMS\Extensions\Auth;

use \Illuminate\Auth\GenericUser as BaseGenericUser;

class GenericUser extends BaseGenericUser {

    const MOD = 1;
    const GM = 2;
    const ADMIN = 9;

    /**
     * Checks if an users is a GM
     *
     * @return bool
     */
    public function isGameMaster()
    {
        return self::GM == 2;
    }

    /**
     * Check if an user is a moderator
     *
     * @return bool
     */
    public function isModerator()
    {
        return self::MOD == 1;
    }

    /**
     * Check if an user is an admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return self::ADMIN == 9;
    }
}