<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDayController extends Controller {
	
	public function index(Request $request) {
		$this->authorize('view', \App\Classes\RoosterItem::class);

		$validated = $request->validate([
			'from' => 'digits:8',
			'to' => 'digits:8',
			'afdeling' => 'integer',
			'user' => 'integer'
		]);

		$list = [];
		
		if (!empty($validated['afdeling']) && !empty($validated['from']) && !empty($validated['to'])) {
			foreach (\App\Models\UserDayIndex::userday_for_afdeling_daterange($validated['afdeling'], $validated['from'], $validated['to']) as $userday) {
				$list[] = $userday->json();
			}
		}
		else if (!empty($validated['user']) && !empty($validated['from']) && !empty($validated['to'])) {
			foreach (\App\Models\UserDayIndex::userday_for_user_daterange($validated['user'], $validated['from'], $validated['to']) as $userday) {
				$list[] = $userday->json();
			}
		}
		else if (!empty($validated['from']) && !empty($validated['to'])) {
			foreach (\App\Models\UserDayIndex::userday_for_daterange($validated['from'], $validated['to']) as $userday) {
				$list[] = $userday->json();
			}
		}

		return $list;
	}
}
