<?php namespace Metin2CMS\Api\Transformers;

use Metin2CMS\Core\Transformers\AbstractTransformer;

class GuildHighScoreTransformer extends AbstractTransformer {

    /**
     * Transform the item into a valid json object
     *
     * @param $item
     * @return array|mixed
     */
    public function transform($item)
    {
        return array(
            'name' => $item['guild_name'],
            'level' => (int) $item['level'],
            'master' => (int) $item['master'],
            'points' => (int) $item['ladder_point'],
            'empire' => (int) $item['empire'],
        );
    }
}