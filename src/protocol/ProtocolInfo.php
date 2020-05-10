<?php


namespace loco\protocol;


final class ProtocolInfo implements ProtocolHostInfo {

	public static function getLocoPEMPublicKey(): string {
		return "-----BEGIN PUBLIC KEY-----\nMIIBIDANBgkqhkiG9w0BAQEFAAOCAQ0AMIIBCAKCAQEApElgRBx+g7sniYFW7LE8ivrwXShKTRFV8lXNItMXbN5QSC8vJ/cTSOTS619Xv5Zx7xXJIk4EKxtWesEGbgZpEUP2xQ+IeH9oz0JxayEMvvD1nVNAWgpWE4pociEoArsK7qY3YwXb1CiDHo9hojLv7djbo3cwXvlyMh4TUrX2RjCZPlVJxk/LVjzcl9ohJLkl3eoSrf0AE4kQ9mk3+raEhq5Dv+IDxKYX+fIytUWKmrQJusjtre9oVUX5sBOYZ0dzez/XapusEhUWImmB6mciVXfRXQ8IK4IH6vfNyxMSOTfLEhRYN2SMLzplAYFiMV536tLS3VmG5GJRdkpDubqPeQIBAw==\n-----END PUBLIC KEY-----";
	}

	public static function getLocoPublicKey(): string {
		return hex2bin("a44960441c7e83bb27898156ecb13c8afaf05d284a4d1155f255cd22d3176cde50482f2f27f71348e4d2eb5f57bf9671ef15c9224e042b1b567ac1066e06691143f6c50f88787f68cf42716b210cbef0f59d53405a0a56138a6872212802bb0aeea6376305dbd428831e8f61a232efedd8dba377305ef972321e1352b5f64630993e5549c64fcb563cdc97da2124b925ddea12adfd00138910f66937fab68486ae43bfe203c4a617f9f232b5458a9ab409bac8edadef685545f9b013986747737b3fd76a9bac121516226981ea67225577d15d0f082b8207eaf7cdcb13123937cb12145837648c2f3a65018162315e77ead2d2dd5986e46251764a43b9ba8f79");
	}

	public static function getInternalURL($type) {
		return ProtocolInfo::InternalProtocol . "://" . ProtocolInfo::InternalHost . "/" . ProtocolInfo::Agent . "/" . ProtocolInfo::AccountPath . "/" . $type;
	}

	public static function getAccountInternalURL($type) {
		return ProtocolInfo::InternalProtocol . "://" . ProtocolInfo::AccountInternalHost . "/" . ProtocolInfo::Agent . "/" . ProtocolInfo::AccountPath . "/" . $type;
	}

	public static function calculateFullXVCKey(string $aHeader, string $email, string $deviceUUID): string {
		return hash("sha512", "HEATH|{$aHeader}|DEMIAN|{$email}|{$deviceUUID}");
	}

	public static function calculateXVCKey(string $aHeader, string $email, string $deviceUUID): string {
		return substr(ProtocolInfo::calculateFullXVCKey($aHeader, $email, $deviceUUID), 0, 16);
	}

	public static function getAuthHeader(string $verifyCodeExtra): array {
		return [
				"Content-Type: application/x-www-form-urlencoded",
				"Host: " . ProtocolInfo::AccountInternalHost,
				"A: " . ProtocolInfo::AuthHeaderAgent,
				"X-VC: ${verifyCodeExtra}",
				"User-Agent: " . ProtocolInfo::AuthUserAgent,
				"Accept: */*",
				"Accept-Language: " . ProtocolInfo::Language
		];
	}

	public const Account = [
			"LOGIN" => "login.json",
			"REGISTER_DEVICE" => "register_device.json",
			"REQUEST_PASSCODE" => "request_passcode.json",
			"LOGIN_TOKEN" => "login_token.json",
			"REQUEST_VERIFY_EMAIL" => "request_verify_email.json",
			"RENEW_TOKEN" => "renew_token.json",
			"CHANGE_UUID" => "change_uuid.json",
			"CAN_CHANGE_UUID" => "can_change_uuid.json"
	];

	public const Agent = "win32";
	public const Version = "3.1.1";
	public const InternalAppVersion = ProtocolInfo::Version . "." . ProtocolInfo::InternalAppSubVersion;
	public const InternalAppSubVersion = "2441";
	public const OSVersion = "10.0";
	public const Language = "ko";
	public const AuthUserAgent = "KT/" . ProtocolInfo::Version . " Wd/" . ProtocolInfo::OSVersion . " " . ProtocolInfo::Language;
	public const AuthHeaderAgent = ProtocolInfo::Agent . "/" . ProtocolInfo::Version . "/" . ProtocolInfo::Language;

	public const AccountPath = "account";

}