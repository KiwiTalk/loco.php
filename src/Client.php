<?php


namespace loco;


use loco\protocol\ProtocolInfo;
use loco\structure\RegisterDeviceData;
use loco\structure\LoginData;
use loco\utils\request;

class Client {

	private string $email;
	private string $password;
	private string $client_name;

	public function __construct(string $email, string $password, string $client_name) {
		$this->email = $email;
		$this->password = $password;
		$this->client_name = $client_name;
	}

	/**
	 * 인증코드를 요청합니다.
	 *
	 * @param  string  $device_uuid
	 * @param  string  $os_version
	 * @param  string  $device_name
	 * @param  bool    $permanent
	 *
	 * @param  bool    $forced
	 *
	 * @return array
	 */
	public function requestPasscode(string $device_uuid, string $os_version, string $device_name, bool $permanent = false, bool $forced = false): array {
		return json_decode(request::postURL(ProtocolInfo::getAccountInternalURL(ProtocolInfo::Account["REQUEST_PASSCODE"]), request::queryToString(LoginData::create(
				$this->email,
				$this->password,
				$device_uuid,
				$os_version,
				$device_name,
				$permanent,
				$forced
		)->__toArray()), ProtocolInfo::getAuthHeader(
				ProtocolInfo::calculateXVCKey(ProtocolInfo::AuthUserAgent, $this->email, $device_uuid)
		)), true);
	}

	/**
	 * 인증코드를 사용해 기기를 등록합니다.
	 *
	 * @param  string  $passcode
	 * @param  string  $device_uuid
	 * @param  string  $os_version
	 * @param  string  $device_name
	 * @param  bool    $permanent
	 *
	 * @return array
	 */
	public function registerDevice(string $passcode, string $device_uuid, string $os_version, string $device_name, bool $permanent = false): array {
		return json_decode(request::postURL(ProtocolInfo::getAccountInternalURL(ProtocolInfo::Account["REGISTER_DEVICE"]), request::queryToString(RegisterDeviceData::create(
				$passcode,
				$this->email,
				$this->password,
				$device_uuid,
				$os_version,
				$device_name,
				$permanent
		)->__toArray()), ProtocolInfo::getAuthHeader(
				ProtocolInfo::calculateXVCKey(ProtocolInfo::AuthUserAgent, $this->email, $device_uuid)
		)), true);
	}

	/**
	 * @internal
	 *
	 * @param  string  $device_uuid
	 * @param  string  $os_version
	 * @param  string  $device_name
	 * @param  bool    $permanent
	 * @param  bool    $forced
	 *
	 * @return array
	 */
	private function requestLogin(string $device_uuid, string $os_version, string $device_name, bool $permanent = false, bool $forced = false): array {
		return json_decode(request::postURL(ProtocolInfo::getAccountInternalURL(ProtocolInfo::Account["LOGIN"]), request::queryToString(LoginData::create(
				$this->email,
				$this->password,
				$device_uuid,
				$os_version,
				$device_name,
				$permanent,
				$forced
		)->__toArray()), ProtocolInfo::getAuthHeader(
				ProtocolInfo::calculateXVCKey(ProtocolInfo::AuthUserAgent, $this->email, $device_uuid)
		)), true);
	}

	/**
	 * 로그인을 시도합니다.
	 *
	 * @param  string  $device_uuid
	 * @param  string  $os_version
	 * @param  string  $device_name
	 * @param  bool    $permanent
	 * @param  bool    $forced
	 */
	public function login(string $device_uuid, string $os_version, string $device_name, bool $permanent = false, bool $forced = false): void {
		//TODO: initialize loco socket
		$loginResult = $this->requestLogin($device_uuid, $os_version, $device_name, $permanent, $forced);
	}

}