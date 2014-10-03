<?php namespace Metin2CMS\Api\Transformers;

abstract class AbstractTransformer {

    /**
     * @param array $items
     * @return array
     */
    public function transformPagination(array $items)
    {
        // If it's not paginated, transform like a normal collection

        if ( ! isset($items['data']))
        {
            return $this->transformCollection($items);
        }

        $items['data'] = array_map(array($this, 'transform'), $items['data']);

        return $items;
    }
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