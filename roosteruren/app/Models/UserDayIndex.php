<?php
/**
 * UserDayIndex 
 * - user
 * - date
 * - rooster
 * - verlof
 * - ziek
 * - beschikbaarheid
 */
namespace App\Models;

use Illuminate\Support\Facades\DB;

class UserDayIndex {

	public static function index_user_daterange($user, $from, $to) {
		foreach (each_date($from, $to) as $date) {
			self::index($user, $date);
		}
	}

	public static function index($user, $date) {

		$afdelingen = [];
		$update = [
			'user' => $user,
			'date' => $date,
			'rooster' => [],
			'verlof' => [],
			'ziek' => [],
			'beschikbaar' => [],
		];
		
		if ($roosteritems = \App\Models\RoosterItem::roosteritems_by_user_date($user, $date)) {
			foreach ($roosteritems as $roosteritem) {
				$update['rooster'][] = $roosteritem->data();
				if ($roosteritem->val('afdeling') && !in_array($roosteritem->val('afdeling'), $afdelingen)) {
					$afdelingen[] = $roosteritem->val('afdeling');
				}
			}
		}

		if ($verlofaanvragen = \App\Models\Verlof::verlof_by_user_date($user, $date)) {
			foreach ($verlofaanvragen as $verlof) {
				$update['verlof'][] = $verlof->data();
			}
		}

		if ($ziekmeldingen = \App\Models\Ziek::ziek_by_user_date($user, $date)) {
			foreach ($ziekmeldingen as $ziek) {
				$update['ziek'][] = $ziek->data();
			}
		}

		$id = self::id_from_user_date($user, $date);
		
		DB::table('user_day_index')->updateOrInsert(['id' => $id], [
			'date' => $date,
			'user' => $user,
			'data' => to_json_blob($update)
		]);
		
		// Afdelingen in aparte koppeltabel omdat er meerdere afdelingen per userday kunnen zijn
		if ($user_day_afdelingen = DB::table('user_day_index_afdeling')->where('userday', $id)->get()) {
			foreach ($user_day_afdelingen as $user_day_afdeling) {
				if (!in_array($user_day_afdeling->afdeling, $afdelingen)) {
					DB::table('user_day_index_afdeling')->where('id', $user_day_afdeling->id)->delete();
				}
				else {
					$afdelingen = array_diff($afdelingen, [$user_day_afdeling->afdeling]);
				}
			}
		}
		foreach ($afdelingen as $afdeling) {
			DB::table('user_day_index_afdeling')->insert([
				'userday' => $id,
				'afdeling' => $afdeling
			]);
		}

		return $id;
	}

	public static function userday_for_daterange($from, $to) {
		if ($userdays = DB::table('user_day_index')->whereBetween('date', [$from, $to])->get()) {
			foreach ($userdays as $i => $userday) {
				$userdays[$i] = new \App\Classes\UserDay($userday);
			}
			return $userdays;
		}
	}

	public static function userday_for_afdeling_daterange($afdeling, $from, $to) {
		if ($userdays = DB::table('user_day_index')->select('user_day_index.*')
			->join('user_day_index_afdeling', 'user_day_index.id', '=', 'user_day_index_afdeling.userday')
			->where('user_day_index_afdeling.afdeling', $afdeling)
			->whereBetween('date', [$from, $to])->get()) {
			foreach ($userdays as $i => $userday) {
				$userdays[$i] = new \App\Classes\UserDay($userday);
			}
			return $userdays;
		}
	}

	public static function userday_for_user_daterange($user, $from, $to) {
		if ($userdays = DB::table('user_day_index')->where('user', $user)->whereBetween('date', [$from, $to])->get()) {
			foreach ($userdays as $i => $userday) {
				$userdays[$i] = new \App\Classes\UserDay($userday);
			}
			return $userdays;
		}
	}

	public static function userday_for_user_date($user, $date) {
		if ($userday = DB::table('user_day_index')->find(self::id_from_user_date($user, $date))) {
			return new \App\Classes\UserDay($userday);
		}
	}

	public static function id_from_user_date($user, $date) {
		return intval($date) | intval($user) << 28;
	}
	public static function split_id($id) {
		return [
			'user' => $id >> 28 & 0xFFFFF,
			'date' => $id & 0xFFFFFFF
		];
	}
	
}
?>