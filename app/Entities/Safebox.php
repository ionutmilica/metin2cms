<?php namespace Metin2CMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Safebox extends Model {

    /**
     * @var string
     */
    protected $connection = 'player';

    /**
     * @var string
     */
    protected $table = 'safebox';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fields that are allowed to be mass-assigned
     *
     * @var array
     */
    protected $fillable = array('accound_id', 'size', 'password');
}
