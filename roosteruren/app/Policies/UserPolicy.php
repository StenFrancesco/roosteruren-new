<?php

namespace App\Policies;

use App\Models\Afdeling;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
	use HandlesAuthorization;

	public function update_rooster_item(User $user, $roosteritem_user) {
		return true;
	}
}
