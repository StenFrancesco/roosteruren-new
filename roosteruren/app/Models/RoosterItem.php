<?php
/**
 * Roosteritem bevat de uren en tijden voor een gebruiker-dag-afdeling combinatie
 * - tijden (urenbereik(en), bijvoorbeeld 9:00 - 12:00, 13:00 - 18:00)
 * - uren (gekoppelde tijd in hele seconden)
 * - opmerking (extra opmerking, bijvoorbeeld "vergadering" of "cursus")
 * - date (datum als integer YYYYMMDD)
 * - user
 * - afdeling
 * - is_deleted
 * - date_modified
 * - date_created
 * - created_by
 */
namespace App\Models;

class RoosterItem {

	public static function create_roosteritem($update) {
		return self::update_roosteritem(false, $update);
	}

	public static function update_roosteritem($id, $update) {
		if (!$id && (empty($update['user']) || empty($update['afdeling']) || empty($update['date']))) return false;
		
		if (!$id && empty($update['date_created'])) $update['date_created'] = time();
		if (empty($update['date_modified'])) $update['date_modified'] = time();
		
		if (!$id) $id = self::id_from_date_afdeling_user($update['date'], $update['afdeling'], $update['user']);
		list($date, $afdeling, $user) = self::split_id($id);

		if ($id && $roosteritem = self::roosteritem_by_id($id)) {
			$update = array_merge($roosteritem->data(), $update);
		}

		DB::table('roosteritem')->updateOrInsert(['id' => $id], [
			'date' => $date,
			'afdeling' => $afdeling,
			'user' => $user,
			'data' => gzdeflate(json_encode($update))
		]);

		\App\Models\UserDayIndex::index($user, $date);

		return $id;
	}

	public static function roosteritem_by_id($id) {
		if ($roosteritem = DB::table('roosteritem')->find($id)) {
			return $roosteritem;
		}
	}

	public static function roosteritems_by_user_date($user, $date) {
		if ($roosteritems = DB::table('roosteritem')->where('user', $user)->where('date', $date)->get()) {
			return $roosteritems;
		}
	}

	public static function roosteritem_by_date_afdeling_user($date, $afdeling, $user) {
		return self::roosteritem_by_id(self::id_from_date_afdeling_user($date, $afdeling, $user));
	}

	public static function id_from_date_afdeling_user($date, $afdeling, $user) {
		return intval($date) | intval($afdeling) << 28 | intval($user) << 40;
	}

	public static function split_id($id) {
		return [
			'date' => $id & 0xFFFFFFF,
			'afdeling' => $id >> 28 & 0xFFF,
			'user' => $id >> 40 & 0xFFFFF
		];
	}
}
?>