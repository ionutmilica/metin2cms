<?php namespace Metin2cms\Site\Entities;

use Illuminate\Database\Eloquent\Model;

class Guild extends Model {

    /**
     * Connection
     *
     * @var string
     */
    protected $connection = 'player';

    /**
     * Guild table
     *
     * @var string
     */
    protected $table = 'guild';
}