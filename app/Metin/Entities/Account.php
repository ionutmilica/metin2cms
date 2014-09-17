<?php namespace Metin\Entities;

use Illuminate\Auth\UserInterface;
use Illuminate\Database\Eloquent\Model;

class Account extends Model {

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

    public function getDates()
    {
        return array('create_time');
    }

    public function getReminderUsername()
    {
        return $this->username;
    }
}
