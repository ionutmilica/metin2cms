<?php namespace Metin2CMS\Core\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Metin2CMS\Core\Entities\Guild;

class AbstractRepository {

    /**
     * Holds the model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
	{
		$this->model = $model;
	}

    /**
     * Generate a new model instance
     *
     * @param array $args
     * @return Model|static
     */
    public function getNew(array $args = array())
	{
		return $this->model->newInstance($args);
	}

    /**
     * Transform a collection into an array
     *
     * @param $data
     * @return mixed
     */
    public function toArray($data)
    {
        if (is_object($data))
        {
            if (($data instanceof \StdClass))
            {
                return (array) $data;
            }

            return $data->toArray();
        }

        if (is_null($data))
        {
            return false;
        }

        return $data;
    }
}