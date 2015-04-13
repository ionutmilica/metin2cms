<?php namespace Metin2CMS\Core\Transformers;

abstract class AbstractTransformer {

    /**
     * Transform pagination to be able to deal with REST apis
     *
     * @param array $items
     * @return array
     */
    public function transformPagination(array $items)
    {
        if ( ! isset($items['data'])) {
            return $this->transformCollection($items);
        }

        return [
            'total'   => $items['total'],
            'perPage' => $items['per_page'],
            'page'    => $items['current_page'],
            'last'    => $items['last_page'],
            'from'    => $items['from'],
            'to'      => $items['to'],
            'data'    => array_map([$this, 'transform'], $items['data']),
        ];
    }
    /**
     * Transform an entire collection
     *
     * @param array $items
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * Transform a single item
     *
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);
}