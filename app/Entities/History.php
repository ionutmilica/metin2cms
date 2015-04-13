<?php namespace Metin2CMS\Entities;

use Illuminate\Database\Eloquent\Model;

class History extends Model {

    /**
     * @var string
     */
    protected $table = 'history';

    /**
     * @var bool
     */
    public $timestamps = false;
}
