<?php


namespace loco\protocol;


interface ProtocolHostInfo {

	public const InternalProtocol = "https";

	public const AccountInternalHost = "ac-sb-talk.kakao.com";
	public const InternalHost = "sb-talk.kakao.com";
	public const LocoEntry = "booking-loco.kakao.com";

	public const ProfileUploadHost = "up-p.talk.kakao.com";
	public const MediaUploadHost = "up-m.talk.kakao.com";
	public const VideoUploadHost = "up-v.talk.kakao.com";
	public const AudioUploadHost = "up-a.talk.kakao.com";
	public const GroupProfileUploadHost = "up-gp.talk.kakao.com";
	public const FileHost = "dn.talk.kakao.com";
	public const MediaFileHost = "dn-m.talk.kakao.com";
	public const AudioFileHost = "dn-a.talk.kakao.com";
	public const VideoFileHost = "dn-v.talk.kakao.com";

	public const ProfileUploadURL = ProtocolHostInfo::InternalProtocol . "://" . ProtocolHostInfo::MediaFileHost;
	public const MediaUploadURL = ProtocolHostInfo::InternalProtocol . "://" . ProtocolHostInfo::MediaUploadHost;
	public const VideoUploadURL = ProtocolHostInfo::InternalProtocol . "://" . ProtocolHostInfo::VideoUploadHost;
	public const AudioUploadURL = ProtocolHostInfo::InternalProtocol . "://" . ProtocolHostInfo::AudioUploadHost;
	public const GroupProfileUploadURL = ProtocolHostInfo::InternalProtocol . "://" . ProtocolHostInfo::MediaFileHost;
	public const FileURL = ProtocolHostInfo::InternalProtocol . "://" . ProtocolHostInfo::FileHost;
	public const MediaFileURL = ProtocolHostInfo::InternalProtocol . "://" . ProtocolHostInfo::MediaFileHost;
	public const AudioFileURL = ProtocolHostInfo::InternalProtocol . "://" . ProtocolHostInfo::AudioFileHost;
	public const VideoFileURL = ProtocolHostInfo::InternalProtocol . "://" . ProtocolHostInfo::VideoFileHost;


}