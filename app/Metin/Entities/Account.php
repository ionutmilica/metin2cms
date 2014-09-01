<?php namespace Metin\Entities;

use Illuminate\Auth\UserInterface;
use Illuminate\Database\Eloquent\Model;

class Account extends Model {

    /**
     * @var string Mysql table for accounts
     */

    protected $table = 'account';
}
