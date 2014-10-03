<?php namespace Metin2CMS\Core\Entities;

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