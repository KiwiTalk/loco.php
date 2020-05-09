<?php


namespace loco;


use loco\protocol\ProtocolInfo;
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
	 * @param  bool  $permanent
	 *
	 * @return array
	 */
	public function requestPasscode(string $device_uuid, string $os_version, string $device_name, bool $permanent = false, bool $forced = false): array {
		return json_decode(request::postURL(ProtocolInfo::getAccountInternalURL(ProtocolInfo::Account["LOGIN"]), $field = request::queryToString(LoginData::create(
				$this->email,
				$this->password,
				$device_uuid,
				$os_version,
				$device_name
		)->__toArray()), ProtocolInfo::getAuthHeader(
				ProtocolInfo::calculateXVCKey(ProtocolInfo::AuthUserAgent, $this->email, $device_uuid)
		)), true);
	}

}