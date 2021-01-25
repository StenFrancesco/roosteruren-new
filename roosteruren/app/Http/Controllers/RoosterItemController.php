<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoosterItemController extends Controller {
	
	public function index(Request $request) {
		$this->authorize('view', \App\Classes\RoosterItem::class);

		return [];
	}

	public function store(Request $request) {
		$this->authorize('create', \App\Classes\RoosterItem::class);
		
		$validated = $request->validate([
			'afdeling' => 'required|int',
			'user' => 'required|int',
			'date' => 'required|int',
			'tijden' => '',
			'uren' => '',
			'opmerkingen' => ''
		]);

		if (!empty($validated['tijden'])) {
			$validated['tijden'] = validate_uren_range($validated['tijden']);
			$validated['uren'] = int_to_time(uren_range_to_time($validated['tijden']));
		}
		if (!empty($validated['uren'])) {
			$validated['uren'] = time_to_int($validated['uren']);
		}
		
		if ($afdeling = \App\Models\Afdeling::afdeling_by_id($validated['afdeling'])) {
			$this->authorize('update_rooster_item', $afdeling);
		}
		else {
			abort(404, 'Afdeling niet gevonden');
		}

		if ($user = \App\Models\User::user_by_id($validated['user'])) {
			$this->authorize('update_rooster_item', $user);
		}
		else {
			abort(404, 'Gebruiker niet gevonden');
		}

		if ($roosteritem = \App\Models\RoosterItem::create_roosteritem($validated, Auth::user()->id)) {
			return [
				'roosteritem' => $roosteritem->json(),
				'userday' => ($userday = \App\Models\UserDayIndex::userday_for_user_date($validated['user'], $validated['date'])) ? $userday->json() : false
			];
		}
		else {
			return ['error' => 'Could not create roosteritem'];
		}
	}

	public function show($id) {
		
		Auth::loginUsingId(1);
		if ($roosteritem = \App\Models\RoosterItem::roosteritem_by_id($id)) {
			$this->authorize('view', $roosteritem);
			return $roosteritem->json();
		}
		else {
			abort(404);
		}
	}

	public function destroy($id) {
		
		if ($roosteritem = \App\Models\RoosterItem::roosteritem_by_id($id)) {
			$this->authorize('update', $roosteritem);
			
			if ($roosteritem = \App\Models\RoosterItem::update_roosteritem($afdeling->id, ['is_deleted' => 1], Auth::user()->id)) {
				return $roosteritem->json();
			}
			else {
				return ['error' => 'Could not delete roosteritem'];
			}
		}
		else {
			abort(404);
		}
	}
}
