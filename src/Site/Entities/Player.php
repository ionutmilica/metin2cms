<?php namespace Metin2CMS\Site\Entities;

use Illuminate\Database\Eloquent\Model;

class Player extends Model {

    /**
     * @var string
     */
    protected $connection = 'player';

    /**
     * @var string
     */
    protected $table = 'player';
} 