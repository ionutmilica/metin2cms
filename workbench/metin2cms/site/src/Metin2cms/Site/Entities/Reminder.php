<?php namespace Metin2cms\Site\Entities;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model {

    /**
     * @var string
     */
    protected $table = 'password_reminders';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * Fields that are allowed to be mass-assigned
     *
     * @var array
     */
    protected $fillable = array('username', 'token', 'password');


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
     * @param $value
     */
    public function setUpdatedAtAttribute($value) { }
}
