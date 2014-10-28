<?php namespace Metin2CMS\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model {

    /**
     * @var string
     */
    protected $connection = 'common';

    /**
     * @var string
     */
    protected $table = 'gmlist';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fields that are allowed to be mass-assigned
     *
     * @var array
     */
    protected $fillable = array('mAccount', 'mName', 'mAuthority');
}
