<?php


namespace loco\structure;


class RegisterDeviceData {
	public string $passcode;
	public string $email;
	public string $password;
	public string $device_uuid;
	public string $os_version;
	public string $device_name;
	public bool $permanent = false;

	public static function create(string $passcode, string $email, string $password, string $device_uuid, string $os_version, string $device_name, bool $permanent = false): self {
		$obj = new self;
		$obj->passcode = $passcode;
		$obj->email = $email;
		$obj->password = $password;
		$obj->device_uuid = $device_uuid;
		$obj->os_version = $os_version;
		$obj->device_name = $device_name;
		$obj->permanent = $permanent;

		return $obj;
	}

	public function __toArray(): array {
		return [
				"passcode"    => $this->passcode,
				"email"       => $this->email,
				"password"    => $this->password,
				"device_uuid" => $this->device_uuid,
				"os_version"  => $this->os_version,
				"device_name" => $this->device_name,
				"permanent"   => $this->permanent
		];
	}
}