<?php

namespace App\Policies;

use App\Models\Afdeling;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AfdelingPolicy
{
	use HandlesAuthorization;

	public function create(User $user) {
		return true;
	}

	public function view(User $user) {
		return true;
	}

	public function update(User $user, $afdeling) {
		return true;
	}

	public function update_rooster_item(User $user, $afdeling) {
		return true;
	}
}
