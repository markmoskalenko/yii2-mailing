<?php

namespace markmoskalenko\mailing\common\models\emailSendLog;

use common\models\user\User;

/**
 *
 */
trait EmailSendLogRelations
{
    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['_id' => 'userId']);
    }
}
