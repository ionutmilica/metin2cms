<?php namespace Metin2CMS\Site\Entities;

use Illuminate\Auth\UserInterface;
use Illuminate\Database\Eloquent\Model;

class Account extends Model implements UserInterface {

    /**
     * Account table name
     *
     * @var string
     */

    protected $table = 'account';

    /**
     * As we have pre-created table, we have no timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fields that are allowed to be mass-assigned
     *
     * @var array
     */
    protected  $fillable = array('login', 'password', 'email', 'status');

    /**
     * Fields that will be hidden when the eloquent object is converted to json/array
     *
     * @var array
     */

    protected $hidden = array('password');

    /**
     * Let Eloquent take care of password field. Using game default hash method.
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = mysqlHash($value);
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
