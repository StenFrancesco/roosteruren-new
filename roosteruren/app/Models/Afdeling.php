<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class Afdeling {

	public static function create_afdeling($update, $user = false) {
		return self::update_afdeling(false, $update, $user);
	}

	public static function update_afdeling($id, $update, $user = false) {
		if (!$id && empty($update['date_created'])) $update['date_created'] = time();
		if (!$id && $user) $update['created_by'] = $user;
		if (empty($update['date_modified'])) $update['date_modified'] = time();
		
		if ($id && $afdeling = self::afdeling_by_id($id)) {
			$update = array_merge($afdeling->data(), $update);
		}

		$update = [
			'data' => to_json_blob($update)
		];

		if ($id) {
			if (!DB::table('afdeling')->where('id', $id)->update($update)) {
				return false;
			}
		}
		else {
			if (!($id = DB::table('afdeling')->insertGetId($update))) {
				return false;
			}
		}
		
		return self::afdeling_by_id($id);
	}

	public static function afdeling_by_id($id) {
		if ($afdeling = DB::table('afdeling')->find($id)) {
			return new \App\Classes\Afdeling($afdeling);
		}
	}

	public static function all_afdelingen() {
		if ($afdelingen = DB::table('afdeling')->get()) {
			foreach ($afdelingen as $i => $afdeling) {
				$afdelingen[$i] = new \App\Classes\Afdeling($afdeling);
			}
			return $afdelingen;
		}
	}

	public static function title_is_used($title) {
		foreach (self::all_afdelingen() as $afdeling) {
			if (!$afdeling->val('is_deleted') && $afdeling->val('title') == $title) return true;
		}
		return false;
	}
}
?>