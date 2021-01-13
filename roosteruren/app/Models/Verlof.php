<?php
/**
 * Verlofaanvragen
 * - from
 * - to
 * - from_time
 * - to_time
 * - status
 * - user
 * - comments
 * - is_deleted
 * - date_modified
 * - date_created
 * - created_by
 */
namespace App\Models;

class Verlof {

	public static function create_verlof($update) {
		return self::update_verlof(false, $update);
	}

	public static function update_verlof($id, $update) {
		if (!$id && empty($update['date_created'])) $update['date_created'] = time();
		if (empty($update['date_modified'])) $update['date_modified'] = time();
		
		if ($id && $verlof = self::verlof_by_id($id)) {
			$update = array_merge($verlof->data(), $update);
		}

		$update = [
			'from' => $update['from'],
			'to' => $update['to'],
			'user' => $update['user'],
			'data' => gzdeflate(json_encode($update))
		];

		if ($id) {
			if (!DB::table('verlof')->where('id', $id)->update($update)) {
				return false;
			}
		}
		else {
			if (!($id = DB::table('verlof')->insertGetId($update))) {
				return false;
			}
		}

		if ($id && $verlof = $this->verlof_by_id($id)) {
			\App\Models\UserDayIndex::index_user_daterange($verlof->val('user'), $verlof->val('from'), $verlof->val('to'));
		}

		return $id;
	}

	public static function verlof_by_id($id) {
		if ($verlof = DB::table('verlof')->find($id)) {
			return $verlof;
		}
	}
}
?>