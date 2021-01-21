<?php
/**
 * Ziekmeldingen
 * - from
 * - to
 * - user
 * - comments
 * - is_deleted
 * - date_modified
 * - date_created
 * - created_by
 */
namespace App\Models;

use Illuminate\Support\Facades\DB;

class Ziek {

	public static function create_ziek($update) {
		return self::update_ziek(false, $update);
	}

	public static function update_ziek($id, $update) {
		if (!$id && empty($update['date_created'])) $update['date_created'] = time();
		if (empty($update['date_modified'])) $update['date_modified'] = time();
		
		if ($id && $ziek = self::ziek_by_id($id)) {
			$update = array_merge($ziek->data(), $update);
		}

		$update = [
			'from' => $update['from'],
			'to' => $update['to'],
			'user' => $update['user'],
			'data' => to_json_blob($update)
		];

		if ($id) {
			if (!DB::table('ziek')->where('id', $id)->update($update)) {
				return false;
			}
		}
		else {
			if (!($id = DB::table('ziek')->insertGetId($update))) {
				return false;
			}
		}

		if ($id && $ziek = $this->ziek_by_id($id)) {
			\App\Models\UserDayIndex::index_user_daterange($ziek->val('user'), $ziek->val('from'), $ziek->val('to'));
		}

		return $id;
	}

	public static function ziek_by_id($id) {
		if ($ziek = DB::table('ziek')->find($id)) {
			return $ziek;
		}
	}

	public static function ziek_by_user_date($user, $date) {
		if ($ziek = DB::table('ziek')->where('user', $user)->where('from', '<=', $date)->where('to', '>=', $date)->get()) {
			return $ziek;
		}
	}
}
?>