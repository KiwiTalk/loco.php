<?php


namespace loco\structure;


class LoginData {
	public string $email;
	public string $password;
	public string $device_uuid;
	public string $os_version;
	public string $device_name;
	public bool $permanent = false;
	public bool $forced = false;

	public static function create(string $email, string $password, string $device_uuid, string $os_version, string $device_name, bool $permanent = false, bool $forced = false): self {
		$obj = new self;
		$obj->email = $email;
		$obj->password = $password;
		$obj->device_uuid = $device_uuid;
		$obj->os_version = $os_version;
		$obj->device_name = $device_name;
		$obj->permanent = $permanent;
		$obj->forced = $forced;

		return $obj;
	}

	public function __toArray(): array {
		return [
				"email"       => $this->email,
				"password"    => $this->password,
				"device_uuid" => $this->device_uuid,
				"os_version"  => $this->os_version,
				"device_name" => $this->device_name,
				"permanent"   => $this->permanent,
				"forced"      => $this->forced
		];
	}
}