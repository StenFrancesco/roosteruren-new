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

class UserDayIndex {

	public static function index_user_daterange($user, $from, $to) {
		
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
		
		if ($roosteritems = \App\Model\RoosterItem::roosteritems_by_user_date($user, $date)) {
			foreach ($roosteritems as $roosteritem) {
				$update['rooster'][] = $roosteritem->data();
				if ($roosteritem->val('afdeling') && !in_array($roosteritem->val('afdeling'), $afdelingen)) {
					$afdelingen[] = $roosteritem->val('afdeling');
				}
			}
		}

		$id = self::id_from_user_date($user, $date);
		
		DB::table('user_day_index')->updateOrInsert(['id' => $id], [
			'date' => $date,
			'user' => $user,
			'data' => gzdeflate(json_encode($update))
		]);
		
		// Afdelingen in aparte koppeltabel omdat er meerdere afdelingen per userday kunnen zijn
		if ($user_day_afdelingen = DB::table('user_day_index_afdeling')->where('user_day', $id)->get()) {
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
				'userday' > $id,
				'afdeling' => $afdeling
			]);
		}

		return $id;
	}

	public function userday_for_daterange($from, $to) {
		if ($query = DB::table('user_day_index')->whereBetween('date', [$from, $to])->get()) {
			return $query;
		}
	}

	public function userday_for_afdeling_daterange($afdeling, $from, $to) {
		if ($query = DB::table('user_day_index')->select('user_day_index.*')
			->join('user_day_index_afdeling', 'user_day_index.id', '=', 'user_day_index_afdeling.userday')
			->where('user_day_index_afdeling.afdeling', $afdeling)
			->whereBetween('date', [$from, $to])->get()) {
			return $query;
		}
	}

	public function userday_for_user_daterange($user, $from, $to) {
		if ($query = DB::table('user_day_index')->where('user', $user)->whereBetween('date', [$from, $to])->get()) {
			return $query;
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