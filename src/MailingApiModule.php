<?php

namespace markmoskalenko\mailing;

/**
 * Class MailingModule
 * @package mailing
 */
class MailingApiModule extends MailingModule
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $this->controllerNamespace = 'markmoskalenko\mailing\frontend\controllers';
        $app->getUrlManager()->addRules(['/mailing/pixel/open/<logId>.png' => '/mailing/pixel/open'], false);
        parent::bootstrap($app);
    }
}
