<?php
namespace Tcc\Resource\Registry;

class Registry {
	private static $instance;
	private $keys = array();

	private function __construct() {
	}

	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new Registry();
		}

		return self::$instance;
	}

	public function addKey($key, $value) {
		$this->keys[$key] = $value;
	}

	public function getKey($key) {
		if (!isset($this->keys[$key])) {
			throw new \InvalidArgumentException(sprintf("'%s' key no defined.", $key));
		}

		return $this->keys[$key];
	}
}