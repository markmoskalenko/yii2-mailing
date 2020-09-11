<?php

namespace markmoskalenko\mailing\common\models\templateStory;

use Aws\CloudFront\UrlSigner;
use Yii;

/**
 *
 */
trait TemplateStoryFormatter
{
    public function getSignerImageUrl($isResetCache = false)
    {
        if (!$this->picture) {
            return null;
        }
        $cache = Yii::$app->cache;

        $id = md5($this->picture);
        $key = "file:{$id}";
        $result = $cache->get($key);

        if (!$result || $isResetCache) {
            /** @var array $sizes */
            $params = Yii::$app->params;
            /** @var string $bucket */
            $bucket = $params['s3.bucket'];
            /** @var string $signedSecret */
            $signedSecret = Yii::getAlias($params['s3.cloudfront.signed.secret']);
            /** @var string $signedKey */
            $signedKey = Yii::getAlias($params['s3.cloudfront.signed.key']);
            $cloudfront = $params['s3.cloudfront.domain'];
            $signer = new UrlSigner($signedKey, $signedSecret);
            $expired = time() + 604800;
            $url = $cloudfront . '/' . $this->picture;
            $result = $signer->getSignedUrl($url, $expired);
            $cache->set($key, $result, 604800);
        }

        return $result;
    }
}
