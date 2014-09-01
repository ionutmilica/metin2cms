<?php

use Illuminate\Database\Eloquent\Model;

class AbstractRepository {

	protected $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function getNew(array $args = array())
	{
		return $this->model->newInstance($args);
	}
}