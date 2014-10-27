<?php namespace Metin2CMS\Api\Transformers;

use Metin2CMS\Core\Transformers\AbstractTransformer;

class AccountTransformer extends AbstractTransformer {

    public function transform($item)
    {
        return array(
            'id'            => (int) $item['id'],
            'username'      => $item['login'],
            'deletion_code' => (int) $item['social_id'],
            'email'         => (int) $item['email'],
            'created_at'    => $item['create_time'],
            'status'        => $item['status'],
            'coins'         => $item['cash'],
            'marks'         => $item['mileage'],
            'ban_expire'    => $item['availDt'],
            'last_play'     => $item['last_play'],
            'type'          => (int) $item['type'],
        );
    }
}