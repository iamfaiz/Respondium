<?php

namespace App\Repositories;

interface UserInterface
{
	public function getForProfile($id);

	public function getAllForDashboard();

	public function getOrCreate($user);

	public function getOne($id);

	public function updateUser($id, $attributes);

	public function deleteUser($id);

	public function createNew($fields);

	public function confirmationCodeIsValid($code);

	public function nullOutTheConfirmationCode($userId);

	public function confirmEmail($userId);
}
