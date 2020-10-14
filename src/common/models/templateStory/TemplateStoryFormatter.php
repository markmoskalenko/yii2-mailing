<?php

namespace markmoskalenko\mailing\common\models\templateStory;

use Aws\CloudFront\UrlSigner;
use Yii;

/**
 *
 */
trait TemplateStoryFormatter
{
    /**
     * @return string|null
     */
    public function getImageUrl()
    {
        if (!$this->picture) {
            return null;
        }

        $params = Yii::$app->params;
        $id = md5($this->picture);
        $cloudfront = $params['s3.cloudfront.education.domain'];
        $url = $cloudfront . '/' . $this->picture;

        return $url;
    }

    /**
     * @return string|null
     */
    public function getVideoUrl()
    {
        if (!$this->video) {
            return null;
        }

        $params = Yii::$app->params;
        $id = md5($this->video);
        $cloudfront = $params['s3.cloudfront.education.domain'];
        $url = $cloudfront . '/' . $this->video;

        return $url;
    }
}
