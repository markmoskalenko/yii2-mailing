<?php

namespace markmoskalenko\mailing\common\jobs;

use markmoskalenko\mailing\common\helpers\LinksHelpers;
use markmoskalenko\mailing\common\interfaces\UserInterface;
use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use markmoskalenko\mailing\common\models\story\Story;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\templateStory\TemplateStory;
use MongoDB\BSON\ObjectId;
use Throwable;
use yii\base\BaseObject;
use yii\base\ErrorException;
use yii\queue\JobInterface;
use yii\queue\Queue;

/**
 *
 */
class SendStoryJob extends BaseObject implements JobInterface
{
    /**
     * Ключ шаблона письма
     * @var ObjectId
     */
    public $key;

    /**
     * ID пользователя
     * @var string
     */
    public $userId;

    /**
     * ID лога
     * @var string
     */
    public $logId;

    /**
     * @var UserInterface
     */
    public $user;

    /**
     * @var UserInterface
     */
    public $userClass;

    /**
     * Массив ссылок
     *
     * @var array
     */
    public $links;

    /**
     * @var string
     */
    public $ourDomain;

    /**
     * @var boolean
     */
    public $ssl;

    /**
     * Данные для темплейта
     * @var array
     */
    public $data;


    /**
     * @param Queue $queue
     * @return mixed|void
     */
    public function execute($queue)
    {
        $this->user = $this->userClass::findOneById($this->userId);

        $template = Template::findByKey($this->key);

        $log = EmailSendLog::findOne($this->logId);

        try {
            if (!$log) {
                // в телеграм
                throw new ErrorException('Лог не найден');
            }

            if (!$template) {
                throw new ErrorException('Шаблон не найден ' . $this->key);
            }

            if (!$this->user) {
                throw new ErrorException('Пользователь не найден ' . $this->userId);
            }

            // Поиск основного партнера по реферальному домену
            // @todo переименовать в affiliate
            $referral = $this->user->getReferralByAffiliateDomain()->one();

            $data = LinksHelpers::getLinks(
                $this->user,
                $referral,
                $this->ssl,
                $this->links,
                $this->ourDomain,
                $this->logId,
                $this->data
            );

            // Шаблон письма для отправки
            // Ищет по ключу, языку и домену партнера
            $templateStory = TemplateStory::findAllByKeyAndLangAndAffiliateDomain(
                $template->_id,
                $this->user->getLanguage(),
                $data['{sourceDomain}']
            );

            if (!$templateStory) {
                throw new ErrorException('Шаблон не найден ' . $this->key . ':' . $data['{sourceDomain}']);
            }


            foreach ($templateStory as $story) {
                $this->sendStory($story, $this->userId);
            }

            $log->send();
        } catch (Throwable $e) {
            $message = '';
            $message .= '<br>' . $e->getMessage();
            $message .= '<br>' . $e->getTraceAsString();
            $log->setError($message);

            throw new $e;
        }
    }

    /**
     * @param TemplateStory $templateStory
     * @param               $userId
     * @return bool
     */
    private function sendStory(TemplateStory $templateStory, $userId)
    {
        $story = new Story();
        $story->imageUrl = $templateStory->getSignerImageUrl(true);
        $story->youtubeId = $templateStory->youtubeId;
        $story->text = $templateStory->text;
        $story->buttonIsShow = $templateStory->buttonIsShow;
        $story->buttonText = $templateStory->buttonText;
        $story->buttonType = $templateStory->buttonType;
        $story->buttonCallback = $templateStory->buttonCallback;
        $story->isActive = true;
        $story->isWatched = false;
        $story->templateStoryId = $templateStory->_id;
        $story->userId = new ObjectId($userId);

        return $story->save();
    }
}
