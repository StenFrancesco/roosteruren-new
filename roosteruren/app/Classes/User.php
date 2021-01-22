<?php
namespace App\Classes;

class User extends \App\Classes\DefaultObject {

	public function json() {
		return [
			'id' => $this->id,
			'name' => $this->row->name,
			'email' => $this->row->email
		];
	}
}
?>