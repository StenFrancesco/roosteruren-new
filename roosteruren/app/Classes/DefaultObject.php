<?php
namespace App\Classes;

class DefaultObject {
	public $data;
	public $row;
	public $id;

	public function json() {
		return array_merge(['id' => $this->id], $this->data());
	}

	public function val($key, $default = null) {
		return getval($this->data, $key, $default);
	}

	public function data() {
		return $this->data;
	}

	public function __construct($row) {
		$this->id = $row->id;
		$this->row = $row;
		$this->data = $row->data ? from_json_blob($row->data) : [];
	}
}
?>