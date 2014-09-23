<?php

namespace Metin\Repositories;

interface AccountRepositoryInterface {

	public function create(array $info);

	public function findById($id);

	public function findByName($login);

	public function changePassword(array $data);
}