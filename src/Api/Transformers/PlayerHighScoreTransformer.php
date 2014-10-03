<?php namespace Metin2CMS\Api\Transformers;

class PlayerHighScoreTransformer extends AbstractTransformer {

    public function transform($item)
    {
        return array(
            'id'     => (int) $item['id'],
            'name'   => $item['name'],
            'level'  => (int) $item['level'],
            'empire' => (int) $item['empire']
        );
    }
}