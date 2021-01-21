<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayInfoController extends Controller {
	
	public function index(Request $request) {
		$this->authorize('view', \App\Classes\RoosterItem::class);
		setlocale(LC_ALL, 'nl_NL');
		$validated = $request->validate([
			'from' => 'digits:8',
			'to' => 'digits:8'
		]);

		$list = [];
		
		if (!empty($validated['from']) && !empty($validated['to'])) {
			foreach (each_date($validated['from'], $validated['to']) as $date) {
				$list[] = [
					'date' => $date,
					'title' => date_lang('l j F Y', strtotime($date)),
					'title_short' => date_lang('D j M', strtotime($date))
				];
			}
		}

		return $list;
	}
}
