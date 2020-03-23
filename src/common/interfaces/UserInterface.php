<?php

namespace markmoskalenko\mailing\common\interfaces;

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

interface UserInterface
{
    /**
     * @return ObjectId
     */
    public function getId();

    /**
     * @return ObjectId
     */
    public function getTelegramId();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @return string
     */
    public function getLanguage();

    /**
     * @return mixed
     */
    public function getReferralByAffiliateDomain();

    /**
     * @return UTCDateTime
     */
    public function getCreatedAt();

    /**
     * @return UTCDateTime
     */
    public function getExpiredAt();

    /**
     * @param array $params
     * @return UserInterface
     */
    public static function findOne(array $params);

    /**
     * @param string $email
     * @return UserInterface
     */
    public static function findByEmail(string $email);

    /**
     * @param string $telegramId
     * @return UserInterface
     */
    public static function findByTelegramId(string $telegramId);

    /**
     * @param string $code
     * @return UserInterface
     */
    public static function findOneByReferralCode(string $code);

    /**
     * @param string $domain
     * @return UserInterface
     */
    public static function findOneByReferralDomain(string $domain);

    /**
     * @param string $id
     * @return mixed
     */
    public static function findOneById(string $id);

    /**
     * @return string
     */
    public function getFirebaseToken();

    /**
     * @return string
     */
    public function getAccessToken();
}
