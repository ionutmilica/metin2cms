<?php namespace Metin2CMS\Api\Transformers;

abstract class AbstractTransformer {

    /**
     * Transform an entire collection
     *
     * @param array $items
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map(array($this, 'transform'), $items);
    }

    /**
     * Transform a single item
     *
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);
}