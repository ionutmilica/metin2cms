<?php

namespace Metin\Repositories;

interface ReminderRepositoryInterface {

	public function generatePassword(array $data, $token, $password);
}