<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AfdelingController extends Controller {
	
	public function index(Request $request) {
		$this->authorize('view', \App\Classes\Afdeling::class);

		$afdelingen = \App\Models\Afdeling::all_afdelingen();
		
		$list = [];
		foreach ($afdelingen as $afdeling) {
			$list[] = $afdeling->json();
		}

		return $list;
	}

	public function store(Request $request) {
		$this->authorize('create', \App\Classes\Afdeling::class);
		
		$validated = $request->validate([
			'title' => 'required|max:255'
		]);
		
		if (\App\Models\Afdeling::title_is_used($validated['title'])) {
			abort(403, 'Name already used!');
		}

		if ($afdeling = \App\Models\Afdeling::create_afdeling($validated, Auth::user()->id)) {
			return $afdeling->json();
		}
		else {
			return ['error' => 'Could not create afdeling'];
		}
	}

	public function show($id) {
		$this->authorize('view', \App\Classes\Afdeling::class);

		if ($afdeling = \App\Models\Afdeling::afdeling_by_id($id)) {
			return $afdeling->json();
		}
		else {
			abort(404);
		}
	}

	public function update(Request $request, $id) {
		
		if ($afdeling = \App\Models\Afdeling::afdeling_by_id($id)) {
			$this->authorize('update', $afdeling);
			
			$validated = $request->validate([
				'title' => 'required|max:255',
				'is_deleted' => 'int'
			]);

			if ($afdeling = \App\Models\Afdeling::update_afdeling($afdeling->id, $validated, Auth::user()->id)) {
				return $afdeling->json();
			}
			else {
				return ['error' => 'Could not update afdeling'];
			}
		}
		else {
			abort(404);
		}
	}

	public function destroy($id) {
		
		if ($afdeling = \App\Models\Afdeling::afdeling_by_id($id)) {
			$this->authorize('update', $afdeling);
			
			if ($afdeling = \App\Models\Afdeling::update_afdeling($afdeling->id, ['is_deleted' => 1], Auth::user()->id)) {
				return $afdeling->json();
			}
			else {
				return ['error' => 'Could not delete afdeling'];
			}
		}
		else {
			abort(404);
		}
	}

	public function users() {

		$list = [];
		foreach (\App\Models\User::all_users() as $user) {
			$list[] = $user->json();
		}
		return $list;
	}
}
