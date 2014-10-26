<?php namespace Metin2CMS\Core\Extensions;

use \Illuminate\Auth\GenericUser as BaseGenericUser;

class GenericUser extends BaseGenericUser {

    /**
     * Checks if an users is a GM
     *
     * @return bool
     */
    public function isGameMaster()
    {
        return $this->type == 2;
    }

    /**
     * Check if an user is a moderator
     *
     * @return bool
     */
    public function isModerator()
    {
        return $this->type == 1;
    }

    /**
     * Check if an user is an admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->type == 9;
    }
}