<?php namespace Metin2CMS\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class AccountMeta extends Model {

    /**
     * @var string
     */
    protected $table = 'account_meta';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fields that are allowed to be mass-assigned
     *
     * @var array
     */
    protected $fillable = array('account_id', 'meta_key', 'meta_value', 'meta_type');
}
