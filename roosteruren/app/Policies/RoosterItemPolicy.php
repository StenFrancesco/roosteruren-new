<?php

namespace App\Policies;

use App\Models\Afdeling;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoosterItemPolicy
{
	use HandlesAuthorization;

	public function create(User $user) {
		return true;
	}

	public function view(User $user, $roosteritem = false) {
		return true;
	}

	public function update(User $user, $roosteritem) {
		return true;
	}
}
