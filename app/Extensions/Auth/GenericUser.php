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
        return self::GM == $this->getAccountType();
    }

    /**
     * Check if an user is a moderator
     *
     * @return bool
     */
    public function isModerator()
    {
        return self::MOD == $this->getAccountType();
    }

    /**
     * Check if an user is an admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return self::ADMIN == $this->getAccountType();
    }

    /**
     * Get account type
     *
     * @return int
     */
    protected function getAccountType()
    {
        if ( ! isset($this->type)) {
            return -1;
        }
        return (int) $this->type;
    }
}