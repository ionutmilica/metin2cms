<?php namespace Metin2CMS\Core\Entities;

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
