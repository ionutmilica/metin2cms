<?php namespace Metin2CMS\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class Account extends Model implements AuthenticatableContract {

    use Authenticatable;
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
    protected  $fillable = ['login', 'password', 'email', 'status'];

    /**
     * Fields that will be hidden when the eloquent object is converted to json/array
     *
     * @var array
     */

    protected $hidden = ['password'];

    /**
     * Let Eloquent take care of password field. Using game default hash method.
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = mysqlHash($value);
    }

}
