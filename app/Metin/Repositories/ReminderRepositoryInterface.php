<?php

namespace Metin\Repositories;

interface ReminderRepositoryInterface {

	public function generatePassword(array $data, $token, $password);

	public function findByToken($token);

	public function deleteToken($token);
}