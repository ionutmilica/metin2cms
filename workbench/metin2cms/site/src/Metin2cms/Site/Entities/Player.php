<?php

namespace Metin2cms\Site\Entities;

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