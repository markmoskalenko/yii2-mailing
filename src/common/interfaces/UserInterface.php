<?php

namespace markmoskalenko\mailing\common\interfaces;

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;
use yii\db\ActiveQueryInterface;

interface UserInterface
{
    /**
     * @return string
     */
    public function getOurDomain();

    /**
     * @return ObjectId
     */
    public function getId();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getFirstName();

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
     * @param string $code
     * @return UserInterface
     */
    public static function findOne(array $params);

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

}
